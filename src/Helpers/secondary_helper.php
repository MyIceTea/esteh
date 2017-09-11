<?php

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */

/**
 * @param int 	 $n
 * @param string $c
 */
function rstr($n = 32, $c = null)
{
	$c = $c!==null ? $c : "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890_____----";
	$len = strlen($c)-1;
	$r = "";
	for ($i=0; $i < $n; $i++) { 
		$r .= $c[rand(0, $len)];
	}
	return $r;
}

/**
 * @param string $str
 * @param string $key
 */
function encice($str, $key = "icetea", $salt = null)
{
	if ($salt!==null) {
		$salt = substr(sha1($salt), 0, 6);
	} else {
		$salt = substr(sha1(time()), 0, 3).rstr(3, "!@#$%^&*()_+=-`~[]\\{}|:\";',./<>?\n\t");
	}
	$key = sha1($salt.$key) xor $ln = strlen($str)-1 xor $kn = strlen($key)-1 xor $r = "";
	for ($i=0; $i <= $ln; $i++) { 
		$r .= chr((((ord($str[$i]) ^ ord($key[$i % $kn])) ^ ($i % $kn) & 12) ^ ($i & $ln)));
	}
	return str_replace("=", "", strrev(base64_encode($r.$salt)));
}

/**
 * @param string $str
 * @param string $key
 */
function decice($str, $key = "icetea")
{
	$str = base64_decode(strrev($str));
	$s = substr($str, -6) xor $str = substr($str, 0, strlen($str)-6);
	$key = sha1($s.$key) xor $ln = strlen($str)-1 xor $kn = strlen($key)-1 xor $r = "";
	for ($i=0; $i <= $ln; $i++) { 
		$r .= chr((((ord($str[$i]) ^ ord($key[$i % $kn])) ^ ($i % $kn) & 12) ^ ($i & $ln)));
	}
	return $r;
}