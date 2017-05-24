<?php
//%%%%%%        English language file for index scan / admin        %%%%%
define('_AM_INDEXSCAN_NOW', 'Scan for missing index files');
define('_AM_INDEXSCAN_CREATE', 'Create index.html');
define('_AM_INDEXSCAN_HELP', 'Help');
define('_AM_INDEXSCAN_CONFIG', 'Config');
define('_AM_INDEXSCAN_HEADER', 'These folders are missing index files');
define('_AM_INDEXSCAN_NOTFOUND', "Index files <b>not</b> found<br>\n");
define('_AM_INDEXSCAN_FOUNDMISSING', "<strong>missing</strong> index files found\n");
define('_AM_INDEXSCAN_MAKINGHEADER', 'Creating missing index.html files');
define('_AM_INDEXSCAN_CREATED', 'index.html created');
define('_AM_INDEXSCAN_CREATEDINDEXFILES', 'index files created');

// Added in 1.01
define('_AM_INDEXSCAN_CHECKFORFILES', "<tr class='header'><div style='text-align: center;'><h2>Checking files for IFRAME Infection</h2></tr></div><div style='text-align: center;'><small>Not that not all uses of iFrame is injections.<br>Check the code in the files found before you delete.<br><hr></small></div>");
define('_AM_INDEXSCAN_UNABLETOREADFILE', 'Unable to open file ');
define('_AM_INDEXSCAN_INFECTED', ' found!!');
define('_AM_INDEXSCAN_CLEAN', 'OK');
define('_AM_INDEXSCAN_INJECTIONSCAN', 'iFrame injections');

//added in 2.00
define('_AM_INDEXSCAN_SCANNING4MISS', '<br>Looking for missing index files.<br>Please wait.');
define('_AM_INDEXSCAN_CREATINGMISS', '<br>Creating missing index files.<br>Please wait.');
define('_AM_INDEXSCAN_SCANNING4IFRAME', '<br>Looking for iFrames and encoded javascript.<br>Please wait.');
define('_AM_INDEXSCAN_FINISDINJECTIONS', ' files contain the word *iFrame* or *fromCharCode* indicating iFrame insert or encoded javascript <br> Check to see if this is the case by clicking the red bar to see source code. Before taking any action.<br><br> Total number of files scanned:');

// Added in 2.01
define('_AM_INDEXSCAN_NOTVERIFY', ' : The Checksum of this file is different from original!');
define('_AM_INDEXSCAN_VERIFIED', ' Checksum for admin/index.php is verified.');

// Added in 2.03
define('_AM_INDEXSCAN_CHECKILLEGALFILES', 'Check XOOPS files');
define('_AM_INDEXSCAN_SCANNING4ILLEGALFILES', 'Scanning web files');
define('_AM_INDEXSCAN_MAYBEOK', 'Looks to be ok');
define('_AM_INDEXSCAN_NOTINXOOPSINSTALL', 'Not a XOOPS file');
define('_AM_INDEXSCAN_FINISDILLEGAL', ' files found that are not XOOPS files. Total files scanned: ');
define('_AM_INDEXSCAN_ILLEGAL_DESC', 'The file found that seem not to be XOOPS files, are checked against checkfile.txt in admin folder, and against files in config defined as allowed file types.<br>These files could be unwanted tmp, thumbs.db, or info files.<br>If you you do not need these files add them to automatically delete in config and they will be deleted when you run this scan next time.');
define('_AM_INDEXSCAN_REALLYDELETE', 'Are you sure ?, delete file.: ');
define('_AM_INDEXSCAN_CREATEZIP', 'Create Zip download');
define('_AM_INDEXSCAN_CREATINGZIP', 'Creating backup with empty folders<br>plus index files.<br>');
define('_AM_INDEXSCAN_BACKEDUPDELETEDFROMBACKUP', 'Deleted files in folder from backup except index.html files');
define('_AM_INDEXSCAN_BACKEDUP2', 'Backed up folder.: ');
define('_AM_INDEXSCAN_DOWNLOADZIP', 'Download index files zip');
define('_AM_INDEXSCAN_CREATINGZIPFORDOWNLOAD', 'Creating zip file for download');
define('_AM_INDEXSCAN_CREATEDINDEXINBACKUP', 'Created index file in backup folder');
define('_AM_INDEXSCAN_CLEANUPDONE', 'Cleaning up...Done!');
define('_AM_INDEXSCAN_FILESARECOPIED', ' Files were copied to backup folder');
define('_AM_INDEXSCAN_FILESDELETED', ' Files were deleted from backup folder again');
define('_AM_INDEXSCAN_FILESCREATED', ' Index.html files were created in backup folder');
