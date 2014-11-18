<?php
	$method = $_SERVER['REQUEST_METHOD'];
	
	switch($method){
	case 'GET':
		$files = glob("*.txt");
		$i = array_rand($files);
		$filename = $files[$i];
		$codefile = fopen($filename,"r") or die("Unable to open read file");
		echo fread($codefile,filesize($filename));
		break;
	case 'POST':
		if (isset($_POST['code'])){
			$code = $_POST['code'];
			
			$filename = str_replace(".","-",$_SERVER['REMOTE_ADDR']).".txt";
			$codefile = fopen($filename,"w") or die("Unable to open write file");
			fwrite($codefile,$_POST['code']);
			
			echo "Your code has been saved\n";
			echo $_POST['code'];
		}
		else{
			echo "/*INVALID DATA FORMAT*/";
		}
		break;
	default:
		echo "/*ERROR: INVAILD REQUEST TYPE*/";
		break;
	}
	
?>