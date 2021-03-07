<?php

// English language file for indexscan

define('_MI_INDEXSCAN_MAIN', 'Main');
define('_MI_INDEXSCAN_SCANNOW', 'Scan now');
define('_MI_INDEXSCAN_CREATEINDEX', 'CREATE INDEX files');
define('_MI_INDEXSCAN_HELP', 'Help');
define('_MI_INDEXSCAN_SETTINGS', 'Settings');
define('_MI_INDEXSCAN_MODULE_NAME', 'Indexscan');
define('_MI_INDEXSCAN_MODULE_DESC', 'Scans your xoops installation for missing<br> index files. If some are missing you can create.');
define('_MI_INDEXSCAN_EXEP1', 'Folder to not scan 01');
define('_MI_INDEXSCAN_EXEP1_DESC', "If there are folders you don't want scanned (for instance.) <strong>/uploads</strong><br> you can write the name here");
define('_MI_INDEXSCAN_EXEP2', 'Folder to not scan 02');
define('_MI_INDEXSCAN_EXEP2_DESC', '');
define('_MI_INDEXSCAN_EXEP3', 'Folder to not scan 03');
define('_MI_INDEXSCAN_EXEP3_DESC', '');
define('_MI_INDEXSCAN_EXEP4', 'Folder to not scan 04');
define('_MI_INDEXSCAN_EXEP4_DESC', '');

//Added in 2.2
define('_MI_INDEXSCAN_ROOTORSUB', 'Root or sub folder installation');
define('_MI_INDEXSCAN_ROOTORSUB_DESC', "Write here from where you want to start scanning<br>'../../../' if your web is like 'www.myspace.com/mainfile,php'<br>'../../../../' if it is like www.websted.dk/htdocs/mainfile.com");

//Added in 2.03
define('_MI_INDEXSCAN_ILLEGALFILETYPES', 'Skip file types.');
define('_MI_INDEXSCAN_ILLEGALFILETYPES_DESC', "Add files you wish to skip while 'checking files'.<br>These files will be considered 'safe'<br>if they also are listed in the file 'admin/filecheck.txt'.");
define('_MI_INDEXSCAN_FROMBACKUP', 'Create file zip');
define(
    '_MI_INDEXSCAN_FROMBACKUP_DESC',
    "Creates a zip archive with the same folder structure from the folder you ftp to folder2backup.<br>The zip contains nothing but the folders and,<br>index.html files where missing from<br>your uploaded folder.<br><br>The folder name is the name of the folder in your folder2backup folder, for instance 'testing'.<br>You can delete 'testing' this folder is only for example."
);

//2.10
// The name of this module
define('_MI_INDEXSCAN_NAME', 'IndexScan');
define('_MI_INDEXSCAN_DIRNAME', basename(dirname(dirname(__DIR__))));
define('_MI_INDEXSCAN_HELP_HEADER', __DIR__ . '/help/helpheader.html');
define('_MI_INDEXSCAN_BACK_2_ADMIN', 'Back to Administration of ');
