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
 * @version      $Id:xoops_version.php 2009-07-09 11:45 culex $
 * @since         File available since Release 1.0.1
 */
 
$modversion['name'] =_MI_INDEXSCAN_MODULE_NAME;
$modversion['version'] = "1.1";
$modversion['description'] = _MI_INDEXSCAN_MODULE_DESC;
$modversion['credits'] = "Developped by Culex http://www.culex.dk";
$modversion['author'] = "Culex";
$modversion['help'] = "top.html";
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = 1;
$modversion['image'] = "logo.png";
$modversion['dirname'] = "indexscan";

// Sql file (must contain sql generated by phpMyAdmin or phpPgAdmin)
// All tables should not have any prefix!

// Tables created by sql file (without prefix!)

//Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

// Menu
$modversion['hasMain'] = 0;
$modversion['sub'][1]['name'] = _MI_INDEXSCAN_SCANNOW; 
$modversion['sub'][1]['url'] = "index.php?op=ScanNow"; 
$modversion['sub'][2]['name'] = _MI_INDEXSCAN_CREATEINDEX; 
$modversion['sub'][2]['url'] = "index.php?op=CreateNow"; 

// Blocks

// Templates

$modversion['config'][] = array(
	'name' 			=> 'exep_01',
	'title' 		=> '_MI_INDEXSCAN_EXEP1',
	'description' 	=> '_MI_INDEXSCAN_EXEP1_DESC',
	'formtype' 		=> 'textbox',
	'valuetype' 	=> 'text',
	'default' 		=> '');

$modversion['config'][] = array(
	'name' 			=> 'exep_02',
	'title' 		=> '_MI_INDEXSCAN_EXEP2',
	'description' 	=> '_MI_INDEXSCAN_EXEP2_DESC',
	'formtype' 		=> 'textbox',
	'valuetype' 	=> 'text',
	'default' 		=> '');

$modversion['config'][] = array(
	'name' 			=> 'exep_03',
	'title' 		=> '_MI_INDEXSCAN_EXEP3',
	'description' 	=> '_MI_INDEXSCAN_EXEP3_DESC',
	'formtype' 		=> 'textbox',
	'valuetype' 	=> 'text',
	'default' 		=> '');

$modversion['config'][] = array(
	'name' 			=> 'exep_04',
	'title' 		=> '_MI_INDEXSCAN_EXEP4',
	'description' 	=> '_MI_INDEXSCAN_EXEP4_DESC',
	'formtype' 		=> 'textbox',
	'valuetype' 	=> 'text',
	'default' 		=> '');

?>