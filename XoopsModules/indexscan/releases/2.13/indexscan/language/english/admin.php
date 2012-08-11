<?php
//%%%%%%		English language file for index scan / admin 		%%%%%
define("_AM_INDEXSCAN_NOW","Scan for missing index files");
define("_AM_INDEXSCAN_CREATE","Create index files where missing");
define("_AM_INDEXSCAN_HELP","Help");
define("_AM_INDEXSCAN_CONFIG","Config");
define("_AM_INDEXSCAN_HEADER","These folders are missing index files");
define("_AM_INDEXSCAN_NOTFOUND","Index files <b>not</b> found<br>\n");
define("_AM_INDEXSCAN_FOUNDMISSING","<b>missing</b> index files found\n");
define("_AM_INDEXSCAN_MAKINGHEADER","Creating missing index.html files");
define("_AM_INDEXSCAN_CREATED","index.html created");
define("_AM_INDEXSCAN_CREATEDINDEXFILES","indexfiler created");

// Added in 1.01
define("_AM_INDEXSCAN_CHECKFORFILES","<tr class='header'><center><h2>Checking files for IFRAME Infection</h2></tr></center><center><small>Not that not all uses of Ifram is injections.<br>Check the code in the files found before you delete.<br><hr></small></center>");
define("_AM_INDEXSCAN_UNABLETOREADFILE","Unable to open file ");
define("_AM_INDEXSCAN_INFECTED"," found!!");
define("_AM_INDEXSCAN_CLEAN","OK");
define("_AM_INDEXSCAN_INJECTIONSCAN","Scan for ifram injections");

//added in 2.00
define("_AM_INDEXSCAN_SCANNING4MISS","<br>Looking for missin index files.<br>Please wait.");
define("_AM_INDEXSCAN_CREATINGMISS","<br>Creating missing index files.<br>Please wait.");
define("_AM_INDEXSCAN_SCANNING4IFRAME","<br>Looking for iframes and encoded javascript.<br>Please wait.");
define("_AM_INDEXSCAN_FINISDINJECTIONS"," files contain the word *iframe* or *fromCharCode* indicating ifram insert or encoded javascript <br> Check to see if this is the case by clicking the red bar to see source code. Before taking any action.<br><br> Total number of files scanned:");

// Added in 2.01
define("_AM_INDEXSCAN_NOTVERIFY"," : The Checksum of this file is different from original!");
define("_AM_INDEXSCAN_VERIFIED"," Checksum for admin/index.php is verified.");

// Added in 2.03
define("_AM_INDEXSCAN_CHECKILLEGALFILES","Check files");
define("_AM_INDEXSCAN_SCANNING4ILLEGALFILES", "Scanning web files");
define("_AM_INDEXSCAN_MAYBEOK", "Looks to be ok");
define("_AM_INDEXSCAN_NOTINXOOPSINSTALL", "Not Xoops file");
define("_AM_INDEXSCAN_FINISDILLEGAL", " files found that are not Xoops files. Total files scanned: ");
define("_AM_INDEXSCAN_ILLEGAL_DESC", "The file found Not to be Xoops files, are checked against checkfile.txt in admin folder, and agains files in config defined as allowed file types.<br/>These files could be unwanted tmp, thumbs.db, or info files.<br/>If you you dont need these files add them to automaticly delete in config and they will be deleted when you run this scan next time.");
define("_AM_INDEXSCAN_REALLYDELETE", "Are you sure ?, delete file.: ");
define("_AM_INDEXSCAN_CREATEZIP", "Create zip file for download");
define("_AM_INDEXSCAN_CREATINGZIP", "Creating backup with empty folders<br/>plus index files.<br/>");
define("_AM_INDEXSCAN_BACKEDUPDELETEDFROMBACKUP", "Deleted files in folder from backup except index.html files");
define("_AM_INDEXSCAN_BACKEDUP2", "Backed up folder.: ");
define("_AM_INDEXSCAN_DOWNLOADZIP", "Download index files zip");
define("_AM_INDEXSCAN_CREATINGZIPFORDOWNLOAD", "Creating zip file for download");
define("_AM_INDEXSCAN_CREATEDINDEXINBACKUP", "Created index file in backup folder");
define("_AM_INDEXSCAN_CLEANUPDONE", "Cleaning up...Done!");
define("_AM_INDEXSCAN_FILESARECOPIED", " Files were copied to backup folder");
define("_AM_INDEXSCAN_FILESDELETED", " Files were deleted from backup folder again");
define("_AM_INDEXSCAN_FILESCREATED", " Index.html files were created in backupfolder");
?>