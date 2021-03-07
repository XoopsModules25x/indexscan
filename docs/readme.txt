README FIRST
-----------------------

 *
 * Index Scan module
 *
 * Use this module to scan your web folders for missing index.html files. If not found,
 * you can create them automatically.
 *
 * The module uses a function to scan for files originally found on php.net examples
 * but modified to suit the needs / standards of XOOPS 2.5.8 & PHP 5.5.
 *
 * LICENSE
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * @copyright   XOOPS Project (https://xoops.org)
 * @license       http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author       Michael Albertsen (culex) <http://www.culex.dk>
 * @since         File available since Release 1.0.0
 *

 Index scan
 ----------

///////////////////////////////////////////////////////////////////////////////////////////////

Why use index.html files ?

Unless the webmaster disallows casual folder browsing on the web server, most of the contents of each folder can be listed in a browser pointing to that Internet address.
This concept is easily demonstrable by typing most any website address into the address bar of an Internet browser and simply adding a forward-slash and
this folder name to the address:

images

If the images folder of the website navigated to is not protected, a listing of all the files in the folder will be displayed. Any of the files in the resulting display may be
right-clicked on and the 'save as' option taken in order to save that file to a hard drive.
In most cases websites will have an images folder, and this folder will not usually be protected from casual browsing.
If so, the entire contents of the images folder will be accessible to the public at large.

Depending upon file types, the files in an unprotected web folder may or may not be accessible; .php, .asp, and .aspx files are not accessible
although .gif, .jpg, .bmp, .png, and other image files are fully accessible. Additionally, without folder protection in place,
a hacker can make use of configuration files as well, such as config.inc and that could be where the websites database connection strings are held!
Therefore, the database itself could become compromised.

Source:Easy Website Security
////////////////////////////////////////////////////////////////////////////////


 This is a small module to scan your server folders for missing index.html files. If they are missing, you will be able to create them automatically.

 The module obviously does not have a place in the front page in the Main Menu, but can only be accessed through Administration as Admin.

 The module was tested with FireFox, Chrome, Opera, and IE8 and it worked fine with all.

 Should you discover any errors or is it not operating as intended please send email to culex@culex.dk.
 ....

The modules scans your web folders for missing index.html files. It skips folders where there are already index files (index.php, index.html, index.html).
If you find folders without you can automatically create these by pressing "create index files".

The module looks through the txt in your index.php, index.html, index.htm, mainfile.php, headers and footers for the words iFrame or fromCharCode whch is
commonly used in coded javascript inserts.

Should it find some occurrences of these words, you can check yourself the source code by clicking the red bar visible at the line for the file.
Do not check the files just because the module finds these words in your pages. Not all uses of iFrame and javascript is equal to damaging code and
therefor better to check and if in doubt ask for help about what to do with these files.

The module can scan your website folders to show in a list. Any file appearing not legit based on a filecheck and filter set in config,
is shown as 'Not XOOPS File' and can be deleted on the fly using ajax + jquery.

The module also creates a backup from your files using only the folder structure and existing index.html files. If there are missing index.html files,
it will create a new one. Once done,  it will offer this folder structure as a zipped file for download.


/culex
