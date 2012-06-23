<div id="parent">
    <h1><?php echo $title;?></h1><?php //echo anchor('users/edit','Edit my Profile');?><br/>

    <div class="pager">
        <?php echo '<ul>' . $links . '</ul>';?>
    </div>

        <hr/>
        <?php foreach ($results as $user): ?>


        <p>
            <?php if ($user['image'] == NULL) { ?> <img
            src="http://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($user['email_address'])));?>"/>
            <?php } else echo img($this->config->item('url_users_images') . $user['image']); ?><br/>
            <?php
            echo anchor('users/show/' . $user['id'], $user['username']);
            echo "<br/>";
            ?></p>
        <hr/>


        <?php endforeach;?></div>
