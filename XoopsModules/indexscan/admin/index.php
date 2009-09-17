<?php
/**
 * Index Scan module
 *
 * Use this module to scan your web folders for missing index files. If any found
 * you can create automaticly.
 *
 * The module uses a function to scan for files originally found on php.net examples
 * but modified to suit the needs / standards of xoops 2.3.3 & php5.
 *
 * LICENSE
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * @copyright   The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license       http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author       Michael Albertsen (culex) <http://www.culex.dk>
 * @version      $Id:index.php 2009-07-09 17:06 culex $
 * @since         File available since Release 1.0.0
 */
        include_once 'admin_header.php';
		include XOOPS_ROOT_PATH.'/include/xoopscodes.php';
		$op='';
		
		if (isset($_GET['op']) && $_GET['op'] == 'ScanNow') {
        $op = 'ScanNow';
        }
		if (isset($_GET['op']) && $_GET['op'] == 'CreateNow') {
        $op = 'CreateNow';
        }
		if (isset($_GET['op']) && $_GET['op'] == 'injectionScan') {
        $op = 'injectionScan';
        }
		if (isset($_GET['op']) && $_GET['op'] == '') {
        $op = '';
        }
function indexScan_Choice() {
	global $xoopsModule,$count;
	echo '<table class="outer" width="100%"><tr>';
	echo "<td class='even'><center><a href='index.php?op=ScanNow'>"._AM_INDEXSCAN_NOW."</a></center></td>";
	echo "<td class='even'><center><a href='index.php?op=CreateNow'>"._AM_INDEXSCAN_CREATE."</a></center></td>";
	echo "<td class='even'><center><a href='index.php?op=injectionScan'>"._AM_INDEXSCAN_INJECTIONSCAN."</a></center></td>";
	echo "<td class='even'><center><a href='../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod="
		.$xoopsModule ->getVar('mid')."'>"._AM_INDEXSCAN_CONFIG."</a></center></td>";
	echo '</tr></table>';
	}
		
// Switch for choises
	global $op,$count;
