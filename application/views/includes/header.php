<html>
<head>
    <title>1234</title>
   <?php echo link_tag('css/bootstrap.css'); ?>

</head>
<body>
<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="sessions/signin">Twitter on CI</a>
            <div class="nav-collapse">
                <ul class="nav pull-right">
                    <li>
                        <?php echo anchor('users/index','Home')?>
                    </li>
                    <li>
                        <?php echo anchor('sessions/help','Help')?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php //echo anchor('sessions/signout','Sign Out')?>







