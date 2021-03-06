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
 * @since         File available since Release 1.0.1
 */

$modversion['version']       = '2.20';
$modversion['module_status'] = 'Beta 1';
$modversion['release_date']  = '2021/03/08';
$modversion['name']          = _MI_INDEXSCAN_MODULE_NAME;
$modversion['description']   = _MI_INDEXSCAN_MODULE_DESC;
$modversion['credits']       = 'Developed by Culex http://www.culex.dk, Thanks XOOPS Community for helping out, translators for translating and especially Burning for The cool Logo';
$modversion['author']        = 'Culex http://www.culex.dk';
$modversion['help']          = 'page=help';
$modversion['license']       = 'GNU GPL 2.0 or later';
$modversion['license_url']   = 'www.gnu.org/licenses/gpl-2.0.html';
$modversion['official']      = 1;
$modversion['image']         = 'assets/images/logoModule.png';
$modversion['dirname']       = 'indexscan';

$modversion['dirmoduleadmin'] = 'Frameworks/moduleclasses/moduleadmin';
$modversion['sysicons16']     = 'Frameworks/moduleclasses/icons/16';
$modversion['sysicons32']     = 'Frameworks/moduleclasses/icons/32';
$modversion['modicons16']     = 'assets/images/icons/16';
$modversion['modicons32']     = 'assets/images/icons/32';
//about
$modversion['module_website_url']  = 'www.xoops.org';
$modversion['module_website_name'] = 'XOOPS';
$modversion['min_php']             = '7.2';
$modversion['min_xoops']           = '2.5.10';
$modversion['min_admin']           = '1.2';
$modversion['min_db']              = [
    'mysql'  => '5.0.7',
    'mysqli' => '5.0.7',
];

// Sql file (must contain sql generated by phpMyAdmin or phpPgAdmin)
// All tables should not have any prefix!

// Tables created by sql file (without prefix!)

//Admin things
$modversion['hasAdmin']    = 1;
$modversion['system_menu'] = 1;
$modversion['adminindex']  = 'admin/index.php';
$modversion['adminmenu']   = 'admin/menu.php';

// Menu
$modversion['hasMain'] = 0;
//$modversion['sub'][1]['name'] = _MI_INDEXSCAN_SCANNOW;
//$modversion['sub'][1]['url']  = 'main.php?op=ScanNow';
//$modversion['sub'][2]['name'] = _MI_INDEXSCAN_CREATEINDEX;
//$modversion['sub'][2]['url']  = 'main.php?op=CreateNow';

// ------------------- Blocks ------------------- //

// ------------------- Templates ------------------- //

// ------------------- Preferences ------------------- //
$modversion['config'][] = [
    'name'        => 'indexscan_frombackup',
    'title'       => '_MI_INDEXSCAN_FROMBACKUP',
    'description' => '_MI_INDEXSCAN_FROMBACKUP_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'testing',
];

$modversion['config'][] = [
    'name'        => 'indexscan_rootorsub',
    'title'       => '_MI_INDEXSCAN_ROOTORSUB',
    'description' => '_MI_INDEXSCAN_ROOTORSUB_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => '../../../',
];

$modversion['config'][] = [
    'name'        => 'indexscan_illegalfiles',
    'title'       => '_MI_INDEXSCAN_ILLEGALFILETYPES',
    'description' => '_MI_INDEXSCAN_ILLEGALFILETYPES_DESC',
    'formtype'    => 'textarea',
    'valuetype'   => 'text',
    'default'     => 'php|html|htm|jpg|png|gif|js|ico|txt|css|htaccess|eot|sql|swf|tpl|ttf|yml|lock|json|md|.gitignore|svg|woff|woff2',
];

$modversion['config'][] = [
    'name'        => 'exep_01',
    'title'       => '_MI_INDEXSCAN_EXEP1',
    'description' => '_MI_INDEXSCAN_EXEP1_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => '/.idea',
];

$modversion['config'][] = [
    'name'        => 'exep_02',
    'title'       => '_MI_INDEXSCAN_EXEP2',
    'description' => '_MI_INDEXSCAN_EXEP2_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => '',
];

$modversion['config'][] = [
    'name'        => 'exep_03',
    'title'       => '_MI_INDEXSCAN_EXEP3',
    'description' => '_MI_INDEXSCAN_EXEP3_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => '',
];

$modversion['config'][] = [
    'name'        => 'exep_04',
    'title'       => '_MI_INDEXSCAN_EXEP4',
    'description' => '_MI_INDEXSCAN_EXEP4_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => '',
];
