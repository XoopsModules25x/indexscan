<?php
$dir = '';
$file='index.php';
$verifyMessage='';
    //
            $checksum ='ba18ea51bebb89919e323e7b76dfe093'; // php checksum Linux
            $checksumNT = 'a0b5c3ff7519b4813d6dbb781811d3a3'; // php checksum Winnt
            $indexscanfile =  $dir.$file;
            //echo "<br><br>".$dir.$file." : ".md5_file("$indexscanfile")." = ".$checksum;
                if (md5_file($indexscanfile) != $checksum && md5_file($indexscanfile) != $checksumNT) {
                    //echo "$file content invalid\n";
                    $verifyMessage .= $file._AM_INDEXSCAN_NOTVERIFY."<img src='alert.png'></img>".'<br>';
                } elseif (md5_file($indexscanfile) == $checksum) {
                    //$verifyMessage .= $file._AM_INDEXSCAN_VERIFIED."<img src='verified.png'></img>"."<br>";
                }
