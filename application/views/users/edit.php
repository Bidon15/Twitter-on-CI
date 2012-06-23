<div id="parent">
    <h2>You can edit your profile now!</h2>

    <div class="right">
        <?php echo form_open('users/edit');?>
        To set a new password please enter your current password<br/>
        <?php echo form_password('password', set_value('password', 'Password'));?><br/>
        Now, please enter your new password and confirm it<br/>
        <?php echo form_password('new_password', set_value('new_password', 'New Password'));?><br/>
        <?php echo form_password('new_password2', set_value('new_password2', 'New Password Again'));?><br/>
        <?php echo 'Your email address:  ' . $users['email_address'];?><br/>
        <?php  echo form_input('new_email_address');?><br/>
        <?php $change = array('name' => 'change', 'value' => 'Update My Profile', 'class' => 'btn btn-primary');?>
        <?php echo form_submit($change); ?>
        <?php echo form_close()?>
    </div>
    <div class="left">
        <?php echo form_open_multipart('users/edit');?>
        <?php if ($users['image'] == NULL) { ?> <img
        src="http://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($users['email_address'])));?>"/>
        <?php } else echo img($this->config->item('url_users_images') . $users['image']); ?><br/>
        <?php echo form_upload('image');?><br/>
        <?php $upload = array('name' => 'upload', 'value' => 'Update an Avatar', 'class' => 'btn btn-primary');?>
        <?php echo form_submit($upload);?>
        <?php echo form_close()?>

    </div>
</div>