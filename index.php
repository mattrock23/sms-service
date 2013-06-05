<?php
require('data/functions.php');
$groupNames = getGroupNames();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" ng-app="sms-service"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <nav>
            <menu>
                <li><a href="#/messages">Messages</a></li>
                <li class="subitem"><a href="#/messages/pending">Pending</a></li>
                <li class="subitem"><a href="#/messages/sent">Sent</a></li>
                <li><a href="#/subscribers">Subscribers</a></li>
                <?php
                    array_walk($groupNames, 'makeLink');
                ?>
                <li><a href="#/analytics">Analytics</a></li>
            </menu>
        </nav>
        <section id="main" ng-view>
            
        </section>
        <script src="js/vendor/jquery-1.9.1.min.js"></script>
        <script src="js/vendor/angular.js"></script>
        <script src="js/main.js"></script>
        <script src="js/vendor/jcanvas.min.js"></script>
        <script src="js/graph.js"></script>

    </body>
</html>
