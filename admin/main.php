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
 * @copyright     XOOPS Project (https://xoops.org)
 * @license       http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author        Michael Albertsen (culex) <http://www.culex.dk>
 * @since         File available since Release 2.0.0
 */

use XoopsModules\Indexscan\{Helper,
    Utility
};

/** @var Admin $adminObject */
/** @var Helper $helper */
/** @var Utility $utility */

require_once __DIR__ . '/admin_header.php';
require XOOPS_ROOT_PATH . '/include/xoopscodes.php';
require XOOPS_ROOT_PATH . '/modules/indexscan/admin/md5parser.php';

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
                color:#ff0000;
                font-size: 10px;
                }

                .indexscan_path {
                position:relative;
                top:5px;
                color:#000000;
                font-size: 10px;
                }

                .indexscan_created_ok {
                position:relative;
                top: 5px;
                float:right;
                color:#008000;
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
                color: #008000;
                font-size: 10px;
                }

                .indexscan_suspicious {
                position:relative;
                background-color:FF1F1F;
                text-align:left;
                color:#ffffff;
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
                color:#ffffff;
                font-size: 10px;
                }

                .indexscan_maybeok {
                position:absolute;
                left:85%;
                color:#000000;
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
                border-color: #ff0000;
                border-style: solid;
                border-size:1px;
                font-family: arial;
                font-size: 10px;
                }

                </style>';
$op = '';

if (isset($_GET['op']) && 'ScanNow' === $_GET['op']) {
    $op = 'ScanNow';
}
if (isset($_GET['op']) && 'CreateNow' === $_GET['op']) {
    $op = 'CreateNow';
}
if (isset($_GET['op']) && 'injectionScan' === $_GET['op']) {
    $op = 'injectionScan';
}
if (isset($_GET['op']) && 'checkillegalfiles' === $_GET['op']) {
    $op = 'CheckIllegalFiles';
}
if (isset($_GET['op']) && 'deleteFiles' === $_GET['op']) {
    $op = 'deletefiles';
}
if (isset($_GET['op']) && 'createzip' === $_GET['op']) {
    $op = 'createzip';
}
if (isset($_GET['op']) && 'downloadzip' === $_GET['op']) {
    $op = 'downloadzip';
}
if (isset($_GET['op']) && '' == $_GET['op']) {
    $op = '';
}

