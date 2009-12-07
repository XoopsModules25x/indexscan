<?php
//%%%%%%		Lenguaje español para index scan / admin desde HispaXoops - www.hispaxoops.com		%%%%%
define("_AM_INDEXSCAN_NOW","Escanear archivos index perdidos");
define("_AM_INDEXSCAN_CREATE","Crea archivos index.html donde hagan falta");
define("_AM_INDEXSCAN_HELP","Ayuda");
define("_AM_INDEXSCAN_CONFIG","Configurar");
define("_AM_INDEXSCAN_HEADER","Estas carpetas han perdido o no tienen sus archivos index.html");
define("_AM_INDEXSCAN_NOTFOUND","<strong>No</strong> Encontrado<br />\n");
define("_AM_INDEXSCAN_FOUNDMISSING","<strong>Archivos index.html</strong> encontrados\n");
define("_AM_INDEXSCAN_MAKINGHEADER","Creando archivos index.html");
define("_AM_INDEXSCAN_CREATED","index.html creados");
define("_AM_INDEXSCAN_CREATEDINDEXFILES","Creado el generador de archivos index.html");

// Added in 1.01
define("_AM_INDEXSCAN_CHECKFORFILES","<tr class='header txtcenter'><h2>Chequear archivos con posible inyección de IFRAME</h2><p class='txtcenter'>No todos usan inyección de IFRAME.<br />Chequea el código en los archivos antes de que los borres.</p></tr><hr>");
define("_AM_INDEXSCAN_UNABLETOREADFILE","No se puede abrir el archivo ");
define("_AM_INDEXSCAN_INFECTED"," encontrada!!");
define("_AM_INDEXSCAN_CLEAN","OK");
define("_AM_INDEXSCAN_INJECTIONSCAN","Escanear inyecciones de IFRAME");

//added in 2.00
define("_AM_INDEXSCAN_SCANNING4MISS","<br />Looking for missin index files.<br />Please wait.");
define("_AM_INDEXSCAN_CREATINGMISS","<br />Creating missing index files.<br />Please wait.");
define("_AM_INDEXSCAN_SCANNING4IFRAME","<br />Looking for iframes and encoded javascript.<br />Please wait.");
define("_AM_INDEXSCAN_FINISDINJECTIONS"," files contain the word *iframe* or *fromCharCode* indicating ifram insert or encoded javascript <br /> Check to see if this is the case by clicking the red bar to see source code. Before taking any action.<br /><br /> Total number of files scanned:");

// Added in 2.01
define ("_AM_INDEXSCAN_NOTVERIFY"," : The Checksum of this file is different from original!");
define ("_AM_INDEXSCAN_VERIFIED"," Checksum for admin/index.php is verified.");
?>