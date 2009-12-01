<?php
//%%%%%%		English language file for index scan / admin 		%%%%%
define("_AM_INDEXSCAN_NOW","Scan for missing index files");
define("_AM_INDEXSCAN_CREATE","Create index files where missing");
define("_AM_INDEXSCAN_HELP","Help");
define("_AM_INDEXSCAN_CONFIG","Config");
define("_AM_INDEXSCAN_HEADER","These folders are missing index files");
define("_AM_INDEXSCAN_NOTFOUND","Index files <strong>not</strong> found<br />\n");
define("_AM_INDEXSCAN_FOUNDMISSING","<strong>missing</strong> index files found\n");
define("_AM_INDEXSCAN_MAKINGHEADER","Creating missing index.html files");
define("_AM_INDEXSCAN_CREATED","index.html created");
define("_AM_INDEXSCAN_CREATEDINDEXFILES","indexfiler created");

// Added in 1.01
define("_AM_INDEXSCAN_CHECKFORFILES","<tr class='header txtcenter'><h2>Checking files for IFRAME Infection</h2><p class='txtcenter'>Not that not all uses of Ifram is injections.<br />Check the code in the files found before you delete.</p></tr><hr>");
define("_AM_INDEXSCAN_UNABLETOREADFILE","Unable to open file ");
define("_AM_INDEXSCAN_INFECTED"," found!!");
define("_AM_INDEXSCAN_CLEAN","OK");
define("_AM_INDEXSCAN_INJECTIONSCAN","Scan for ifram injections");

//added in 2.00
define("_AM_INDEXSCAN_SCANNING4MISS","<br />Looking for missin index files.<br />Please wait.");
define("_AM_INDEXSCAN_CREATINGMISS","<br />Creating missing index files.<br />Please wait.");
define("_AM_INDEXSCAN_SCANNING4IFRAME","<br />Looking for iframes and encoded javascript.<br />Please wait.");
define("_AM_INDEXSCAN_FINISDINJECTIONS"," files contain the word *iframe* or *fromCharCode* indicating ifram insert or encoded javascript <br /> Check to see if this is the case by clicking the red bar to see source code. Before taking any action.<br /><br /> Total number of files scanned:");
?>