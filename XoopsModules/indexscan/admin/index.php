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
 * @version      $Id:index.php 2009-11-27 13:28 culex $
 * @since         File available since Release 2.0.0
 */
        include_once 'admin_header.php';
		include XOOPS_ROOT_PATH.'/include/xoopscodes.php';	
		echo '<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>';
		
		echo '<style>
				#slidingDiv {
					display: none;
					height:100px;
					padding:20px;
					margin-top:10px;
					font-size: 18 px;
					text-align:center;
				}
				#slidingDiv2 {
					display: none;
					height:100px;
					padding:20px;
					margin-top:10px;
					font-size: 18 px;
					text-align:center;
				}
				#slidingDiv3 {
					display: none;
					height:100px;
					padding:20px;
					margin-top:10px;
					font-size: 18 px;
					text-align:center;
				}
				
				p {
				padding: 0 0 1em;
				}
				
				.indexscan_msg_list {
				margin: 0px;
				padding: 0px;
				font-size: 10px;
				}
				
				.indexscan_msg_head {
				padding: 5px 10px;
				cursor: pointer;
				background-color:#FFCCCC;
				margin:1px;
				font-size: 10px;
				}
				
				.indexscan_msg_body {
				padding: 5px 10px 15px;
				background-color:#F4F4F8;
				font-size: 10px;
				}
				
				.indexscan_index_notfound {
				position:relative;
				top:5px;
				float:right;
				color:red;
				font-size: 10px;
				}
				
				.indexscan_path {
				position:relative;
				top:5px;
				color:black;
				font-size: 10px;
				}
				
				.indexscan_created_ok {
				position:relative;
				top: 5px;
				float:right;
				color:green;
				font-size: 10px;
				}			
				
				.indexscan_iframe_found {
				text-align:left;
				}		

				.indexscan_iframe_found2 {
				position:absolute;
				left:85%;
				}
				
				.indexscan_ok {
				position:relative;
				text-align:left;
				color: green;
				font-size: 10px;
				}				

				.indexscan_img
				{
				width:12px;
				height:12px;
				border:0;
				margin:0 10px; 
				float:inherit;
				}				
				
				.indexscan_show {
				position:absolute;
				left:95%;
				}			
				.txtcenter, td.txtcenter, tr.txtcenter h2 {text-align:center; !important}
				</style>';
		
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
	echo "<td class='even txtcenter'><a onclick='ShowHide();' href='index.php?op=ScanNow'>"._AM_INDEXSCAN_NOW."</a></td>";
	echo "<td class='even txtcenter'><a onclick='ShowHide2();' href='index.php?op=CreateNow'>"._AM_INDEXSCAN_CREATE."</a></td>";
	echo "<td class='even txtcenter'><a onclick='ShowHide3();' href='index.php?op=injectionScan'>"._AM_INDEXSCAN_INJECTIONSCAN."</a></td>";
	echo "<td class='even txtcenter'><a href='../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod="
		.$xoopsModule ->getVar('mid')."'>"._AM_INDEXSCAN_CONFIG."</a></td>";
	echo '</tr></table>';
	echo '<div id="slidingDiv"><img src="spinner.gif"><br />'._AM_INDEXSCAN_SCANNING4MISS.'</div>';
	echo '<div id="slidingDiv2"><img src="spinner.gif"><br />'._AM_INDEXSCAN_CREATINGMISS.'</div>';
	echo '<div id="slidingDiv3"><img src="spinner.gif"><br />'._AM_INDEXSCAN_SCANNING4IFRAME.'</div>';
	}
		
// Switch for choises
	global $op,$count;
