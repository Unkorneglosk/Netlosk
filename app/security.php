<?php 
if (!defined('APP')) exit;

function Securise($str)
	{
		$str = htmlspecialchars(stripslashes(nl2br(trim($str))));
		return $str;
	}
	
function Sanitize($str) {
  global $db;
	if (get_magic_quotes_gpc()) {
		$sanitize = mysqli_real_escape_string($db, stripslashes($str));	 
	} else {
		$sanitize = mysqli_real_escape_string($db, $str);	
	} 
	return $sanitize;
}
function PasswordHash($str, $version, $username) //This is not updated, current hash is closed source
    {
        switch ($version) {
            case 2:
                $config_hash = "xf/**/dfggg{[è'rR_gh(ugf*/" . $username . "dfjsdfsdfçà('-àçéé";
                $str = Securise(sha1($str . $config_hash));
                break;
            default:
                $config_hash = "xfjeà@fbgb#zgnzthrR_gh(ugf*/";
                $str = Securise(sha1($str . $config_hash));
                break;
        }
        return $str;
    }
