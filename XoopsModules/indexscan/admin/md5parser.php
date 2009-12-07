<?php
$dir = "";
$file="index.php";
$verifyMessage="";
	//
			$checksum ="aff9e481b01ba61606b59a32b87aaaea"; // php checksum Linux
			$checksumNT = "f5e765568ec1fd209cceee4932c3a82f"; // php checksum Winnt
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