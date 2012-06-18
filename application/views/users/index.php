<h2><?php echo $title;?></h2><?php echo anchor('users/edit','Edit my Profile');?><br/>
<?php echo $links;
      foreach($results as $user):?>

<div id="main">
    <p>
       <?php if($user->image == NULL) {?> <img src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( $user->email_address )));?>" />
        <?php } else echo img($this->config->item('url_users_images') . $user->image); ?><br/>
<?php
        echo anchor('users/show/'.$user->id,$user->username);
      echo "<br/>";
      ?></p></div>

<?php endforeach;?>