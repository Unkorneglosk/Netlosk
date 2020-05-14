<?php
/**
 * This script is the communication path for Vanilla Forums jsConnect
 * Make sure your forum configuration looks like: (replace net.losk.fr with your own domain)
 * Authentication URL: https://net.losk.fr/identify.php
 * Sign In URL: https://net.losk.fr/login?redir={target}
 * Regiter URL: https://net.losk.fr/register
 * Logout URL: https://net.losk.fr/logout?redir={target}
 * And make sure that you client ID and Secret keys correspond to the ones in coreLosk database.
 **/
 
// 1. Get your client ID and secret here. These must match those in your jsConnect settings.

if(isset($_GET['client_id'])) {
     
     $requestClient = Securise($_GET['client_id']);
     $req1 = mysqli_fetch_array(mysqli_query($db, 'SELECT * FROM netlosk_clients WHERE id = "' . $requestClient . '"'));
     $clientID = $req1['id'];
     $secret = $req1['secret'];
     $useAvatar = $req1['useAvatar'];
 } else {
        $clientID = "1267206160";
        $secret = "6017f75dac051e365374482b1ffc7a25";
}
  

// 2. Grab the current user from your session management system or database here.

if(isset($_SESSION['username'])) {
    
    $username = Securise($_SESSION['username']);
    $req = mysqli_fetch_array(mysqli_query($db, 'select id,username,email,verified,avatar,banned from netlosk_users where username="'.$username.'"'));
    $result['uniqueid'] = $req['id'];
    $result['name'] = $req['username'];
    $result['email'] = $req['email'];
    if($req1['useAvatar']) {
        $result['photourl'] = $req['avatar'];
    } else {
        $result['photourl'] = "";
    }
    $error = '<ul id="errors">';
    if($req['verified'] != '0') {
        $verified = true;
    } else {
        $verified = false;
        $error. = '<li>'.coreLang('error-verify-mail').'</li>';
    }
    if($req['banned'] != '0') {
        $access = true;          
    } else {
        $access = false;
        $error. = '<li>'.coreLang('error-banned').'</li>';
    }
    $error. = '</ul>';
}

// 3. Fill in the user information in a way that Vanilla can understand.
$user = array();

if ($verified && $access) {
    // CHANGE THESE FOUR LINES.
    $user['uniqueid'] = $result['uniqueid'];
    $user['name'] = $result['name'];
    $user['email'] = $result['email'];
    $user['photourl'] = $result['photourl'];
} else {
    coreError($error);
    die;
}

// 4. Generate the jsConnect string.

// This should be true unless you are testing.
// You can also use a hash name like md5, sha1 etc which must be the name as the connection settings in Vanilla.
$secure = 'sha256';
writeJsConnect($user, $_GET, $clientID, $secret, $secure);
