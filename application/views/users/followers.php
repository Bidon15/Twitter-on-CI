<div id='user'>
    <?php echo $user['username'];?><br/><?php echo anchor('users/show/'.$this->session->userdata('user_id'),'Home')?><br/>
    <?php if ($user['image'] == NULL) { ?> <img
    src="http://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($user['email_address'])));?>"/>
    <?php } else echo img($this->config->item('url_users_images') . $user['image']); ?></p>
    <?php echo anchor('users/following/' . $user['id'] . '/' . $count_followings, 'Following:  ' . $count_followings)  ?>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <?php echo anchor('users/followers/' . $user['id'] . '/' . $count_followers, 'Followers:  ' . $count_followers)?><!--<br/>-->

</div>

<div id="following">
    <h2><?php echo $title;?></h2>
    <?php echo anchor('users/edit', 'Edit My Profile');?><br/>
    <?php
    foreach ($results as $users):?>


        <p>
            <?php if ($users['image'] == NULL) { ?> <img
            src="http://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($users['email_address'])));?>"/>
            <?php } else echo img($this->config->item('url_users_images') . $users['image']); ?><br/>
            <?php
            echo anchor('users/show/' . $users['id'], $users['username']);
            echo "<br/>";
            ?></p>

        <?php endforeach;?>
</div>