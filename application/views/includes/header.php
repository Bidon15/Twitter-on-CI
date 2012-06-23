<html>
<head>
    <title>1234</title>
    <?php echo link_tag('css/bootstrap.css'); ?>
</head>
<body>
<div id='header'>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container">
                <a class="brand" style="color: #f5f5f5;"
                   href="http://localhost/twitter/index.php/sessions/signin">Twitter on CI</a>

                <div class="nav-collapse">
                    <ul class="nav pull-right">
                        <?php if (!$this->session->userdata('user_id')) : ?>
                        <li>
                            <?php echo anchor('sessions/signup', 'Sign Up') ?>
                        </li>
                        <li>
                            <?php echo anchor('sessions/help', 'Help')?>
                        </li>
                        <?php  else : ?>
                        <li>
                            <?php echo anchor('users/edit', 'Edit My Profile');?>
                        </li>
                        <li>
                            <?php echo anchor('users/show/' . $this->session->userdata('user_id'), 'Home');?>
                        </li>
                        <li>
                            <?php echo anchor('users/index', 'Users');?>
                        </li>
                    <li>
                        <?php echo anchor('sessions/signout', 'Sign Out');
                    endif; ?>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php //echo anchor('sessions/signout','Sign Out')?>