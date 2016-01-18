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
 * @version      $Id:menu.php 2009-07-09 11:41 culex $
 * @since         File available since Release 1.0.0
 */
 
$adminmenu[1]['title'] = _MI_INDEXSCAN_MAIN;
$adminmenu[1]['link'] = "admin/index.php";
$adminmenu[2]['title'] = _MI_INDEXSCAN_SCANNOW;
$adminmenu[2]['link'] = "admin/index.php?op=ScanNow";
?>