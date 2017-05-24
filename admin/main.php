<?php
/**
 * Index Scan module
 *
 * Use this module to scan your web folders for missing index files. If any found
 * you can create automatically.
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
 * @since         File available since Release 2.0.0
 */
        include_once __DIR__ .'/admin_header.php';
        include XOOPS_ROOT_PATH.'/include/xoopscodes.php';
        include XOOPS_ROOT_PATH.'/modules/indexscan/admin/md5parser.php';
        include XOOPS_ROOT_PATH.'/modules/indexscan/class/class.php';
        echo '<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>';
        echo '<script type="text/javascript" src="js/confirm.js"></script>';
        unset($_REQUEST);
        echo '<style>
                #slidingDiv {
                    display: none;
                    height:100px;
                    padding:20px;
                    margin-top:10px;
                    font-size: 18 px;
                }
                #slidingDiv2 {
                    display: none;
                    height:100px;
                    padding:20px;
                    margin-top:10px;
                    font-size: 18 px;
                }
                #slidingDiv3 {
                    display: none;
                    height:100px;
                    padding:20px;
                    margin-top:10px;
                    font-size: 18 px;
                }

                #slidingDiv4 {
                    display: none;
                    height:100px;
                    padding:20px;
                    margin-top:10px;
                    font-size: 18 px;
                }

                #slidingDiv5 {
                    display: none;
                    height:100px;
                    padding:20px;
                    margin-top:10px;
                    font-size: 18 px;
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

                .indexscan_suspecious {
                position:relative;
                background-color:FF1F1F;
                text-align:left;
                color:white;
                font-size: 10px;
                }

                .indexscan_delete {
                position:absolute;
                left:1%;
                }

                .indexscan_notxoopsinstall {
                position:absolute;
                background-color:FF1F1F;
                left:85%;
                color:white;
                font-size: 10px;
                }

                .indexscan_maybeok {
                position:absolute;
                left:85%;
                color:black;
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

                #indexscan_verifyMsg {
                height:100px;
                padding:20px;
                margin-top:10px;
                border-color: red;
                border-style: solid;
                border-size:1px;
                font-family: arial;
                font-size: 10px;
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
        if (isset($_GET['op']) && $_GET['op'] == 'checkillegalfiles') {
            $op = 'CheckIllegalFiles';
        }
        if (isset($_GET['op']) && $_GET['op'] == 'deleteFiles') {
            $op = 'deletefiles';
        }
        if (isset($_GET['op']) && $_GET['op'] == 'createzip') {
            $op = 'createzip';
        }
        if (isset($_GET['op']) && $_GET['op'] == 'downloadzip') {
            $op = 'downloadzip';
        }
        if (isset($_GET['op']) && $_GET['op'] == '') {
            $op = '';
        }

    function indexScan_Choice()
    {
        global $xoopsModule,$count,$verifyMessage;
        echo '<table class="outer" width="100%"><tr>';
        echo "<td class='even'><center><a onclick='ShowHide();' href='index.php?op=ScanNow'>"._AM_INDEXSCAN_NOW.'</a></center></td>';
        echo "<td class='even'><center><a onclick='ShowHide2();' href='index.php?op=CreateNow'>"._AM_INDEXSCAN_CREATE.'</a></center></td>';
        echo "<td class='even'><center><a onclick='ShowHide3();' href='index.php?op=injectionScan'>"._AM_INDEXSCAN_INJECTIONSCAN.'</a></center></td>';
        echo "<td class='even'><center><a onclick='ShowHide4();' href='index.php?op=checkillegalfiles'>"._AM_INDEXSCAN_CHECKILLEGALFILES.'</a></center></td>';
        echo "<td class='even'><center><a onclick='ShowHide5();' href='index.php?op=createzip'>"._AM_INDEXSCAN_CREATEZIP.'</a></center></td>';
        echo "<td class='even'><center><a href='../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod="
        .$xoopsModule ->getVar('mid')."'>"._AM_INDEXSCAN_CONFIG.'</a></center></td>';
        echo '</tr></table>';
        if ($verifyMessage !='') {
            echo '<div align="center" id="indexscan_verifyMsg"><br>'.$verifyMessage.'</div>';
        } else {
        };
        echo '<div align="center" id="slidingDiv"><img src="spinner.gif" align="center"><br>'._AM_INDEXSCAN_SCANNING4MISS.'</div>';
        echo '<div align="center" id="slidingDiv2"><img src="spinner.gif" align="center"><br>'._AM_INDEXSCAN_CREATINGMISS.'</div>';
        echo '<div align="center" id="slidingDiv3"><img src="spinner.gif" align="center"><br>'._AM_INDEXSCAN_SCANNING4IFRAME.'</div>';
        echo '<div align="center" id="slidingDiv4"><img src="spinner.gif" align="center"><br>'._AM_INDEXSCAN_SCANNING4ILLEGALFILES.'</div>';
        echo '<div align="center" id="slidingDiv5"><img src="spinner.gif" align="center"><br>'._AM_INDEXSCAN_CREATINGZIP.'</div>';
    }

// Switch for choises
    global $op,$count;
switch ($op) {
    case 'ScanNow':
        global $count;
        xoops_cp_header();
//        indexScan_Choice();
        print "<div align = 'center' id ='indexscan_result' width='100%'><table class='outer' width='100%'>";
        print "<tr class='header'><center><th colspan=2><h2>"._AM_INDEXSCAN_HEADER.'</h2></center></th></tr>';
        print '<tr><center><td></center></td></tr>';

/*
Print the dir found via xoops_look4Files and show where the index.html is not found,
*/
function xoops_PrintPaths($xoopsFilePath, $File2Look4, $count)
{
    $xoopsFilePath = substr($xoopsFilePath, 7);
    print "<tr><td><span class='indexscan_path'>$xoopsFilePath</span></td><td><span class='indexscan_index_notfound'>".
    _AM_INDEXSCAN_NOTFOUND.'</span></td></tr>';
}

// Setting up the search //
        global $xoopsModuleConfig;
        $RootDir = indexscan_GetModuleOption('indexscan_rootorsub');
    $File2Look4 = 'index.html';
    $ReturnFindings = 'xoops_PrintPaths';
    $Dirs2Exclude = array( $xoopsModuleConfig['exep_01'], $xoopsModuleConfig['exep_02'], $xoopsModuleConfig['exep_03'], $xoopsModuleConfig['exep_04'] );

/*
This function will look through all folder on server starting from $RootDir. And will call back all missing
dirs not having index.html
*/
function xoops_Look4Files($RootDir, $File2Look4, $ReturnFindings = null, $Dirs2Exclude = array())
{
    global $count;
    $count = 0;
    $Queue2Array = array( rtrim($RootDir, '/').'/' ); // normalize all paths
  foreach ($Dirs2Exclude as &$path) { // &$path Req. PHP ver 5.x and later
        $path = $RootDir.trim($path, '/').'/';
  }
    while ($BaSe = array_shift($Queue2Array)) {
        $File_Path = $BaSe.$File2Look4;
        $File_Path2 = $BaSe.'index.php';
        $File_Path3 = $BaSe.'index.htm';
        $File_Path4 = $BaSe.'index.php3';
        if (!file_exists($File_Path) && !file_exists($File_Path2) && !file_exists($File_Path3) && !file_exists($File_Path4)) { // files not found
      if (is_callable($ReturnFindings)) {
          $count = $count+1;
          $ReturnFindings($BaSe, $File2Look4, $count); // callback => CONTINUE
      } else {
          return $File_Path; // return file-path => EXIT
      }
        }
        if ($handle = opendir($BaSe)) {
            while (($SubFolder = readdir($handle)) !== false) {
                if (is_dir($BaSe.$SubFolder) && $SubFolder != '.' && $SubFolder != '..') {
                    $combined_path = $BaSe.$SubFolder.'/';
                    if (!in_array($combined_path, $Dirs2Exclude)) {
                        array_push($Queue2Array, $combined_path);
                    }
                }
            }
            closedir($handle);
        } // else unable to open directory => NEXT CHILD
    }

    return false; // end of tree.
}
// $Dirs2Exclude = array( 'modules', './', 'themes' );
    print xoops_Look4Files($RootDir, $File2Look4, $ReturnFindings, $Dirs2Exclude);
    print '<tr><td colspan=2></td></tr><tr><td colspan=2><center></center></td></tr><tr><td colspan=2></td></tr>';
    print "<tr><td colspan=2></td></tr><tr><th colspan=2><center>$count "._AM_INDEXSCAN_FOUNDMISSING.'</center></th></tr><tr><td colspan=2></td></tr>';
    print '</table></div>';
    xoops_cp_footer();
                break;
case 'CreateNow':
        global $count,$myts;
         xoops_cp_header();
//        indexScan_Choice();
            print "<div align = 'center' id ='indexscan_result' width='100%'><table class='outer' width='100%'>";
            print "<tr class='header'><center><th colspan=2><h2>"._AM_INDEXSCAN_MAKINGHEADER.'</h2></center></th></tr>';
            print "<tr class='header'><center><td colspan=2></center></td></tr>";
    function xoops_PrintPathsCR($xoopsFilePathCR, $File2Look4CR, $countCR)
    {
        $xoopsFilePathCRSHORT = substr($xoopsFilePathCR, 7);
        xoops_CreateMissingIndexFiles($xoopsFilePathCR);
        print "<tr><td><span class='indexscan_path'>$xoopsFilePathCRSHORT</span></td><td><span class='indexscan_created_ok'>".
    _AM_INDEXSCAN_CREATED.'</span><br><td></tr>';
    }

// Setting up the search //

    $File2Look4CR = 'index.html';
    $ReturnFindingsCR = 'xoops_PrintPathsCR';
    $RootDirCR = indexscan_GetModuleOption('indexscan_rootorsub');

// Define wich folders not to scan
    $Dirs2ExcludeCR = array( $xoopsModuleConfig['exep_01'], $xoopsModuleConfig['exep_02'], $xoopsModuleConfig['exep_03'], $xoopsModuleConfig['exep_04'] );

/*
This function opens a file called index.html, write content, and saves where not found
*/
function xoops_CreateMissingIndexFiles($folderUrl)
{
    $myts = MyTextSanitizer::getInstance();
    file_put_contents($folderUrl.'index.html', '<script>history.go(-1);</script>');
}

/*
This function will look through all folder on server starting from $RootDir. And will call back all missing
dirs not having index.html
*/
function xoops_Look4FilesCR($RootDirCR, $File2Look4CR, $ReturnFindingsCR = null, $Dirs2ExcludeCR = array())
{
    global $countCR;
    $countCR = 0;
    $Queue2ArrayCR = array( rtrim($RootDirCR, '/').'/' ); // normalize all paths
  foreach ($Dirs2ExcludeCR as &$pathCR) { // &$path Req. PHP ver 5.x and later
        $pathCR = $RootDirCR.trim($pathCR, '/').'/';
  }
    while ($BaSeCR = array_shift($Queue2ArrayCR)) {
        $File_PathCR = $BaSeCR.$File2Look4CR;
        $File_Path2CR = $BaSeCR.'index.php';
        $File_Path3CR = $BaSeCR.'index.htm';
        $File_Path4CR = $BaSeCR.'index.php3';
        if (!file_exists($File_PathCR) && !file_exists($File_Path2CR) && !file_exists($File_Path3CR) && !file_exists($File_Path4CR)) { // files not found
      if (is_callable($ReturnFindingsCR)) {
          $countCR = $countCR+1;
          $ReturnFindingsCR($BaSeCR, $File2Look4CR, $countCR); // callback => CONTINUE
      } else {
          return $File_PathCR; // return file-path => EXIT
      }
        }
        if ($handleCR = opendir($BaSeCR)) {
            while (($SubFolderCR = readdir($handleCR)) !== false) {
                if (is_dir($BaSeCR.$SubFolderCR) && $SubFolderCR != '.' && $SubFolderCR != '..') {
                    $combined_pathCR = $BaSeCR.$SubFolderCR.'/';
                    if (!in_array($combined_pathCR, $Dirs2ExcludeCR)) {
                        array_push($Queue2ArrayCR, $combined_pathCR);
                    }
                }
            }
            closedir($handleCR);
        } // else unable to open directory => NEXT CHILD
    }

    return false; // end of tree.
}

    print xoops_Look4FilesCR($RootDirCR, $File2Look4CR, $ReturnFindingsCR, $Dirs2ExcludeCR);
    print '<tr><td colspan=2></td></tr><tr><td colspan=2><center></center></td></tr><tr><td colspan=2></td></tr>';
    print "<tr><td colspan=2></td></tr><tr><th colspan=2><center>$countCR "._AM_INDEXSCAN_CREATEDINDEXFILES.'</center></th></tr><tr><td colspan=2></td></tr>';
    print '</table></div>';

        xoops_cp_footer();
                break;
        default:
                xoops_cp_header();
//                indexScan_Choice();
                xoops_cp_footer();
                break;

case 'injectionScan':

    /* Function to scan your website folders for index.html <iframe> injections

                Thanks to Ghia for recommending this feature.

    * @copyright   The XOOPS Project http://sourceforge.net/projects/xoops/
    * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
    * @author      Michael Albertsen (culex) <http://www.culex.dk>
    * @since       File available since Release 1.0.1
    */
            xoops_cp_header();
//            indexScan_Choice();
            print "<div id ='indexscan_result' width='100%'><table class='outer' width='100%'>";
            global $xoopsModuleConfig;
            $path = substr_replace(indexscan_GetModuleOption('indexscan_rootorsub'), '', -1);

                $baseDir = basename(dirname($_SERVER['PHP_SELF']));
                $WebPth = 'http://'.$_SERVER['HTTP_HOST'].'/';
                $content_pattern = array('iframe','fromCharCode','%69%66%72%61%6D%65','document.write(unescape(');
                    $tmp = pathinfo(XOOPS_ROOT_PATH.'/mainfile.php');
                    $tmp1 = dirname(dirname(XOOPS_ROOT_PATH.'/mainfile.php'));
                    $tmp2 = str_replace($tmp1, '', $tmp);
                    $file = $tmp2['dirname'].'/modules/indexscan/admin/index.php';
                    $fileSub = str_replace("\\", '/', $file);
                    $fileSubs = '../../../..'.$fileSub;
                $content_pattern_exclude = array('../../../modules/indexscan/admin/index.php',$fileSubs);
                $count_files = 0;
                $count_injections = 0;
                    echo _AM_INDEXSCAN_CHECKFORFILES;
                $dir_handle = @opendir($path) || die("Unable to open $path");
                    indexScan_Scan4ifrm($dir_handle, $path, '');
        print '<tr><td colspan=2></td></tr><tr><td colspan=2><center></center></td></tr><tr><td colspan=2></td></tr>';
        print "<tr><td colspan=2></td></tr><tr><th colspan=2><span style='position:relative;text-align:left;font-size:14px;font-weight:bold;'>$count_injections</span><span style = 'position:relative;text-align:left;font-size:10px;'>"._AM_INDEXSCAN_FINISDINJECTIONS."</span><span style='font-size:14px;font-weight:bold;'> $count_files</span></th></tr><tr><td colspan=2></td></tr>";
        echo '</table></div>';
        xoops_cp_footer();
break;
case 'CheckIllegalFiles':
    global $ignores;
    xoops_cp_header();
//    indexScan_Choice();
    $count_xoopsfiles = 0;
    $count_illegalfiles = 0;
    $ci = 0;

    echo "<div id ='indexscan_result' width='100%'><table class='outer' width='100%'>";
    $ignores = array();
      $tmps = file('filecheck.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      foreach ($tmps as $lines) {
          list($line, $sum) = explode(':', $lines);
          $line = str_replace('\\', '/', $line);
          $line = str_replace('\s', '', $line);
          $line = str_replace('\t', '', $line);
          $line = str_replace('\r', '', $line);
          array_push($ignores, $line);
      }

    $dir_iterator = new RecursiveDirectoryIterator(substr_replace(indexscan_GetModuleOption('indexscan_rootorsub'), '', -1));
    $iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);
    // could use CHILD_FIRST if you so wish

    foreach ($iterator as $ff) {
        if ($ff->IsFile()) {
            ++$count_xoopsfiles;
            $ff = str_replace('.\\', '', $ff);
            $ff = str_replace('./', '', $ff);
            $ff = str_replace('....', '', $ff);
            $ff = str_replace('...', '', $ff);
            $ff = str_replace('\\', '/', $ff);
            $ff = str_replace('\s', '', $ff);
            $ff = str_replace('\t', '', $ff);
            $ff = str_replace('\r', '', $ff);
            $ffArray = explode('.', $ff);
            $extension = end($ffArray);
            indexscan_get_files($ff, $extension);
        } else {
            continue;
        }
    }
    echo "<center><span style='position:relative;text-align:left;font-size:14px;font-weight:bold;'>".$count_illegalfiles."</span><span style = 'position:relative;text-align:left;font-size:10px;'>"._AM_INDEXSCAN_FINISDILLEGAL."</span><span style='font-size:14px;font-weight:bold;'>".$count_xoopsfiles."</span><br><br><span style = 'position:relative;text-align:left;font-size:10px;'>"._AM_INDEXSCAN_ILLEGAL_DESC.'</span></center></table></div>';
    xoops_cp_footer();
break;

case 'createzip':
    xoops_cp_header();
//        indexScan_Choice();
    $filecopy=0;
    $filedeleted=0;
    $filecreated=0;
            echo "<div id ='indexscan_result' width='100%'><table class='outer' width='100%'>";
    $module = indexscan_GetModuleOption('indexscan_frombackup');
//    $src = substr_replace(indexscan_GetModuleOption('indexscan_rootorsub'), '', -1).'/modules/indexscan/admin/folder2backup/'.$module;
    $src = substr_replace(indexscan_GetModuleOption('indexscan_rootorsub'), '', -1);
    $dst = 'backup/'.$module;
        indexscan_CreateBackup($src, $dst);
    echo "<tr><td colspan=2></td></tr><tr class='header'><td colspan=2><br><br><center><a href='main.php?op=downloadzip'>"._AM_INDEXSCAN_DOWNLOADZIP.'</a></center></td></tr>';
    echo "<br><br><br><tr><td colspan=2></td></tr><tr><td colspan=2><center><span style='position:relative;text-align:left;font-size:14px;font-weight:bold;'>".$filecopy."</span><span style = 'position:relative;text-align:left;font-size:10px;'>"._AM_INDEXSCAN_FILESARECOPIED."</span><br><span style='font-size:14px;font-weight:bold;'>".$filedeleted."</span><span style = 'position:relative;text-align:left;font-size:10px;'>"._AM_INDEXSCAN_FILESDELETED."</span><br><span style='font-size:14px;font-weight:bold;'>".$filecreated."</span><span style = 'position:relative;text-align:left;font-size:10px;'>"._AM_INDEXSCAN_FILESCREATED.'</span></center></tr></td></table></div><br><br>';
            indexscan_cleanBackUp();
        xoops_cp_footer();
break;

case 'downloadzip':
    xoops_cp_header();
//        indexScan_Choice();
    indexscan_createzipfile();
    xoops_cp_footer();
break;
}

