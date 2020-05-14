<?php 
if (!defined('APP')) exit;

$db = mysqli_connect($config['database']['host'], $config['database']['user'], $config['database']['password'], $config['database']['name']);

function GetUserInfo($username) {

    $req = mysqli_fetch_array(mysqli_query($db, 'SELECT * FROM netlosk_users WHERE username = "' . $username . '"'));  
    $user['username'] = $req['username'];
    $user['avatar'] = $req['avatar'];
    $user['email'] = $req['email'];
    $user['password'] = $req['password'];
    $user['passversion'] = $req['passversion'];
    $user['signup'] = date('d/m/Y' ,$res['signup_date']);
    $user['verified'] = $req['verified'];
    
    return $user;
    
  }
  
function CheckUsername($username) { //This checks is a username is available
    $req = mysqli_num_rows(mysqli_query($db, 'SELECT id FROM netlosk_users WHERE username = "' . $username . '"'));
    if($req > 0) {
      return false;
    } else {
      return true;
    }
  }

function CheckEmail($email) { //This checks is a mail is available
    $req = mysqli_num_rows(mysqli_query($db, 'SELECT id FROM netlosk_users WHERE email = "' . $email . '"'));
    if($req > 0) {
      return false;
    } else {
      return true;
    }
  }

function CreateUser($username, $password, $passVersion, $email, $ip, $avatar) { 
    $req = mysqli_query($db, 'insert into netlosk_users(username, password, passversion, email, register_ip, avatar, signup_date) values ("'.$username.'", "'.$password.'", "'.$passVersion.'", "'.$email.'", "'.$ip.'", "'.$avatar.'", "'.time().'"');
    if($req) {
        return true;
    } else {
        return false;    
    }
  }