switch($op) {
	case "ScanNow":
		global $count;
		xoops_cp_header();
		indexScan_Choice();
		print "<div class='txtcenter' id ='indexscan_result' width='100%'><table class='outer' width='100%'>";
		print "<tr class='header'><th class='txtcenter' colspan=2><h2>"._AM_INDEXSCAN_HEADER."</h2></th></tr>";
		print "<tr><td></td></tr>";

/* 
Print the dir found via xoops_look4Files and show where the index.html is not found,
*/
function xoops_PrintPaths ( $xoopsFilePath,$File2Look4,$count ) {
	$xoopsFilePath = substr($xoopsFilePath,7);
	print "<tr><td><span class='indexscan_path'>$xoopsFilePath</span></td><td><span class='indexscan_index_notfound'>".
	_AM_INDEXSCAN_NOTFOUND."</span></td></tr>";
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
	print "<tr><td colspan=2></td></tr><tr><td colspan=2></td></tr><tr><td colspan=2></td></tr>";
	print "<tr><td colspan=2></td></tr><tr><th class='txtcenter' colspan=2>$count "._AM_INDEXSCAN_FOUNDMISSING."</th></tr><tr><td colspan=2></td></tr>";
	print "</table></div>";
	xoops_cp_footer();
                break;
case "CreateNow":
		global $count,$myts;
 		xoops_cp_header();
		indexScan_Choice();
			print "<div class='txtcenter' id ='indexscan_result' width='100%'><table class='outer' width='100%'>";
			print "<tr class='header txtcenter'><th colspan=2><h2>"._AM_INDEXSCAN_MAKINGHEADER."</h2></th></tr>";
			print "<tr class='header txtcenter'><td colspan=2></td></tr>";
	function xoops_PrintPathsCR ( $xoopsFilePathCR,$File2Look4CR,$countCR ) {
	$xoopsFilePathCRSHORT = substr($xoopsFilePathCR,7);
	xoops_CreateMissingIndexFiles ($xoopsFilePathCR);
	print "<tr><td><span class='indexscan_path'>$xoopsFilePathCRSHORT</span></td><td><span class='indexscan_created_ok'>".
	_AM_INDEXSCAN_CREATED."</span><br><td></tr>";
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
	print "<tr><td colspan=2></td></tr><tr><td colspan=2></td></tr><tr><td colspan=2></td></tr>";
	print "<tr><td colspan=2></td></tr><tr><th class='txtcenter' colspan=2>$countCR "._AM_INDEXSCAN_CREATEDINDEXFILES."</th></tr><tr><td colspan=2></td></tr>";
	print "</table></div>";
	
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
		print "<div id ='indexscan_result' width='100%'><table class='outer' width='100%'>";

		$path = "../../..";
			$baseDir = basename(dirname($_SERVER['PHP_SELF']));
			$WebPth = 'http://'.$_SERVER['HTTP_HOST'].'/';
			$content_pattern = array("iframe","fromCharCode","%69%66%72%61%6D%65","document.write(unescape(");
			$content_pattern_exclude = array($path."/modules/indexscan");
			$count_files = 0;
			$count_injections = 0;
				echo _AM_INDEXSCAN_CHECKFORFILES;
			$dir_handle = @opendir($path) or die("Unable to open $path");
				indexScan_Scan4ifrm($dir_handle, $path, '');
						print "<tr><td colspan=2></td></tr><tr><td colspan=2></td></tr><tr><td colspan=2></td></tr>";
	print "<tr><td colspan=2></td></tr><tr><th colspan=2><span style='position:relative; text-align:left; font-size:14px; font-weight:bold;'>$count_injections</span><span style = 'position:relative; text-align:left; font-size:10px;'>"._AM_INDEXSCAN_FINISDINJECTIONS."</span><span style='font-size:14px; font-weight:bold;'> $count_files</span></th></tr><tr><td colspan=2></td></tr>";
	echo "</table></div>";
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
	global $WebPath, $content_pattern,$content_pattern_exclude,$count_files,$count_injections;
		while (false !== ($file = readdir($dir_handle)))
		{
		$dir = $path.'/'.$file;
			if(is_dir($dir) && $file != '.' && $file !='..' )
			{	
				$handle = @opendir($dir) or die(_AM_INDEXSCAN_UNABLETOREADFILE.$file);
				$WebRef = $file.'/';
					if ( !in_array( $dir, $content_pattern_exclude ) ) {
					indexScan_Scan4ifrm($handle, $dir, $WebRef);
					} // end if
					} // end if
					
	elseif($file != '.' && $file !='..')
	{
		if(preg_match('/^index+/',$file) OR preg_match('/^mainfile+/',$file) OR preg_match('/^header+/',$file) OR preg_match('/^footer+/',$file))
		{
		$count_files++;
		$ChcekFlag = FALSE;
		$handle = @fopen($dir, "r");
			if ($handle)
			{
			$test=array();
				while (!feof($handle))
				{
				$content = fgets($handle);
				$indexscan_type ='';
					foreach($content_pattern as $key => $value)
					{
						if (stristr($content, $value))
						{
						if ($value == 'iframe') {
						$indexscan_type = 'Iframe';
						}
						if ($value == 'fromCharCode') {
						$indexscan_type = 'Encoded Javascript';
						}
						if ($value == '%69%66%72%61%6D%65') {
						$indexscan_type = 'Encoded Javascript';
						}
						if ($value == 'document.write(unescape(') {
						$indexscan_type = 'Encoded Javascript';
						}						
						$count_injections++;
						$count_files++;
						$ChcekFlag = TRUE;
						rewind($handle);
						$test ='';
							while (!feof($handle)) { 
							$test .= fread($handle, 8192);
							} // end while
						} // IF (stristr(
					} //foreach
				} // While (!feof($handle)
			} // IF ($handle)

	fclose($handle);
	if($ChcekFlag)
	{
	echo "<div class='indexscan_msg_list'>";
		echo "<div class='indexscan_msg_head'>".$dir."<img class='indexscan_img' src='html.png'></img><span class='indexscan_iframe_found2'>".$indexscan_type._AM_INDEXSCAN_INFECTED."</span></div>";	
		echo "<p class='indexscan_msg_body'>";
		echo "<span class='.indexscan_codetext'><textarea rows='30' cols='40' name='code' class='php:nocontrols'>".htmlentities($test)."</textarea>";
	echo "</span></p>"."</div>";
	} // end if
	else
	{
		echo "<div class='indexscan_msg_list'>";
			echo "<div class='indexscan_ok'>".$dir."<span class='indexscan_show'>"._AM_INDEXSCAN_CLEAN."</span></div>";
		echo "</div>";
	}		// end else
		} 	// end if
	} 		// end elseif
		} 	// end while
} 			// end function


// show hide for lazy load image and message
echo '<script type="text/javascript">

		// Showing or Hiding the progress div
		function ShowHide(){
			$("#slidingDiv").animate({"height": "toggle"}, { duration: 1000 });
				}
		function ShowHide2(){
			$("#slidingDiv2").animate({"height": "toggle"}, { duration: 1000 });
				}
		function ShowHide3(){
			$("#slidingDiv3").animate({"height": "toggle"}, { duration: 1000 });
				}
			</script>';

// jquery show/hide for divs used for scanning
echo '<script type="text/javascript">
	$(document).ready(function()
	{
	//hide the all of the element with class msg_body
  $(".indexscan_msg_body").hide();
  
  //toggle the componenet with class msg_body
  $(".indexscan_msg_head").click(function()
  {
    $(this).next(".indexscan_msg_body").slideToggle(600);
  });
});
</script>';

// style for source code
echo '<link type="text/css" rel="stylesheet" href="js/Styles/SyntaxHighlighter.css"></link>
<script language="javascript" src="js/Scripts/shCore.js"></script>
<script language="javascript" src="js/Scripts/shBrushCSharp.js"></script>
<script language="javascript" src="js/Scripts/shBrushPhp.js"></script>
<script language="javascript">
dp.SyntaxHighlighter.ClipboardSwf = "js/Scripts/clipboard.swf";
dp.SyntaxHighlighter.HighlightAll("code");
</script>';
?>