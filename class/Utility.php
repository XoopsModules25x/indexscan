<?php

namespace XoopsModules\Indexscan;

/*
 Utility Class Definition

 You may not change or alter any portion of this comment or credits of
 supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit
 authors.

 This program is distributed in the hope that it will be useful, but
 WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 *
 * @license      https://www.fsf.org/copyleft/gpl.html GNU public license
 * @copyright    https://xoops.org 2000-2020 &copy; XOOPS Project
 * @author       Mamba <mambax7@gmail.com>
 */

use XoopsModules\Indexscan\{Common,
    Constants,
    Helper
};

/**
 * Class Utility
 */
class Utility extends Common\SysUtility
{
    //--------------- Custom module methods -----------------------------

    /*
* @Descript.   This function scans through the files in your webfolders
*              And lists files containing the word iframe.
* @copyright   XOOPS Project (https://xoops.org)
* @license     http://www.fsf.org/copyleft/gpl.html GNU public license
* @author      Michael Albertsen (culex) <http://www.culex.dk>
* @since       File available since Release 1.0.1
*/

    /**
     * @param $dir_handle
     * @param $path
     * @param $WebPth
     */
    public static function scan4iframe($dir_handle, $path, $WebPth)
    {
        global $WebPath, $content_pattern, $content_pattern_exclude, $count_files, $count_injections;
        while (false !== ($file = readdir($dir_handle))) {
            $dir = $path . '/' . $file;
            if (is_dir($dir) && '.' !== $file && '..' !== $file && '.git' !== $file) {
                $handle = @opendir($dir) || exit(_AM_INDEXSCAN_UNABLETOREADFILE . $file);
                $WebRef = $file . '/';
                self::scan4iframe($handle, $dir, $WebRef);
            } // end if

            elseif ('.' !== $file && '..' !== $file) {
                if (!in_array($dir, $content_pattern_exclude)) {
                    if (preg_match('/^index+/', $file) || preg_match('/^mainfile+/', $file) || preg_match('/^header+/', $file) || preg_match('/^footer+/', $file)) {
                        ++$count_files;
                        $ChcekFlag = false;
                        $handle    = @fopen($dir, 'rb');
                        if ($handle) {
                            $test = [];
                            while (!feof($handle)) {
                                $content        = fgets($handle);
                                $indexscan_type = '';
                                foreach ($content_pattern as $key => $value) {
                                    if (false !== stripos($content, $value)) {
                                        if ('iframe' === $value) {
                                            $indexscan_type = 'Iframe';
                                        }
                                        if ('fromCharCode' === $value) {
                                            $indexscan_type = 'Encoded Javascript';
                                        }
                                        if ('%69%66%72%61%6D%65' === $value) {
                                            $indexscan_type = 'Encoded Javascript';
                                        }
                                        if ('document.write(unescape(' === $value) {
                                            $indexscan_type = 'Encoded Javascript';
                                        }
                                        ++$count_injections;
                                        ++$count_files;
                                        $ChcekFlag = true;
                                        rewind($handle);
                                        $test = '';
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
                            echo "<div class='indexscan_msg_head'>" . $dir . "<img class='indexscan_img' src='html.png'></img><span class='indexscan_iframe_found2'>" . $indexscan_type . ' ' . _AM_INDEXSCAN_INFECTED . '</span></div>';
                            echo "<p class='indexscan_msg_body'>";
                            echo "<span class='.indexscan_codetext'><textarea rows='30' cols='40' name='code' class='php:nocontrols'>" . htmlentities($test, ENT_QUOTES | ENT_HTML5) . '</textarea>';
                            echo '</span></p>' . '</div>';
                        } // end if
                        else {
                            echo "<div class='indexscan_msg_list'>";
                            echo "<div class='indexscan_ok'>" . $dir . "<span class='indexscan_show'>" . _AM_INDEXSCAN_CLEAN . '</span>';
                            echo '</div></div>';
                        }       // end else
                    }   // end if
                } // END IF NOT IN ARRAY
            }       // end elseif
        }   // end while
    }           // end function

    /**
     * Returns a module's option
     *
     * Return's a module's option (originally for the news module)
     *
     * @param string $option module option's name
     * @param string $repmodule
     * @return bool|mixed
     * @package          News
     * @author           Hervé Thouzard (www.herve-thouzard.com)
     * @copyright    (c) The XOOPS Project - www.xoops.org
     */
    public static function getModuleOption($option, $repmodule = 'indexscan')
    {
        global $xoopsModuleConfig, $xoopsModule;
        static $tbloptions = [];
        if (is_array($tbloptions) && array_key_exists($option, $tbloptions)) {
            return $tbloptions[$option];
        }

        $retval = false;
        if (isset($xoopsModuleConfig) && (is_object($xoopsModule) && $xoopsModule->getVar('dirname') == $repmodule && $xoopsModule->getVar('isactive'))) {
            if (isset($xoopsModuleConfig[$option])) {
                $retval = $xoopsModuleConfig[$option];
            }
        } else {
            /** @var \XoopsModuleHandler $moduleHandler */
            $moduleHandler = xoops_getHandler('module');
            $module        = $moduleHandler->getByDirname($repmodule);
            /** @var \XoopsConfigHandler $configHandler */
            $configHandler = xoops_getHandler('config');
            if ($module) {
                $moduleConfig = $configHandler->getConfigsByCat(0, $module->getVar('mid'));
                if (isset($moduleConfig[$option])) {
                    $retval = $moduleConfig[$option];
                }
            }
        }
        $tbloptions[$option] = $retval;

        return $retval;
    }

    /**
     * @param $ff
     * @param $extension
     */
    public static function getFiles($ff, $extension)
    {
        global $ignores, $count_illegalfiles;
        $types    = [];
        $tmptypes = self::getModuleOption('indexscan_illegalfiles');
        $types    = explode('|', $tmptypes);

        if (in_array($ff, $ignores)) {
            echo "<div class='indexscan_msg_list'>";
            echo "<div class='indexscan_ok'>" . $ff . "<span class='indexscan_maybeok'>" . _AM_INDEXSCAN_MAYBEOK . '</span>';
            echo '</div></div>';
        }

        if (!in_array($extension, $types)) {
            if (!in_array($ff, $ignores)) {
                ++$count_illegalfiles;
                $baseUrl = substr_replace(self::getModuleOption('indexscan_rootorsub'), '', -1) . '/' . $ff;
                echo "<div class='indexscan_suspicious' id='delete-"
                     . $baseUrl
                     . "'>"
                     . $ff
                     . "<span class='delete'><a href='javascript:void(0);'><img src='delete.png' height='10px' width='10px' alt='_AM_INDEXSCAN_DELETE'></img></a></span><span class='indexscan_notxoopsinstall'>"
                     . _AM_INDEXSCAN_NOTINXOOPSINSTALL
                     . '</span></div>';
                $ci = 1;
            }
        } else {
        }
    } // end get_files()

    /**
     * @param $src
     * @param $dst
     */
    public static function createBackup($src, $dst)
    {
        global $filecopy, $filedeleted, $filecreated;
        $dir = opendir($src);
        if (!mkdir($dst) && !is_dir($dst)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $dst));
        }
        while (false !== ($file = readdir($dir))) {
            if (('.' !== $file) && ('..' !== $file) && '.git' !== $file && '.idea' !== $file && 'vendor' !== $file) {
                if (is_dir($src . '/' . $file)) {
                    self::createBackup($src . '/' . $file, $dst . '/' . $file);
                }
                if ('index.html' === $file || 'index.php' === $file) {
                    ++$filecopy;
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
                ++$filecopy;
                //mb            echo "<tr><td><span class='indexscan_path'>folder2backup/".$file."</span></td><td><span class='indexscan_created_ok'>". _AM_INDEXSCAN_BACKEDUP2.' -> '.$dst.'/'.$file.'</span></td></tr>';
            }
        }
        closedir($dir);

        $dir_iterator = new \RecursiveDirectoryIterator('backup');
        $iterator     = new \RecursiveIteratorIterator($dir_iterator, \RecursiveIteratorIterator::SELF_FIRST);
        foreach ($iterator as $ff) {
            if ('.' !== $ff && '..' !== $ff) {
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
        $dir_iterator2 = new \RecursiveDirectoryIterator('backup');
        $iterator2     = new \RecursiveIteratorIterator($dir_iterator2, \RecursiveIteratorIterator::SELF_FIRST);
        foreach ($iterator2 as $ffd) {
            if ($ffd->IsDir()) {
                if ('.' !== $ffd && '..' !== $ffd) {
                    if (!file_exists($ffd . '/' . 'index.html') && !file_exists($ffd . '/' . 'index.php')) {
                        ++$filecreated;
                        if (!file_exists($ffd . '/' . 'index.php')) {
                            file_put_contents($ffd . '/' . 'index.php', "<?php\nheader('HTTP/1.0 404 Not Found');");
                        }
                        //mb                    echo "<tr><td><span class='indexscan_path'>".$ffd.'/'.'index.html'."</span></td><td><span class='indexscan_created_ok'>". _AM_INDEXSCAN_CREATEDINDEXINBACKUP.'</span></td></tr>';
                    }
                    if (is_file($ffd . '/index.php')) {
                        ++$filedeleted;
                        @unlink($ffd . '/index.html');
                        //mb                    echo "<tr><td><span class='indexscan_path'></span></td><td><span class='indexscan_created_ok'>".  _AM_INDEXSCAN_CLEANUPDONE.'</span></td></tr>';
                    }
                    if (is_file($ffd . '/index.html')) {
                        ++$filedeleted;
                        @unlink($ffd . '/index.php');
                        //mb                    echo "<tr><td><span class='indexscan_path'></span></td><td><span class='indexscan_created_ok'>".  _AM_INDEXSCAN_CLEANUPDONE.'</span></td></tr>';
                    }
                }
            } else {
                continue;
            }
        }
    }

    public static function cleanBackup()
    {
        $module = self::getModuleOption('indexscan_frombackup');
        $src    = substr_replace(self::getModuleOption('indexscan_rootorsub'), '', -1) . '/modules/indexscan/admin/folder2backup/' . $module;
//        $dst    = 'backup/' . $module;
        $dst    = (new Helper)->path('backup/' . $module);

        $dir_iterator = new \RecursiveDirectoryIterator($dst);
        $iterator     = new \RecursiveIteratorIterator($dir_iterator, \RecursiveIteratorIterator::SELF_FIRST);
        foreach ($iterator as $ff) {
            if ('.' !== $ff && '..' !== $ff) {
                if ($ff->isfile()) {
                    $nm = $ff->getfilename();
                    if ('index.php' === $nm) {
                        unlink($ff);
                    }
                }
            }
        }
    }

    // Create zip file
    public static function createZipFile()
    {
        $module = self::getModuleOption('indexscan_frombackup');
        $dst    = 'backup/' . $module . '/';

        $archive  = new PclZip('backup/indexscan_' . $module . '_archive.zip');
        $v_dir    =  (new Helper)->path('backup/' . $module . '/');
        $v_remove = $v_dir;
        // To support windows and the C: root you need to add the
        // following 3 lines, should be ignored on linux
        if (':' === substr($v_dir, 1, 1)) {
            $v_remove = substr($v_dir, 2);
        }
        $v_list = $archive->create($v_dir, PCLZIP_OPT_REMOVE_PATH, $v_remove);
        if (0 == $v_list) {
            exit('Error : ' . $archive->errorInfo(true));
        }
        header('Content-disposition: attachment; filename=backup/indexscan_' . $module . '_archive.zip');
        header('Content-type: application/zip');
        header('Content-Description: File Transfer');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        readfile('backup/indexscan_' . $module . '_archive.zip');
    }

    /*
This function opens a file called index.html, write content, and saves where not found
*/
    /**
     * @param $folderUrl
     */
    public static function createMissingIndexFiles($folderUrl)
    {
        $myts = \MyTextSanitizer::getInstance();
        file_put_contents($folderUrl . 'index.php', "<?php\nheader('HTTP/1.0 404 Not Found');");
    }

    /*
    This function will look through all folder on server starting from $RootDir. And will call back all missing
    dirs not having index.php
    */
    /**
     * @param       $RootDirCR
     * @param       $File2Look4CR
     * @param null  $ReturnFindingsCR
     * @param array $Dirs2ExcludeCR
     * @return bool|string
     */
    public static function look4FilesCR($RootDirCR, $File2Look4CR, $ReturnFindingsCR = null, $Dirs2ExcludeCR = [])
    {
        global $countCR;
        $countCR       = 0;
        $Queue2ArrayCR = [rtrim($RootDirCR, '/') . '/']; // normalize all paths
        foreach ($Dirs2ExcludeCR as &$pathCR) { // &$path Req. PHP ver 5.x and later
            $pathCR = $RootDirCR . trim($pathCR, '/') . '/';
        }
        //            unset($pathCR);
        while ($BaSeCR = array_shift($Queue2ArrayCR)) {
            $File_PathCR  = $BaSeCR . $File2Look4CR;
            $File_Path2CR = $BaSeCR . 'index.html';
            $File_Path3CR = $BaSeCR . 'index.htm';
            $File_Path4CR = $BaSeCR . 'index.php3';
            if (!file_exists($File_PathCR) && !file_exists($File_Path2CR) && !file_exists($File_Path3CR) && !file_exists($File_Path4CR)) { // files not found
                if (is_callable($ReturnFindingsCR, true, $callableName)) {
                    ++$countCR;
                    $callableName($BaSeCR, $File2Look4CR, $countCR); // callback => CONTINUE
                } else {
                    return $File_PathCR; // return file-path => EXIT
                }
            }
            $handleCR = opendir($BaSeCR);
            if ($handleCR) {
                while (false !== ($SubFolderCR = readdir($handleCR))) {
                    if (is_dir($BaSeCR . $SubFolderCR) && '.' !== $SubFolderCR && '..' !== $SubFolderCR && '.git' !== $SubFolderCR) {
                        $combined_pathCR = $BaSeCR . $SubFolderCR . '/';
                        if (!in_array($combined_pathCR, $Dirs2ExcludeCR)) {
                            $Queue2ArrayCR[] = $combined_pathCR;
                        }
                    }
                }
                closedir($handleCR);
            } // else unable to open directory => NEXT CHILD
        }

        return false; // end of tree.
    }

    /*
Print the dir found via look4Files() and show where the index.php is not found,
*/
    /**
     * @param $xoopsFilePath
     * @param $File2Look4
     * @param $count
     */
    public static function printPaths($xoopsFilePath, $File2Look4, $count)
    {
        $xoopsFilePath = substr($xoopsFilePath, 7);
        print "<tr><td><span class='indexscan_path'>$xoopsFilePath</span></td><td><span class='indexscan_index_notfound'>" . _AM_INDEXSCAN_NOTFOUND . '</span></td></tr>';
    }

    /*
    This function will look through all folder on server starting from $RootDir. And will call back all missing
    dirs not having index.html
    */
    /**
     * @param       $RootDir
     * @param       $File2Look4
     * @param null  $ReturnFindings
     * @param array $Dirs2Exclude
     * @return bool|string
     */
    public static function look4Files($RootDir, $File2Look4, $ReturnFindings = null, $Dirs2Exclude = [])
    {
        global $count;
        $count       = 0;
        $Queue2Array = [rtrim($RootDir, '/') . '/']; // normalize all paths
        foreach ($Dirs2Exclude as &$path) { // &$path Req. PHP ver 5.x and later
            $path = $RootDir . trim($path, '/') . '/';
        }
        //            unset($path);
        while ($BaSe = array_shift($Queue2Array)) {
            $File_Path  = $BaSe . $File2Look4;
            $File_Path2 = $BaSe . 'index.php';
            $File_Path3 = $BaSe . 'index.htm';
            $File_Path4 = $BaSe . 'index.php3';
            if (!file_exists($File_Path) && !file_exists($File_Path2) && !file_exists($File_Path3) && !file_exists($File_Path4)) { // files not found
                if (is_callable($ReturnFindings, true, $callableName)) {
                    ++$count;
                    $callableName($BaSe, $File2Look4, $count); // callback => CONTINUE
                } else {
                    return $File_Path; // return file-path => EXIT
                }
            }
            $handle = opendir($BaSe);
            if ($handle) {
                while (false !== ($SubFolder = readdir($handle))) {
                    if (is_dir($BaSe . $SubFolder) && '.' !== $SubFolder && '..' !== $SubFolder && '.git' !== $SubFolder) {
                        $combined_path = $BaSe . $SubFolder . '/';
                        if (!in_array($combined_path, $Dirs2Exclude)) {
                            $Queue2Array[] = $combined_path;
                        }
                    }
                }
                closedir($handle);
            } // else unable to open directory => NEXT CHILD
        }

        return false; // end of tree.
    }

    /**
     * @param $xoopsFilePathCR
     * @param $File2Look4CR
     * @param $countCR
     */
    public static function printPathsCR($xoopsFilePathCR, $File2Look4CR, $countCR)
    {
        $xoopsFilePathCRSHORT = substr($xoopsFilePathCR, 7);
        Utility::createMissingIndexFiles($xoopsFilePathCR);
        print "<tr><td><span class='indexscan_path'>$xoopsFilePathCRSHORT</span></td><td><span class='indexscan_created_ok'>" . _AM_INDEXSCAN_CREATED . '</span><br><td></tr>';
    }

    public static function indexScan_Choice()
    {
        global $xoopsModule, $count, $verifyMessage;
        echo '<table class="outer" width="100%"><tr>';
        echo "<td class='even' style=\"text-align: center;\"><a onclick='ShowHide();' href='index.php?op=ScanNow'>" . _AM_INDEXSCAN_NOW . '</a></td>';
        echo "<td class='even' style=\"text-align: center;\"><a onclick='ShowHide2();' href='index.php?op=CreateNow'>" . _AM_INDEXSCAN_CREATE . '</a></td>';
        echo "<td class='even' style=\"text-align: center;\"><a onclick='ShowHide3();' href='index.php?op=injectionScan'>" . _AM_INDEXSCAN_INJECTIONSCAN . '</a></td>';
        echo "<td class='even' style=\"text-align: center;\"><a onclick='ShowHide4();' href='index.php?op=checkillegalfiles'>" . _AM_INDEXSCAN_CHECKILLEGALFILES . '</a></td>';
        echo "<td class='even' style=\"text-align: center;\"><a onclick='ShowHide5();' href='index.php?op=createzip'>" . _AM_INDEXSCAN_CREATEZIP . '</a></td>';
        echo '<td class="even" style="text-align: center;"><a href="../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=' . $xoopsModule->getVar('mid') . '">' . _AM_INDEXSCAN_CONFIG . '</a></td>';
        echo '</tr></table>';
        if ('' != $verifyMessage) {
            echo '<div align="center" id="indexscan_verifyMsg"><br>' . $verifyMessage . '</div>';
        } else {
        };
        echo '<div align="center" id="slidingDiv"><img src="spinner.gif" align="center"><br>' . _AM_INDEXSCAN_SCANNING4MISS . '</div>';
        echo '<div align="center" id="slidingDiv2"><img src="spinner.gif" align="center"><br>' . _AM_INDEXSCAN_CREATINGMISS . '</div>';
        echo '<div align="center" id="slidingDiv3"><img src="spinner.gif" align="center"><br>' . _AM_INDEXSCAN_SCANNING4IFRAME . '</div>';
        echo '<div align="center" id="slidingDiv4"><img src="spinner.gif" align="center"><br>' . _AM_INDEXSCAN_SCANNING4ILLEGALFILES . '</div>';
        echo '<div align="center" id="slidingDiv5"><img src="spinner.gif" align="center"><br>' . _AM_INDEXSCAN_CREATINGZIP . '</div>';
    }
}
