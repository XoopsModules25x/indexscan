<?php
    IndexScanCreateMd5('.','');

function IndexScanCreateMd5($dir,$location) 
{
	// Open .md5 file for appending
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
				echo "$location/$folder" . ':' . md5_file($path).'<br />'; 
                // We insert the path of the file and its MD5 hash 
				fwrite($fh, $stringData."\n");

            }
        }
        closedir($url);
    }
}
?>