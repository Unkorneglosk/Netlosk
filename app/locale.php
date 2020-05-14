<?php 
if (!defined('APP')) exit;

function t($asset, $variable1 = false, $variable2 = false, $variable3 = false, $variable4 = false) {
    
    global $lang;
    $rpl = array (
            '%1%' => $variable1,
            '%2%' => $variable2,
            '%3%' => $variable3,
            '%4%' => $variable4
        );
		if(isset($lang["$asset"])) {
			$asset = $lang["$asset"];
		} else {
			$asset = $asset;
		}
    $message =  str_replace(array_keys($rpl), array_values($rpl), $asset);
    return echo $message;
    
}
