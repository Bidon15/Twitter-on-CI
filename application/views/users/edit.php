<h2>You can edit your profile now!</h2>
<div class="edit">
<?php echo 'Your nickname:  '.$username['username'];?><br/>
<?php echo 'Your email address:  '.$email_address['email_address'];?><br/>
<?php echo form_open_multipart('users/edit');?>
<?php echo form_upload('userfile');?>
<?php echo form_submit('upload','make an avatar');?>
<?php echo form_close()?>
</div>
