<?php
//%%%%%%		French language file for index scan / admin 		%%%%%
define("_AM_INDEXSCAN_NOW","Scanner pour rep�rer les fichiers index absents");
define("_AM_INDEXSCAN_CREATE","Cr�er un fichier index o� ils sont absents");
define("_AM_INDEXSCAN_HELP","Aide");
define("_AM_INDEXSCAN_CONFIG","Configuration");
define("_AM_INDEXSCAN_HEADER","Ces dossiers ne poss�dent pas de fichiers index");
define("_AM_INDEXSCAN_NOTFOUND","Fichiers index <strong>non</strong> trouv�s<br />\n");
define("_AM_INDEXSCAN_FOUNDMISSING","<strong>Absence</strong> de  fichiers index trouv�e\n");
define("_AM_INDEXSCAN_MAKINGHEADER","Cr�ation des fichiers index.html absents");
define("_AM_INDEXSCAN_CREATED","index.html cr��");
define("_AM_INDEXSCAN_CREATEDINDEXFILES","Fichier index cr��");

// Added in 1.01
define("_AM_INDEXSCAN_CHECKFORFILES","<tr class='header txtcenter'><h2>Recherche de fichiers avec injection d'IFRAME</h2><p class='txtcenter'>Bien que toutes les utilisations d'frame ne consiste pas en injections.<br />V�rifiez le code dans les fichiers trouv�s avant de les supprimer.</p></tr><hr>");
define("_AM_INDEXSCAN_UNABLETOREADFILE","Impossible d'ouvrir le fichier");
define("_AM_INDEXSCAN_INFECTED","!! Mot IFRAME non trouv� !!");
define("_AM_INDEXSCAN_CLEAN","OK");
define("_AM_INDEXSCAN_INJECTIONSCAN","Scanner des infections d'iframe");

//added in 2.00
define("_AM_INDEXSCAN_SCANNING4MISS","<br />Recherche des fichiers index absents.<br />Attendez SVP.");
define("_AM_INDEXSCAN_CREATINGMISS","<br />Cr�ation des fichiers index manquants.<br />Attendez SVP.");
define("_AM_INDEXSCAN_SCANNING4IFRAME","<br />Recherche d'Iframe et code javascript ins�r�.<br />Attendez SVP.");
define("_AM_INDEXSCAN_FINISDINJECTIONS"," fichier(s) contenant le mot 'iframe' ou 'fromCharCode' indiquant la pr�sence d'Iframe(s) ou de javascript(s) ins�r�(s).<br />V�rifiez si c'est bien le cas en cliquant sur la barre rouge pour voir le code source, avant de prendre toute action corrective.<br /><br />Nombre total de fichiers scann�s :");

// Added in 2.01
define ("_AM_INDEXSCAN_NOTVERIFY"," : Le checksum de ce fichier est diff�rent de l'original !");
define ("_AM_INDEXSCAN_VERIFIED","Le checksum pour le fichier admin/index.php est v�rifi�.");

// Added in 2.03
define ("_AM_INDEXSCAN_CHECKILLEGALFILES","V�rifiez les fichiers"); 
define ("_AM_INDEXSCAN_SCANNING4ILLEGALFILES", "Analyse des fichiers web"); 
define("_AM_INDEXSCAN_MAYBEOK", "Semble �tre OK"); 
define ("_AM_INDEXSCAN_NOTINXOOPSINSTALL", "Fichier(s) non 'Xoops'"); 
define ("_AM_INDEXSCAN_FINISDILLEGAL", " fichiers trouv�s qui ne sont pas de Xoops. Total des fichiers scann�s : "); 
define ("_AM_INDEXSCAN_ILLEGAL_DESC", "Le(s) fichier(s) trouv�(s) ne semble(nt) pas �tre des fichiers Xoops, v�rification r�alis�e par rapport au fichier checkfile.txt dans le dossier 'admin', et par rapport aux types de fichiers d�finis comme autoris�s dans la configuration.<br/>Cela peut �tre des fichiers temporaires ind�sirables, thumbs.db ou des fichiers d'infos.<br/>S'ils ne sont pas ou plus n�cessaires, vous pouvez les ajouter automatiquement dans configuration, ils seront supprim�s lors de la prochaine analyse."); 
define ("_AM_INDEXSCAN_REALLYDELETE", "Etes-vous s�r ?, fichier(s) effac�(s): "); 
define("_AM_INDEXSCAN_CREATEZIP", "Cr�er une archive zip � t�l�charger"); 
define("_AM_INDEXSCAN_CREATINGZIP", "Cr�ation d'une sauvegarde au format zip de la totalit� des dossiers<br/> y compris les fichiers index.<br/>"); 
define("_AM_INDEXSCAN_BACKEDUPDELETEDFROMBACKUP", "Supprimer les fichiers dans le r�pertoire de sauvegarde, sauf les fichiers index.html"); 
define("_AM_INDEXSCAN_BACKEDUP2", "Dossier(s) sauvegard�(s).: "); 
define("_AM_INDEXSCAN_DOWNLOADZIP", "T�l�charger les fichiers index archiv�s au format zip"); 
define("_AM_INDEXSCAN_CREATINGZIPFORDOWNLOAD", "Cr�ation d'une fichier au format zip � t�l�charger"); 
define("_AM_INDEXSCAN_CREATEDINDEXINBACKUP", "Cr�ation d'un fichier index dans le r�pertoire des sauvegardes"); 
define("_AM_INDEXSCAN_CLEANUPDONE", "Nettoyage r�alis� ... !"); 
define("_AM_INDEXSCAN_FILESARECOPIED", " Fichiers ont �t� copi�s dans le r�pertoire de sauvegarde"); 
define("_AM_INDEXSCAN_FILESDELETED", " Fichiers ont �t� effac�s du r�pertoire de sauvegarde"); 
define("_AM_INDEXSCAN_FILESCREATED", " Fichiers index.html ont �t� cr��s dans le r�pertoire de sauvegarde");

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