switch($op) {
	case "ScanNow":
		global $count;
		xoops_cp_header();
		indexScan_Choice();
        print "<br><table align='center'";
		print "<tr class='header'><center><th colspan=2><h2>"._AM_INDEXSCAN_HEADER."</h2></center></th></tr>";

/* 
Print the dir found via xoops_look4Files and show where the index.html is not found,
*/
function xoops_PrintPaths ( $xoopsFilePath,$File2Look4,$count ) {
	$xoopsFilePath = substr($xoopsFilePath,7);
	print "<tr><td><small>$xoopsFilePath</small></td><td><font color='#FF0000'><small>".
	_AM_INDEXSCAN_NOTFOUND."</font color></small></td></tr>";
}

// Setting up the search //		
	$RootDir = '../../../';
	$File2Look4 = 'index.html';
	$ReturnFindings = 'xoops_PrintPaths';
	global $xoopsModuleConfig;

// Define wich folders not to scan	
	$Dirs2Exclude = array( $xoopsModuleConfig['exep_01'], $xoopsModuleConfig['exep_02'], $xoopsModuleConfig['exep_03'], $xoopsModuleConfig['exep_04'] );

/*
This function will look through all folder on server starting from $RootDir. And will call back all missing
dirs not having index.html
*/
function xoops_Look4Files ( $RootDir, $File2Look4, $ReturnFindings = NULL, $Dirs2Exclude = array() ) {
	global $count;
		$count = 0;
		$Queue2Array = array( rtrim( $RootDir, '/' ).'/' ); // normalize all paths
  foreach ( $Dirs2Exclude as &$path ) { // &$path Req. PHP ver 5.x and later
		$path = $RootDir.trim( $path, '/' ).'/';
  }
  while ( $BaSe = array_shift( $Queue2Array ) ) {
		$File_Path = $BaSe.$File2Look4;
		$File_Path2 = $BaSe.'index.php';
		$File_Path3 = $BaSe.'index.htm';
		$File_Path4 = $BaSe.'index.php3';
		if (!file_exists( $File_Path ) && !file_exists($File_Path2) && !file_exists($File_Path3) && !file_exists($File_Path4)) { // files not found
	  if ( is_callable( $ReturnFindings ) ) {
	  $count = $count+1;
		$ReturnFindings( $BaSe,$File2Look4,$count ); // callback => CONTINUE
      } else {
        return $File_Path; // return file-path => EXIT
		}
		}
    if ( ( $handle = opendir( $BaSe ) ) ) {
      while ( ( $SubFolder = readdir( $handle ) ) !== FALSE ) {
        if ( is_dir( $BaSe.$SubFolder ) && $SubFolder != '.' && $SubFolder != '..' ) {
          $combined_path = $BaSe.$SubFolder.'/';
          if ( !in_array( $combined_path, $Dirs2Exclude ) ) {
            array_push( $Queue2Array, $combined_path);
			}
			}
			}
			closedir( $handle );
			} // else unable to open directory => NEXT CHILD
			}
		return FALSE; // end of tree.
			}
// $Dirs2Exclude = array( 'modules', './', 'themes' );
	print xoops_Look4Files ( $RootDir, $File2Look4, $ReturnFindings, $Dirs2Exclude );
	print "<tr><td colspan=2></td></tr><tr><th colspan=2><center>$count "._AM_INDEXSCAN_FOUNDMISSING."</center></th></tr><tr><td colspan=2></td></tr>";
	print "</table>";
	xoops_cp_footer();
                break;
case "CreateNow":
		global $count,$myts;
 		xoops_cp_header();
		indexScan_Choice();
			print "<br><table align='center'";
			print "<tr class='header'><center><th colspan=2><h2>"._AM_INDEXSCAN_MAKINGHEADER."</h2></center></th></tr>";
	function xoops_PrintPathsCR ( $xoopsFilePathCR,$File2Look4CR,$countCR ) {
	$xoopsFilePathCRSHORT = substr($xoopsFilePathCR,7);
	xoops_CreateMissingIndexFiles ($xoopsFilePathCR);
	print "<tr><td><small>$xoopsFilePathCRSHORT</small></td><td><font color='#077F00'><small>".
	_AM_INDEXSCAN_CREATED."</font color></small></td></tr>";
}

// Setting up the search //		
	$RootDirCR = '../../../';
	$File2Look4CR = 'index.html';
	$ReturnFindingsCR = 'xoops_PrintPathsCR';
	global $xoopsModuleConfig;

// Define wich folders not to scan	
	$Dirs2ExcludeCR = array( $xoopsModuleConfig['exep_01'], $xoopsModuleConfig['exep_02'], $xoopsModuleConfig['exep_03'], $xoopsModuleConfig['exep_04'] );

/*
This function opens a file called index.html, write content, and saves where not found
*/
function xoops_CreateMissingIndexFiles ($folderUrl) {
$myts =& MyTextSanitizer::getInstance();
file_put_contents($folderUrl.'index.html', "<script>history.go(-1);</script>");
}
/*
This function will look through all folder on server starting from $RootDir. And will call back all missing
dirs not having index.html
*/
function xoops_Look4FilesCR ( $RootDirCR, $File2Look4CR, $ReturnFindingsCR = NULL, $Dirs2ExcludeCR = array() ) {
	global $countCR;
		$countCR = 0;
		$Queue2ArrayCR = array( rtrim( $RootDirCR, '/' ).'/' ); // normalize all paths
  foreach ( $Dirs2ExcludeCR as &$pathCR ) { // &$path Req. PHP ver 5.x and later
		$pathCR = $RootDirCR.trim( $pathCR, '/' ).'/';
  }
  while ( $BaSeCR = array_shift( $Queue2ArrayCR ) ) {
		$File_PathCR = $BaSeCR.$File2Look4CR;
		$File_Path2CR = $BaSeCR.'index.php';
		$File_Path3CR = $BaSeCR.'index.htm';
		$File_Path4CR = $BaSeCR.'index.php3';
		if (!file_exists( $File_PathCR ) && !file_exists($File_Path2CR) && !file_exists($File_Path3CR) && !file_exists($File_Path4CR)) { // files not found
	  if ( is_callable( $ReturnFindingsCR ) ) {
	  $countCR = $countCR+1;
		$ReturnFindingsCR( $BaSeCR,$File2Look4CR,$countCR ); // callback => CONTINUE
      } else {
        return $File_PathCR; // return file-path => EXIT
		}
		}
    if ( ( $handleCR = opendir( $BaSeCR ) ) ) {
      while ( ( $SubFolderCR = readdir( $handleCR ) ) !== FALSE ) {
        if ( is_dir( $BaSeCR.$SubFolderCR ) && $SubFolderCR != '.' && $SubFolderCR != '..' ) {
		  $combined_pathCR = $BaSeCR.$SubFolderCR.'/';
          if ( !in_array( $combined_pathCR, $Dirs2ExcludeCR ) ) {
            array_push( $Queue2ArrayCR, $combined_pathCR);
			}
			}
			}
			closedir( $handleCR );
			} // else unable to open directory => NEXT CHILD
			}
		return FALSE; // end of tree.
			}
// $Dirs2Exclude = array( 'modules', './', 'themes' );
	print xoops_Look4FilesCR ( $RootDirCR, $File2Look4CR, $ReturnFindingsCR, $Dirs2ExcludeCR );
	print "<tr><td colspan=2></td></tr><tr><th colspan=2><center>$countCR "._AM_INDEXSCAN_CREATEDINDEXFILES."</center></th></tr><tr><td colspan=2></td></tr>";
	print "</table>";
	
		xoops_cp_footer();		
                break;
		default:
				xoops_cp_header();
                indexScan_Choice();
				xoops_cp_footer();
                break;	
		
		case "injectionScan":	
/* Function to scan your website folders for index.html <iframe> injections

			Thanks to Ghia for recommending this feature.

* @copyright   The XOOPS Project http://sourceforge.net/projects/xoops/
* @license     http://www.fsf.org/copyleft/gpl.html GNU public license
* @author      Michael Albertsen (culex) <http://www.culex.dk>
* @version     $Id:index.php 2009-15-09 21:00 culex $
* @since       File available since Release 1.0.1
*/
		xoops_cp_header();
		indexScan_Choice();
//
//
//

$path = "../../..";
$baseDir = basename(dirname($_SERVER['PHP_SELF']));
$WebPath = 'http://'.$_SERVER['HTTP_HOST'].'/';
$content_pattern = "iframe";

//echo "";
echo "<table width='100%' align='center' class='outer'>";
echo _AM_INDEXSCAN_CHECKFORFILES;
$dir_handle = @opendir($path) or die("Unable to open $path");
echo "<br><small>";

indexScan_Scan4ifrm($dir_handle, $path, '');
echo "</table>";
	xoops_cp_footer();
break;	
}

