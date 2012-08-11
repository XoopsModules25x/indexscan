<?php
//%%%%%%		French language file for index scan / admin 		%%%%%
define("_AM_INDEXSCAN_NOW","Scanner pour rep&#233;rer les fichiers index absents");
define("_AM_INDEXSCAN_CREATE","Cr&#233;er un fichier index o&#249; ils sont absents");
define("_AM_INDEXSCAN_HELP","Aide");
define("_AM_INDEXSCAN_CONFIG","Configuration");
define("_AM_INDEXSCAN_HEADER","Ces dossiers ne poss&#232;dent pas de fichiers index");
define("_AM_INDEXSCAN_NOTFOUND","Fichiers index <strong>non</strong> trouv&#233;s<br />\n");
define("_AM_INDEXSCAN_FOUNDMISSING","<strong>Absence</strong> de  fichiers index trouv&#233;e\n");
define("_AM_INDEXSCAN_MAKINGHEADER","Cr&#233;ation des fichiers index.html absents");
define("_AM_INDEXSCAN_CREATED","index.html cr&#233;&#233;");
define("_AM_INDEXSCAN_CREATEDINDEXFILES","Fichier index cr&#233;&#233;");

// Added in 1.01
define("_AM_INDEXSCAN_CHECKFORFILES","<tr class='header txtcenter'><h2>Recherche de fichiers avec injection d&#39;IFRAME</h2><p class='txtcenter'>Bien que toutes les utilisations d&#39;frame ne consiste pas en injections.<br />V&#233;rifiez le code dans les fichiers trouv&#233;s avant de les supprimer.</p></tr><hr>");
define("_AM_INDEXSCAN_UNABLETOREADFILE","Impossible d&#39;ouvrir le fichier");
define("_AM_INDEXSCAN_INFECTED","!! Mot IFRAME non trouv&#233; !!");
define("_AM_INDEXSCAN_CLEAN","OK");
define("_AM_INDEXSCAN_INJECTIONSCAN","Scanner des infections d&#39;iframe");

//added in 2.00
define("_AM_INDEXSCAN_SCANNING4MISS","<br />Recherche des fichiers index absents.<br />Attendez SVP.");
define("_AM_INDEXSCAN_CREATINGMISS","<br />Cr&#233;ation des fichiers index manquants.<br />Attendez SVP.");
define("_AM_INDEXSCAN_SCANNING4IFRAME","<br />Recherche d&#39;Iframe et code javascript ins&#233;r&#233;.<br />Attendez SVP.");
define("_AM_INDEXSCAN_FINISDINJECTIONS"," fichier(s) contenant le mot &#34;iframe&#34; ou &#34;fromCharCode&#34; indiquant la pr&#233;sence d&#39;Iframe(s) ou de javascript(s) ins&#233;r&#233;(s).<br />V&#233;rifiez si c&#39;est bien le cas en cliquant sur la barre rouge pour voir le code source, avant de prendre toute action corrective.<br /><br />Nombre total de fichiers scann&#233;s :");

// Added in 2.01
define("_AM_INDEXSCAN_NOTVERIFY"," : Le checksum de ce fichier est diff&#233;rent de l&#39;original !");
define("_AM_INDEXSCAN_VERIFIED","Le checksum pour le fichier admin/index.php est v&#233;rifi&#233;.");

// Added in 2.03
define("_AM_INDEXSCAN_CHECKILLEGALFILES","V&#233;rifiez les fichiers"); 
define("_AM_INDEXSCAN_SCANNING4ILLEGALFILES", "Analyse des fichiers web"); 
define("_AM_INDEXSCAN_MAYBEOK", "Semble &#234;tre OK"); 
define("_AM_INDEXSCAN_NOTINXOOPSINSTALL", "Fichier(s) non &#34;Xoops&#34;"); 
define("_AM_INDEXSCAN_FINISDILLEGAL", " fichiers trouv&#233;s qui ne sont pas de Xoops. Total des fichiers scann&#233;s : "); 
define("_AM_INDEXSCAN_ILLEGAL_DESC", "Le(s) fichier(s) trouv&#233;(s) ne semble(nt) pas &#234;tre des fichiers Xoops, v&#233;rification r&#233;alis&#233;e par rapport au fichier checkfile.txt dans le dossier &#34;admin&#34;, et par rapport aux types de fichiers d&#233;finis comme autoris&#233;s dans la configuration.<br/>Cela peut &#234;tre des fichiers temporaires ind&#233;sirables, thumbs.db ou des fichiers d&#39;infos.<br/>S&#39;ils ne sont pas ou plus n&#233;cessaires, vous pouvez les ajouter automatiquement dans configuration, ils seront supprim&#233;s lors de la prochaine analyse."); 
define("_AM_INDEXSCAN_REALLYDELETE", "Etes-vous s&#251;r ?, fichier(s) effac&#233;(s): "); 
define("_AM_INDEXSCAN_CREATEZIP", "Cr&#233;er une archive zip &#224; t&#233;l&#233;charger"); 
define("_AM_INDEXSCAN_CREATINGZIP", "Cr&#233;ation d&#39;une sauvegarde au format zip de la totalit&#233; des dossiers<br/> y compris les fichiers index.<br/>"); 
define("_AM_INDEXSCAN_BACKEDUPDELETEDFROMBACKUP", "Supprimer les fichiers dans le r&#233;pertoire de sauvegarde, sauf les fichiers index.html"); 
define("_AM_INDEXSCAN_BACKEDUP2", "Dossier(s) sauvegard&#233;(s).: "); 
define("_AM_INDEXSCAN_DOWNLOADZIP", "T&#233;l&#233;charger les fichiers index archiv&#233;s au format zip"); 
define("_AM_INDEXSCAN_CREATINGZIPFORDOWNLOAD", "Cr&#233;ation d&#39;une fichier au format zip &#224; t&#233;l&#233;charger"); 
define("_AM_INDEXSCAN_CREATEDINDEXINBACKUP", "Cr&#233;ation d&#39;un fichier index dans le r&#233;pertoire des sauvegardes"); 
define("_AM_INDEXSCAN_CLEANUPDONE", "Nettoyage r&#233;alis&#233; ... !"); 
define("_AM_INDEXSCAN_FILESARECOPIED", " Fichiers ont &#233;t&#233; copi&#233;s dans le r&#233;pertoire de sauvegarde"); 
define("_AM_INDEXSCAN_FILESDELETED", " Fichiers ont &#233;t&#233; effac&#233;s du r&#233;pertoire de sauvegarde"); 
define("_AM_INDEXSCAN_FILESCREATED", " Fichiers index.html ont &#233;t&#233; cr&#233;&#233;s dans le r&#233;pertoire de sauvegarde");
/**
 * @translation     AFUX (Association Francophone des Utilisateurs de Xoops) (http://www.afux.org/)
 * @specification   _LANGCODE: fr
 * @specification   _CHARSET: UTF-8
 *
 * @Translator      Kris (kris@afux.org)
 *
 * @version         $Id
**/
?>