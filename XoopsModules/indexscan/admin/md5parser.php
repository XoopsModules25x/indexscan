<?php
$dir = "";
$file="index.php";
$verifyMessage="";
	//
			$checksum ="d56df8565175834e6ee70011ab861a30"; // php checksum Linux
			$checksumNT = "a4227c6859e4e5a44b09884541e02cf6"; // php checksum Winnt
			$indexscanfile =  $dir.$file; 
			//echo "<br><br>".$dir.$file." : ".md5_file("$indexscanfile")." = ".$checksum;
				if ( md5_file($indexscanfile) != $checksum && md5_file($indexscanfile) != $checksumNT) {
					//echo "$file content invalid\n";
					$verifyMessage .= $file._AM_INDEXSCAN_NOTVERIFY."<img src='alert.png'></img>"."<br>";
				}
		elseif ( md5_file($indexscanfile) == $checksum ) {
				//$verifyMessage .= $file._AM_INDEXSCAN_VERIFIED."<img src='verified.png'></img>"."<br>";
}

?> 