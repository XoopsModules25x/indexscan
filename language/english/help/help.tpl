<div id="help-template" class="outer">
    <{include file=$smarty.const._MI_INDEXSCAN_HELP_HEADER}>

    <h4 class="odd">DESCRIPTION</h4>

    <p class="even">This is a small module to scan your server folders for missing <strong> index.html</strong>  files. If they are missing, you will be able to create them automatically.
        <br> <br>
    </p>

    <h4 class="odd">INSTALL/UNINSTALL</h4>

    <p class="even">No special measures necessary, follow the standard installation process –
        extract the module folder into the ../modules directory. Install the
        module through Admin -> System Module -> Modules.<br> <br>
        Detailed instructions on installing modules are available in the
        <a href="https://xoops.gitbook.io/xoops-operations-guide/" target="_blank">Chapter 2.12 of our XOOPS Operations Manual</a></p>


    <h4 class="odd">OPERATING INSTRUCTIONS</h4>

    This module and its operations are very simple.<br> <br>
    The modules scans your web folders for missing index.html files. It skips folders where there are already index files (index.php, index.html, index.html).
    If you find folders without you can automatically create these by pressing "create index files".<br> <br>

    The module looks through the txt in your index.php, index.html, index.htm, mainfile.php, headers and footers for the words iFrame or fromCharCode whch is
    commonly used in coded javascript inserts.<br> <br>

    Should it find some occurrences of these words, you can check yourself the source code by clicking the red bar visible at the line for the file.
    Do not check the files just because the module finds these words in your pages. Not all uses of iFrame and javascript is equal to damaging code and
    therefor better to check and if in doubt ask for help about what to do with these files.<br> <br>

    The module can scan your website folders to show in a list. Any file appearing not legit based on a filecheck and filter set in config,
    is shown as 'Not XOOPS File' and can be deleted on the fly using ajax + jquery.<br> <br>

    The module also creates a backup from your files using only the folder structure and existing index.html files. If there are missing index.html files,
    it will create a new one. Once done,  it will offer this folder structure as a zipped file for download.<br> <br>


    Detailed instructions on using XOOPS are available in
    <a href="https://xoops.gitbook.io/xoops-operations-guide/" target="_blank">our XOOPS Operations Manual</a><br> <br>

    <h4 class="odd">TUTORIAL</h4>

    <p class="even">There is no tutorial available at the moment.</p>

</div>
