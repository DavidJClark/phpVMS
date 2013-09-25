<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" media="all" type="text/css" href="<?php echo SITE_URL?>/lib/skins/empty/css/empty.css" />
    <?php 
    /* This is required, so phpVMS can output the necessary libraries it needs */
        echo $page_htmlhead; 
    /*Any custom Javascript should be placed below this line, after the above call */
    ?>
</head>
<body>
    <?php
        /* This should be the first thing you place after a <body> tag
	This is also required by phpVMS */
        echo $page_htmlreq;
    ?>

    <?php
    /*	You can modify this template into a table or something, by default
            it's list elements inside of a UL. Here's a link with some info:

            http://articles.sitepoint.com/article/css-anthology-tips-tricks-4/2
        */
        Template::Show('core_navigation.tpl');
    ?>


    <?php
    /*	This will insert all of the "meat" of the page in there - the template
            which is generated, depending on which page you're on. To change these
            templates, check out the docs on the site. They're under the /core/templates
            folder, and to change them, copy them into the folder of your skin (the
            folder this file is in right now.
        */

        echo $page_content;
    ?>

    <!-- Please retain this!! It's part of the phpVMS license. You must display a
            "powered by phpVMS" somewhere on your page. Thanks! -->
        <a href="http://www.phpvms.net" target="_blank">powered by phpVMS</a>

</body>
</html>