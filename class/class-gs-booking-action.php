<?php

/**
 * Created by PhpStorm.
 * User: macbookpro
 * Date: 8/5/16
 * Time: 11:24 PM
 */
class GoSurfBook
{

	/*
	 * Use for setting the session
	 */
	public $session = null;

	public $prefixKey = 'gs_';

	public function __construct(){

	}

	public function generate_session_key($entropy = false){


		$s=uniqid("",$entropy);
		$num= hexdec(str_replace(".","",(string)$s));
		$index = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$base= strlen($index);
		$out = '';
		for($t = floor(log10($num) / log10($base)); $t >= 0; $t--) {
			$a = floor($num / pow($base,$t));
			$out = $out.substr($index,$a,1);
			$num = $num-($a*pow($base,$t));
		}
		return $out;

	}
	
}


$bookStep = new GoSurfBook();