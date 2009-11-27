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
				}
				#slidingDiv2 {
					display: none;
					height:100px;
					padding:20px;
					margin-top:10px;
				}
				#slidingDiv3 {
					display: none;
					height:100px;
					padding:20px;
					margin-top:10px;
				}
				
				#iframetext {
				display: none;
				height:25px;
				}

				p {
				padding: 0 0 1em;
				}
				
				.indexscan_msg_list {
				margin: 0px;
				padding: 0px;
				}
				
				.indexscan_msg_head {
				padding: 5px 10px;
				cursor: pointer;
				position: relative;
				background-color:#FFCCCC;
				margin:1px;
				width:95%;
				}
				
				.indexscan_msg_body {
				padding: 5px 10px 15px;
				background-color:#F4F4F8;
				}
				
				.indexscan_iframe {
				float: right;
				width: 70%;
				color: red;
				}

				.indexscan_iframe_found {
				background-color:#FF0000;
				color:yellow;
				position:absolute;
				left:92%;
				}
				
				.indexscan_index_notfound {
				position:absolute;
				left:90%;
				color:red;
				font-size: 10px;
				}
				
				.indexscan_created_ok {
				position:absolute;
				left:90%;
				color:green;
				font-size: 10px;
				}
				
				.indexscan_path {
				position:relative;
				color:black;
				font-size: 10px;
				margin:5px;
				}
				
				.indexscan_ok {
				width: 90%;
				color: green;
				}

				.indexscan_show {
				position:absolute;
				left:90%;
				}
		
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
	echo "<td class='even'><center><a onclick='ShowHide();' href='index.php?op=ScanNow'>"._AM_INDEXSCAN_NOW."</a></center></td>";
	echo "<td class='even'><center><a onclick='ShowHide2();' href='index.php?op=CreateNow'>"._AM_INDEXSCAN_CREATE."</a></center></td>";
	echo "<td class='even'><center><a onclick='ShowHide3();' href='index.php?op=injectionScan'>"._AM_INDEXSCAN_INJECTIONSCAN."</a></center></td>";
	echo "<td class='even'><center><a href='../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod="
		.$xoopsModule ->getVar('mid')."'>"._AM_INDEXSCAN_CONFIG."</a></center></td>";
	echo '</tr></table>';
	echo '<div align="center" id="slidingDiv"><img src="loadingwheel.gif" align="center"><br>'._AM_INDEXSCAN_SCANNING4MISS.'</div>';
	echo '<div align="center" id="slidingDiv2"><img src="loadingwheel.gif" align="center"><br>'._AM_INDEXSCAN_CREATINGMISS.'</div>';
	echo '<div align="center" id="slidingDiv3"><img src="loadingwheel.gif" align="center"><br>'._AM_INDEXSCAN_SCANNING4IFRAME.'</div>';
	}
		
// Switch for choises
	global $op,$count;
switch($op) {
	case "ScanNow":
		global $count;
		xoops_cp_header();
		indexScan_Choice();
		print "<div align = 'center' id ='indexscan_result'><br><table align='center' width='95%'";
		print "<tr class='header'><center><th colspan=2><h2>"._AM_INDEXSCAN_HEADER."</h2></center></th></tr>";

/* 
Print the dir found via xoops_look4Files and show where the index.html is not found,
*/
function xoops_PrintPaths ( $xoopsFilePath,$File2Look4,$count ) {
	$xoopsFilePath = substr($xoopsFilePath,7);
	print "<tr><td><span class='indexscan_path'>$xoopsFilePath</span></td><td><span class='indexscan_index_notfound'>".
	_AM_INDEXSCAN_NOTFOUND."<span><br></td></tr>";
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
	print "</table></div>";
	xoops_cp_footer();
                break;
case "CreateNow":
		global $count,$myts;
 		xoops_cp_header();
		indexScan_Choice();
			print "<br><div id='indexscan_result1><table align='center'";
			print "<tr class='header'><center><th colspan=2><h2>"._AM_INDEXSCAN_MAKINGHEADER."</h2></center></th></tr>";
	function xoops_PrintPathsCR ( $xoopsFilePathCR,$File2Look4CR,$countCR ) {
	$xoopsFilePathCRSHORT = substr($xoopsFilePathCR,7);
	xoops_CreateMissingIndexFiles ($xoopsFilePathCR);
	print "<tr><td><span class='indexscan_path'>$xoopsFilePathCRSHORT</span></td><td><span class='indexscan_created_ok'>".
	_AM_INDEXSCAN_CREATED."</span><br></td></tr>";
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
	print "<tr><td colspan=2></td></tr><tr class='header'><th colspan=2><center>$countCR "._AM_INDEXSCAN_CREATEDINDEXFILES."</center></th></tr><tr><td colspan=2></td></tr>";
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
//
//
//

			$path = "../../..";
			$baseDir = basename(dirname($_SERVER['PHP_SELF']));
			$WebPth = 'http://'.$_SERVER['HTTP_HOST'].'/';
			$content_pattern = array("iframe","fromCharCode");
			$content_pattern_exclude = array($path."/modules/indexscan");
				echo _AM_INDEXSCAN_CHECKFORFILES;
			$dir_handle = @opendir($path) or die("Unable to open $path");
				indexScan_Scan4ifrm($dir_handle, $path, '');
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
	global $WebPath, $content_pattern,$content_pattern_exclude;
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
		$ChcekFlag = FALSE;
		$handle = @fopen($dir, "r");
			if ($handle)
			{
			$test=array();
				while (!feof($handle))
				{
				$content = fgets($handle);
					foreach($content_pattern as $key => $value)
					{
						if (stristr($content, $value))
						{
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
		echo "<div class='indexscan_msg_head'>".$dir."<span class='indexscan_iframe_found'>"._AM_INDEXSCAN_INFECTED."</span></div>";	
		echo "<p class='indexscan_msg_body'>";
		echo "<span class='.indexscan_codetext'><textarea rows='30' cols='40' name='code' class='php:nocontrols'>".htmlentities($test)."</textarea>";
	echo "</span></p>"."</div>";
	} // end if
	else
	{
		echo "<div class='indexscan_msg_list'>";
			echo "<div class='indexscan_ok'>".$dir."<span class='indexscan_show'>"._AM_INDEXSCAN_CLEAN."</span>";
		echo "</div></div>";
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