/*
* @Descript.   This function scans through the files in your webfolders
*			   And lists files containing the word iframe.
* @copyright   The XOOPS Project http://sourceforge.net/projects/xoops/
* @license     http://www.fsf.org/copyleft/gpl.html GNU public license
* @author      Michael Albertsen (culex) <http://www.culex.dk>
* @version     $Id:index.php 2009-17-09 21:00 culex $
* @since       File available since Release 1.0.1
*/

function indexScan_Scan4ifrm($dir_handle,$path, $WebPth)
{
global $WebPath, $content_pattern;
while (false !== ($file = readdir($dir_handle)))
{
$dir = $path.'/'.$file;
if(is_dir($dir) && $file != '.' && $file !='..' )
{
$handle = @opendir($dir) or die(_AM_INDEXSCAN_UNABLETOREADFILE.$file);
$WebRef = $file.'/';
indexScan_Scan4ifrm($handle, $dir, $WebRef);
}
elseif($file != '.' && $file !='..')
{
if(preg_match('/^index+/',$file) OR preg_match('/^mainfile+/',$file) OR preg_match('/^header+/',$file) OR preg_match('/^footer+/',$file))
{
$ChcekFlag = FALSE;

$handle = @fopen($dir, "r");
if ($handle)
{
while (!feof($handle))
{
$content = fgets($handle);
if(stristr($content, $content_pattern))
{
$test = stristr($content, $content_pattern);
echo "<tr><td></td></tr><tr><td><span style='float: right; width: 90%; color: red;'><small>".$test."</span></small></td>";
$ChcekFlag = TRUE;
}
}
}
fclose($handle);
if($ChcekFlag)
{
echo "<tr><td><small><strong><a href='".$dir."'>".$dir."</a></td><td NOWRAP><span style='background-color: #FF0000'><font color='yellow'> "._AM_INDEXSCAN_INFECTED."</span></strong><br><br></small></td></tr>";
}
else
{
echo "<tr><td><small><font color='black'>".$dir."</font></td><td></td><td><font color='green'> "._AM_INDEXSCAN_CLEAN."</font><br></small></td></tr>";
}
}
}
}
}
?>