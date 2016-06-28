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
 * @since         File available since Release 1.0.0
 */

$moduleDirName = basename(dirname(__DIR__));

$moduleHandler = xoops_getHandler('module');
$module        = $moduleHandler->getByDirname($moduleDirName);
$pathIcon32    = '../../' . $module->getInfo('sysicons32');
$pathModIcon32 = './' . $module->getInfo('modicons32');
xoops_loadLanguage('modinfo', $module->dirname());
xoops_loadLanguage('admin', $module->dirname());

$xoopsModuleAdminPath = XOOPS_ROOT_PATH . '/' . $module->getInfo('dirmoduleadmin');
include_once $xoopsModuleAdminPath . '/language/english/main.php';


$adminmenu = array();
$i=0;
$adminmenu[$i]['title'] = _AM_MODULEADMIN_HOME;
$adminmenu[$i]['link'] = 'admin/index.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/home.png';
//++$i;
//$adminmenu[$i]['title'] = _MI_INDEXSCAN_MAIN;
//$adminmenu[$i]['link'] = 'admin/main.php';
//$adminmenu[$i]['icon']  = $pathIcon32 . '/manage.png';

++$i;
$adminmenu[$i]['title'] = _MI_INDEXSCAN_SCANNOW;
$adminmenu[$i]['link'] = 'admin/main.php?op=ScanNow';
$adminmenu[$i]['icon']  = $pathIcon32 . '/manage.png';

++$i;
$adminmenu[$i]['title'] = _AM_INDEXSCAN_CREATE;
$adminmenu[$i]['link'] = 'admin/main.php?op=CreateNow';
$adminmenu[$i]['icon']  = $pathIcon32 . '/manage.png';

++$i;
$adminmenu[$i]['title'] = _AM_INDEXSCAN_INJECTIONSCAN;
$adminmenu[$i]['link'] = 'admin/main.php?op=injectionScan';
$adminmenu[$i]['icon']  = $pathIcon32 . '/manage.png';

++$i;
$adminmenu[$i]['title'] = _AM_INDEXSCAN_CHECKILLEGALFILES;
$adminmenu[$i]['link'] = 'admin/main.php?op=checkillegalfiles';
$adminmenu[$i]['icon']  = $pathIcon32 . '/manage.png';

++$i;
$adminmenu[$i]['title'] = _AM_INDEXSCAN_CREATEZIP;
$adminmenu[$i]['link'] = 'admin/main.php?op=createzip';
$adminmenu[$i]['icon']  = $pathIcon32 . '/manage.png';

++$i;
$adminmenu[$i]['title'] = _AM_MODULEADMIN_ABOUT;
$adminmenu[$i]['link']  = 'admin/about.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/about.png';