// Switch for choises
global $op, $count;
switch ($op) {
    case 'ScanNow':
        global $count;
        xoops_cp_header();
        //        indexScan_Choice();
        print "<div align = 'center' id ='indexscan_result' width='100%'><table class='outer' width='100%'>";
        print '<tr class="header" style="text-align: center;"><th colspan=2><h2>' . _AM_INDEXSCAN_HEADER . '</h2></th></tr>';
        print '<tr style="text-align: center;"><td></td></tr>';

        // Setting up the search //
        global $xoopsModuleConfig;
        $RootDir        = $utility::getModuleOption('indexscan_rootorsub');
        $File2Look4     = 'index.php';//changed to .php from .html
        $ReturnFindings = array($utility, 'printPaths');
        $Dirs2Exclude   = [$xoopsModuleConfig['exep_01'], $xoopsModuleConfig['exep_02'], $xoopsModuleConfig['exep_03'], $xoopsModuleConfig['exep_04']];

        // $Dirs2Exclude = array( 'modules', './', 'themes' );
        print $utility::look4Files($RootDir, $File2Look4, $ReturnFindings, $Dirs2Exclude);
        print '<tr><td colspan=2></td></tr><tr><td colspan=2style="text-align: center;"></td></tr><tr><td colspan=2></td></tr>';
        print '<tr><td colspan=2></td></tr><tr><th colspan=2style="text-align: center;">$count ' . _AM_INDEXSCAN_FOUNDMISSING . '</th></tr><tr><td colspan=2></td></tr>';
        print '</table></div>';
        xoops_cp_footer();
        break;
    case 'CreateNow':
        global $count, $myts;
        xoops_cp_header();
        //        indexScan_Choice();
        print "<div align = 'center' id ='indexscan_result' width='100%'><table class='outer' width='100%'>";
        print "<tr class='header'><center><th colspan=2><h2>" . _AM_INDEXSCAN_MAKINGHEADER . '</h2></center></th></tr>';
        print "<tr class='header'><center><td colspan=2></center></td></tr>";

        // Setting up the search //
        $File2Look4CR     = 'index.php';
        $ReturnFindingsCR = array($utility, 'printPathsCR');
        $RootDirCR        = $utility::getModuleOption('indexscan_rootorsub');

        // Define which folders not to scan
        $Dirs2ExcludeCR = [$xoopsModuleConfig['exep_01'], $xoopsModuleConfig['exep_02'], $xoopsModuleConfig['exep_03'], $xoopsModuleConfig['exep_04']];

        print $utility::look4FilesCR($RootDirCR, $File2Look4CR, $ReturnFindingsCR, $Dirs2ExcludeCR);
        print '<tr><td colspan=2></td></tr><tr><td colspan=2><center></center></td></tr><tr><td colspan=2></td></tr>';
        print "<tr><td colspan=2></td></tr><tr><th colspan=2><center>$countCR " . _AM_INDEXSCAN_CREATEDINDEXFILES . '</center></th></tr><tr><td colspan=2></td></tr>';
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

        * @copyright   XOOPS Project (https://xoops.org)
        * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
        * @author      Michael Albertsen (culex) <http://www.culex.dk>
        * @since       File available since Release 1.0.1
        */
        xoops_cp_header();
        //            indexScan_Choice();
        print "<div id ='indexscan_result' width='100%'><table class='outer' width='100%'>";
        global $xoopsModuleConfig;
        $path = substr_replace($utility::getModuleOption('indexscan_rootorsub'), '', -1);

        $baseDir                 = basename(dirname($_SERVER['SCRIPT_NAME']));
        $WebPth                  = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        $content_pattern         = ['iframe', 'fromCharCode', '%69%66%72%61%6D%65', 'document.write(unescape('];
        $tmp                     = pathinfo(XOOPS_ROOT_PATH . '/mainfile.php');
        $tmp1                    = dirname(dirname(XOOPS_ROOT_PATH . '/mainfile.php'));
        $tmp2                    = str_replace($tmp1, '', $tmp);
        $file                    = $tmp2['dirname'] . '/modules/indexscan/admin/index.php';
        $fileSub                 = str_replace("\\", '/', $file);
        $fileSubs                = '../../../..' . $fileSub;
        $content_pattern_exclude = ['../../../modules/indexscan/admin/index.php', $fileSubs];
        $count_files             = 0;
        $count_injections        = 0;
        echo _AM_INDEXSCAN_CHECKFORFILES;
        $dir_handle = @opendir($path) || exit("Unable to open $path");
        $utility::scan4iframe($dir_handle, $path, '');
        print '<tr><td colspan=2></td></tr><tr><td colspan=2><center></center></td></tr><tr><td colspan=2></td></tr>';
        print "<tr><td colspan=2></td></tr><tr><th colspan=2><span style='position:relative;text-align:left;font-size:14px;font-weight:bold;'>$count_injections</span><span style = 'position:relative;text-align:left;font-size:10px;'>"
              . _AM_INDEXSCAN_FINISDINJECTIONS
              . "</span><span style='font-size:14px;font-weight:bold;'> $count_files</span></th></tr><tr><td colspan=2></td></tr>";
        echo '</table></div>';
        xoops_cp_footer();
        break;
    case 'CheckIllegalFiles':
        global $ignores;
        xoops_cp_header();
        //    indexScan_Choice();
        $count_xoopsfiles   = 0;
        $count_illegalfiles = 0;
        $ci                 = 0;

        echo "<div id ='indexscan_result' width='100%'><table class='outer' width='100%'>";
        $ignores = [];
        $tmps    = file('filecheck.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($tmps as $lines) {
            [$line, $sum] = explode(':', $lines);
            $line      = str_replace('\\', '/', $line);
            $line      = str_replace('\s', '', $line);
            $line      = str_replace('\t', '', $line);
            $line      = str_replace('\r', '', $line);
            $ignores[] = $line;
        }

        $dir_iterator = new RecursiveDirectoryIterator(substr_replace($utility::getModuleOption('indexscan_rootorsub'), '', -1));
        $iterator     = new \RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);
        // could use CHILD_FIRST if you so wish

        foreach ($iterator as $ff) {
            if ($ff->IsFile()) {
                ++$count_xoopsfiles;
                $ff        = str_replace('.\\', '', $ff);
                $ff        = str_replace('./', '', $ff);
                $ff        = str_replace('....', '', $ff);
                $ff        = str_replace('...', '', $ff);
                $ff        = str_replace('\\', '/', $ff);
                $ff        = str_replace('\s', '', $ff);
                $ff        = str_replace('\t', '', $ff);
                $ff        = str_replace('\r', '', $ff);
                $ffArray   = explode('.', $ff);
                $extension = end($ffArray);
                $utility::getFiles($ff, $extension);
            } else {
                continue;
            }
        }
        echo "<center><span style='position:relative;text-align:left;font-size:14px;font-weight:bold;'>"
             . $count_illegalfiles
             . "</span><span style = 'position:relative;text-align:left;font-size:10px;'>"
             . _AM_INDEXSCAN_FINISDILLEGAL
             . "</span><span style='font-size:14px;font-weight:bold;'>"
             . $count_xoopsfiles
             . "</span><br><br><span style = 'position:relative;text-align:left;font-size:10px;'>"
             . _AM_INDEXSCAN_ILLEGAL_DESC
             . '</span></center></table></div>';
        xoops_cp_footer();
        break;

    case 'createzip':
        xoops_cp_header();
        //        indexScan_Choice();
        $filecopy    = 0;
        $filedeleted = 0;
        $filecreated = 0;
        echo "<div id ='indexscan_result' width='100%'><table class='outer' width='100%'>";
        $module = $utility::getModuleOption('indexscan_frombackup');
        //    $src = substr_replace($utility::getModuleOption('indexscan_rootorsub'), '', -1).'/modules/indexscan/admin/folder2backup/'.$module;
        $src = substr_replace($utility::getModuleOption('indexscan_rootorsub'), '', -1);
        //        $dst = 'backup/' . $module;
        $dst = $helper->path('admin/backup/' . $module);
        $utility::createBackup($src, $dst);
        echo "<tr><td colspan=2></td></tr><tr class='header'><td colspan=2><br><br><center><a href='main.php?op=downloadzip'>" . _AM_INDEXSCAN_DOWNLOADZIP . '</a></center></td></tr>';
        echo "<br><br><br><tr><td colspan=2></td></tr><tr><td colspan=2><center><span style='position:relative;text-align:left;font-size:14px;font-weight:bold;'>"
             . $filecopy
             . "</span><span style = 'position:relative;text-align:left;font-size:10px;'>"
             . _AM_INDEXSCAN_FILESARECOPIED
             . "</span><br><span style='font-size:14px;font-weight:bold;'>"
             . $filedeleted
             . "</span><span style = 'position:relative;text-align:left;font-size:10px;'>"
             . _AM_INDEXSCAN_FILESDELETED
             . "</span><br><span style='font-size:14px;font-weight:bold;'>"
             . $filecreated
             . "</span><span style = 'position:relative;text-align:left;font-size:10px;'>"
             . _AM_INDEXSCAN_FILESCREATED
             . '</span></center></tr></td></table></div><br><br>';
        $utility::cleanBackup();
        xoops_cp_footer();
        break;

    case 'downloadzip':
        xoops_cp_header();
        //        indexScan_Choice();
        $utility::createZipFile();
        xoops_cp_footer();
        break;
}

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
echo '<link type="text/css" rel="stylesheet" href="../assets/js/Styles/SyntaxHighlighter.css"></link>
<script language="javascript" src="../assets/js/Scripts/shCore.js"></script>
<script language="javascript" src="../assets/js/Scripts/shBrushCSharp.js"></script>
<script language="javascript" src="../assets/js/Scripts/shBrushPhp.js"></script>
<script language="javascript">
dp.SyntaxHighlighter.ClipboardSwf = "../assets/js/Scripts/clipboard.swf";
dp.SyntaxHighlighter.HighlightAll("code");
</script>';

// Confirm javascript for delete file
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.indexscan_suspicious .delete').click(function () {
            id = $(this).parents('.indexscan_suspicious').attr('id');
            id = id.replace(/delete-/, "");
            el = $(this);
            if (confirm('<?php echo _AM_INDEXSCAN_REALLYDELETE . ' '; ?>' + id)) {
                $.post('./delete_file.php', {id: id, indexscan_deletefile: 'true'}, function () {
                    //$("#response").append(id).show('fast');
                    $(el).parents('.indexscan_suspicious')
                        .animate({backgroundColor: '#cb5555'}, 500)
                        .animate({height: 0, paddingTop: 0, paddingBottom: 0}, 500, function () {
                            $(this).css({'display': 'none'});
                        });
                });
            }
        });
    });
</script>
