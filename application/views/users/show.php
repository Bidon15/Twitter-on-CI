
<div id="main">
<p>

<?php echo $users['username'];?><br/>
    <?php if($users['image'] == NULL) {?> <img src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( $users['email_address'] )));?>" />
    <?php } else echo img($this->config->item('url_users_images') . $users['image']); ?></p>
<?php
    if($users['id'] == $this->session->userdata('user_id'))
    {
        form_open('users/messages');
    }
    if($if_followed)
    {
        echo form_open('relationships/delete');
        echo form_hidden('user_to_id',$users['id']);
        echo form_submit('unfollow','Unfollow');
        echo form_close();
    }
    else
    {
        echo form_open('relationships/create');
        echo form_hidden('user_to_id',$users['id']);
        echo form_submit('follow','Follow');
        echo form_close();
    }

    echo anchor('users/index','Go to all users');

    ?>

</div>