/*
* @Descript.   This function scans through the files in your webfolders
*              And lists files containing the word iframe.
* @copyright   The XOOPS Project http://sourceforge.net/projects/xoops/
* @license     http://www.fsf.org/copyleft/gpl.html GNU public license
* @author      Michael Albertsen (culex) <http://www.culex.dk>
* @since       File available since Release 1.0.1
*/

function indexScan_Scan4ifrm($dir_handle, $path, $WebPth)
{
    global $WebPath, $content_pattern,$content_pattern_exclude,$count_files,$count_injections;
    while (false !== ($file = readdir($dir_handle))) {
        $dir = $path.'/'.$file;
        if (is_dir($dir) && $file != '.' && $file !='..') {
            $handle = @opendir($dir) || die(_AM_INDEXSCAN_UNABLETOREADFILE.$file);
            $WebRef = $file.'/';
            indexScan_Scan4ifrm($handle, $dir, $WebRef);
        } // end if

    elseif ($file != '.' && $file !='..') {
        if (!in_array($dir, $content_pattern_exclude)) {
            if (preg_match('/^index+/', $file) || preg_match('/^mainfile+/', $file) || preg_match('/^header+/', $file) || preg_match('/^footer+/', $file)) {
                ++$count_files;
                $ChcekFlag = false;
                $handle = @fopen($dir, 'r');
                if ($handle) {
                    $test=array();
                    while (!feof($handle)) {
                        $content = fgets($handle);
                        $indexscan_type ='';
                        foreach ($content_pattern as $key => $value) {
                            if (stristr($content, $value)) {
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
                                ++$count_injections;
                                ++$count_files;
                                $ChcekFlag = true;
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
                if ($ChcekFlag) {
                    echo "<div class='indexscan_msg_list'>";
                    echo "<div class='indexscan_msg_head'>".$dir."<img class='indexscan_img' src='html.png'></img><span class='indexscan_iframe_found2'>".$indexscan_type.' '._AM_INDEXSCAN_INFECTED.'</span></div>';
                    echo "<p class='indexscan_msg_body'>";
                    echo "<span class='.indexscan_codetext'><textarea rows='30' cols='40' name='code' class='php:nocontrols'>".htmlentities($test).'</textarea>';
                    echo '</span></p>'.'</div>';
                } // end if
    else {
        echo "<div class='indexscan_msg_list'>";
        echo "<div class='indexscan_ok'>".$dir."<span class='indexscan_show'>"._AM_INDEXSCAN_CLEAN.'</span>';
        echo '</div></div>';
    }       // end else
            }   // end if
        } // END IF NOT IN ARRAY
    }       // end elseif
    }   // end while
}           // end function

// show hide for lazy load image and message
echo '<script type="text/javascript">

        // Showing or Hiding the progress div
        function ShowHide()
        {
            $("#slidingDiv").animate({"height": "toggle"}, { duration: 1000 });
                }
        function ShowHide2()
        {
            $("#slidingDiv2").animate({"height": "toggle"}, { duration: 1000 });
                }
        function ShowHide3()
        {
            $("#slidingDiv3").animate({"height": "toggle"}, { duration: 1000 });
                }
        function ShowHide4()
        {
            $("#slidingDiv4").animate({"height": "toggle"}, { duration: 1000 });
                }
        function ShowHide5()
        {
            $("#slidingDiv5").animate({"height": "toggle"}, { duration: 1000 });
                }
            </script>';

// jquery show/hide for divs used for scanning
echo '<script type="text/javascript">
    $(document).ready(function() {
    //hide the all of the element with class msg_body
  $(".indexscan_msg_body").hide();

  //toggle the componenet with class msg_body
  $(".indexscan_msg_head").click(function() {
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

/**
 * Returns a module's option
 *
 * Return's a module's option (originally for the news module)
 *
 * @package News
 * @author Hervé Thouzard (www.herve-thouzard.com)
 * @copyright    (c) The XOOPS Project - www.xoops.org
 * @param string $option module option's name
 */
function indexscan_GetModuleOption($option, $repmodule='indexscan')
{
    global $xoopsModuleConfig, $xoopsModule;
    static $tbloptions= array();
    if (is_array($tbloptions) && array_key_exists($option, $tbloptions)) {
        return $tbloptions[$option];
    }

    $retval = false;
    if (isset($xoopsModuleConfig) && (is_object($xoopsModule) && $xoopsModule->getVar('dirname') == $repmodule && $xoopsModule->getVar('isactive'))) {
        if (isset($xoopsModuleConfig[$option])) {
            $retval= $xoopsModuleConfig[$option];
        }
    } else {
        $module_handler = xoops_getHandler('module');
        $module = $module_handler->getByDirname($repmodule);
        $config_handler = xoops_getHandler('config');
        if ($module) {
            $moduleConfig = $config_handler->getConfigsByCat(0, $module->getVar('mid'));
            if (isset($moduleConfig[$option])) {
                $retval= $moduleConfig[$option];
            }
        }
    }
    $tbloptions[$option]=$retval;

    return $retval;
}

function indexscan_get_files($ff, $extension)
{
    global $ignores,$count_illegalfiles;
    $types=array();
    $tmptypes = indexscan_GetModuleOption('indexscan_illegalfiles');
    $types = explode('|', $tmptypes);

    if (in_array($ff, $ignores)) {
        echo "<div class='indexscan_msg_list'>";
        echo "<div class='indexscan_ok'>".$ff."<span class='indexscan_maybeok'>"._AM_INDEXSCAN_MAYBEOK.'</span>';
        echo '</div></div>';
    }

    if (!in_array($extension, $types)) {
        if (!in_array($ff, $ignores)) {
            ++$count_illegalfiles;
            $baseUrl = substr_replace(indexscan_GetModuleOption('indexscan_rootorsub'), '', -1).'/'.$ff;
            echo "<div class='indexscan_suspecious' id='delete-".$baseUrl."'>".$ff."<span class='delete'><a href='javascript:void(0);'><img src='delete.png' height='10px' width='10px' alt='_AM_INDEXSCAN_DELETE'></img></a></span><span class='indexscan_notxoopsinstall'>"._AM_INDEXSCAN_NOTINXOOPSINSTALL.'</span></div>';
            $ci = 1;
        }
    } else {
    }
} // end get_files()

function indexscan_CreateBackup($src, $dst)
{
    global $filecopy, $filedeleted, $filecreated;
    $dir = opendir($src);
    @mkdir($dst);
    while (false !== ($file = readdir($dir))) {
        if (($file !== '.') && ($file !== '..')) {
            if (is_dir($src . '/' . $file)) {
                indexscan_CreateBackup($src . '/' . $file, $dst . '/' . $file);
            }
            if ($file === 'index.html' || $file === 'index.php') {
                ++$filecopy;
                copy($src . '/' . $file, $dst . '/' . $file);
            }
            ++$filecopy;
//mb            echo "<tr><td><span class='indexscan_path'>folder2backup/".$file."</span></td><td><span class='indexscan_created_ok'>". _AM_INDEXSCAN_BACKEDUP2.' -> '.$dst.'/'.$file.'</span></td></tr>';
        }
    }
    closedir($dir);

    $dir_iterator = new RecursiveDirectoryIterator('backup');
    $iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);
    foreach ($iterator as $ff) {
        if ($ff !== '.' && $ff !== '..') {
            if ($ff->isfile()) {
                $nm = $ff->getfilename();
                    //if ($nm != 'index.php' AND $nm !='index.html') {
                        if (!preg_match('/^index+/', $nm)) {
                            ++$filedeleted;
                            unlink($ff);
                        }
            }
//mb            echo "<tr><td><span class='indexscan_path'>".$ff."</span></td><td><span class='indexscan_created_ok'>". _AM_INDEXSCAN_BACKEDUPDELETEDFROMBACKUP.' backup/'.$ff.'</span></td></tr>';
        }
    }
    $dir_iterator2 = new RecursiveDirectoryIterator('backup');
    $iterator2 = new RecursiveIteratorIterator($dir_iterator2, RecursiveIteratorIterator::SELF_FIRST);
    foreach ($iterator2 as $ffd) {
        if ($ffd->IsDir()) {
            if ($ffd !== '.' && $ffd !== '..') {
                if (!file_exists($ffd.'/'.'index.html') && !file_exists($ffd.'/'.'index.php')) {
                    ++$filecreated;
                    if (!file_exists($ffd.'/'.'index.php')) {
                        file_put_contents($ffd.'/'.'index.html', '<script>history.go(-1);</script>');
                    }
//mb                    echo "<tr><td><span class='indexscan_path'>".$ffd.'/'.'index.html'."</span></td><td><span class='indexscan_created_ok'>". _AM_INDEXSCAN_CREATEDINDEXINBACKUP.'</span></td></tr>';
                }
                if (file_exists($ffd.'/index.php')) {
                    ++$filedeleted;
                    @unlink($ffd.'/index.html');
//mb                    echo "<tr><td><span class='indexscan_path'></span></td><td><span class='indexscan_created_ok'>".  _AM_INDEXSCAN_CLEANUPDONE.'</span></td></tr>';
                }
                if (file_exists($ffd.'/index.html')) {
                    ++$filedeleted;
                    @unlink($ffd.'/index.php');
//mb                    echo "<tr><td><span class='indexscan_path'></span></td><td><span class='indexscan_created_ok'>".  _AM_INDEXSCAN_CLEANUPDONE.'</span></td></tr>';
                }
            }
        } else {
            continue;
        }
    }
}

function indexscan_cleanBackUp()
{
    $module = indexscan_GetModuleOption('indexscan_frombackup');
    $src = substr_replace(indexscan_GetModuleOption('indexscan_rootorsub'), '', -1).'/modules/indexscan/admin/folder2backup/'.$module;
    $dst = 'backup/'.$module;

    $dir_iterator = new RecursiveDirectoryIterator($dst);
    $iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);
    foreach ($iterator as $ff) {
        if ($ff !== '.' && $ff !== '..') {
            if ($ff->isfile()) {
                $nm = $ff->getfilename();
                if ($nm === 'index.php') {
                    unlink($ff);
                }
            }
        }
    }
}

// Create zip file
function indexscan_createzipfile()
{
    $module = indexscan_GetModuleOption('indexscan_frombackup');
    $dst = 'backup/'.$module.'/';

    $archive = new PclZip('backup/indexscan_'.$module.'_archive.zip');
    $v_dir = __DIR__.'/backup/'.$module.'/';
    $v_remove = $v_dir;
  // To support windows and the C: root you need to add the
  // following 3 lines, should be ignored on linux
  if (substr($v_dir, 1, 1) === ':') {
      $v_remove = substr($v_dir, 2);
  }
    $v_list = $archive->create($v_dir, PCLZIP_OPT_REMOVE_PATH, $v_remove);
    if ($v_list == 0) {
        die('Error : '.$archive->errorInfo(true));
    }
    header('Content-disposition: attachment; filename=backup/indexscan_'.$module.'_archive.zip');
    header('Content-type: application/zip');
    header('Content-Description: File Transfer');
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    readfile('backup/indexscan_'.$module.'_archive.zip');
}

        // Confirm javascript for delete file
?>
        <script type="text/javascript">
            $(document).ready(function() {
    $('.indexscan_suspecious .delete').click(function() {
        id = $(this).parents('.indexscan_suspecious').attr('id');
        id = id.replace(/delete-/, "");
        el = $(this);
        if (confirm('<?php echo _AM_INDEXSCAN_REALLYDELETE.' '; ?>' + id)) {
             $.post('./delete_file.php', { id: id, indexscan_deletefile: 'true' }, function() {
             //$("#response").append(id).show('fast');
             $(el).parents('.indexscan_suspecious')
             .animate( { backgroundColor: '#cb5555' }, 500)
             .animate( { height: 0, paddingTop: 0, paddingBottom: 0 }, 500, function() {
                 $(this).css( { 'display' : 'none' } );
             });
         });
        }
    });
    });
        </script>
