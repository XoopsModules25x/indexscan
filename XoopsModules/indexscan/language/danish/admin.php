<?php
//%%%%%%		Admins language for index scan admin.php 		%%%%%
define("_AM_INDEXSCAN_NOW","Skan for manglende index filer");
define("_AM_INDEXSCAN_CREATE","Opret manglende indexfiler");
define("_AM_INDEXSCAN_CHMODNOW","Chmod dine xoops dirs til 775");
define("_AM_INDEXSCAN_HELP","Hjælp");
define("_AM_INDEXSCAN_CONFIG","Konfigurer");
define("_AM_INDEXSCAN_HEADER","Disse mapper mangler index filer");
define("_AM_INDEXSCAN_NOTFOUND","Index files <strong>not</strong> found<br />\n");
define("_AM_INDEXSCAN_FOUNDMISSING","<strong>manglende</strong> index files fundet\n");
define("_AM_INDEXSCAN_MAKINGHEADER","Laver manglende index.html filer");
define("_AM_INDEXSCAN_CREATED","index.html oprettet");
define("_AM_INDEXSCAN_CREATEDINDEXFILES","indexfiler oprettet");

// Added in 1.01
define("_AM_INDEXSCAN_CHECKFORFILES","<tr class='header txtcenter'><h2>Checking files for IFRAME Infection</h2><p class='txtcenter'>Not that not all uses of Ifram is injections.<br />Check the code in the files found before you delete.</p></tr><hr>");
define("_AM_INDEXSCAN_UNABLETOREADFILE","Kan ikke åbne fil: ");
define("_AM_INDEXSCAN_INFECTED","!!Iframe fundet!!");
define("_AM_INDEXSCAN_CLEAN","OK");
define("_AM_INDEXSCAN_INJECTIONSCAN","Skan for iframe injection");

//added in 2.00
define("_AM_INDEXSCAN_SCANNING4MISS","<br />Skanner for manglende Indexfiler.<br />Vent venligst.");
define("_AM_INDEXSCAN_CREATINGMISS","<br />Opretter manglende indexfiler.<br />Vent venligst.");
define("_AM_INDEXSCAN_SCANNING4IFRAME","<br />Skanner filer for iframe og javascript hijacking.");
define("_AM_INDEXSCAN_FINISDINJECTIONS"," filer indeholder ordene *iframe* eller *fromCharCode* som kan indikere iframe insert eller kodet javascript insert.<br /> Check for at se indholdet af de fundne filer ved at klikke på den røde bar, før du handler yderliger med disse filer.<br /><br /> Filer der blev skannet ialt: ");

// Added in 2.01
define ("_AM_INDEXSCAN_NOTVERIFY"," : Denne fils checksum er forskellig fra originalen!");
define ("_AM_INDEXSCAN_VERIFIED"," Checksum for admin/index.php er ok.");
?>