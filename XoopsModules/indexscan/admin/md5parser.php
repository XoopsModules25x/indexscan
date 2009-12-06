<?php

if (file_exists('indexscan.md5')) {
    /**
* XOOPS installation md5 checksumminig script
*
* This script allows you to check that the XOOPS system files have been correctly uploaded.
* It reads all the XOOPS files and reports missing or invalid ones.
* 
* Instructions:
* - Upload this script and xoops.md5 to your XOOPS documents root
* - Auto checking files in indexscan left out by iframe injection scan. If checksum fails, message is shown.
* - Re-upload missing/invalid files
*
* @copyright	The XOOPS project http://www.xoops.org/
* @license      http://www.fsf.org/copyleft/gpl.html GNU public license
* @author       Skalpa Keo <skalpa@xoops.org> & Modified for indexscan by Culex 2009
* @since        4.2.2
* @version		$Id: md5check.php 808 2009-12-05 15:33:00 Culex $
* @package 		Indexscan
*/

error_reporting( 0 );
$dir = "./"; 
header( "Content-type: text/plain" );

if ( !is_file( "indexscan.md5" ) || !is_readable( "indexscan.md5" ) ) {
	exit;
}
$sums = explode( "\n", rtrim( file_get_contents( "indexscan.md5" ) ) );

foreach ( $sums as $line ) {
	list( $file, $sum ) = explode( ":", $line, 2 );
	if ($file != '/md5parser.php' && $file != '/indexscan.md5') {
		if ( !file_exists( $dir.$file ) ) {
			echo "$file missing !\n";
		} else {
			$txt =  $dir.$file; 
				if ( md5_file($txt) != $sum ) {
					//echo "$file content invalid\n";
					$verifyMessage .= "$file content invalid"."<br>";
			}
		     }
		      }
		       }
		} else {
			//IndexScanCreateMd5('.','');
			$verifyMessage .= "indexscan.md5 is missing<br>Please upload!";
		 }

function IndexScanCreateMd5($dir,$location) 
{
	// Open .md5 file for appending
	chmod("indexscan.md5",0600);
	$fh = fopen('indexscan.md5', 'a') or die("can't open file");
    // We open the file 
    if ($url = opendir("$dir/$location")) {
        // It searches all folders and files it contains 
        while ($folder = readdir($url)) {
            // The path of current folder 
            $path = $dir . '/'.$location. '/' . $folder; 

            // If we find a folder, then relaunch it function to search 
            // Once all the files and folders it contains 
            if ($folder != '.' && $folder != '..' && is_dir($path))
                IndexScanCreateMd5($dir,"$location/$folder"); 

            // If we are dealing with a file 
            elseif ($folder != '.' && $folder != '..' && !is_dir($path)) {
                 $stringData = "$location/$folder" . ':' . md5_file($path); 
				//echo "$location/$folder" . ':' . md5_file($path).'<br />'; 
                // We insert the path of the file and its MD5 hash 
				fwrite($fh, $stringData."\n");

            }
        }
		chmod("indexscan.md5",0444);
        closedir($url);
    }
}
?> 