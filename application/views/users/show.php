<div id="main">
<p>
<?php //echo'<pre>'; print_r($users); echo '</pre>'; exit;?>
<?php echo $users['username'];?><br/>
    <?php if($users['image'] == NULL) {?> <img src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( $users['email_address'] )));?>" />
    <?php } else echo img($this->config->item('url_users_images') . $users['image']); ?></p>
<?php echo anchor('users/following','Following:  '.$count_followers)  ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo anchor('users/followers','Followers:  '.$count_followings)?><br/>
<?php
    if($users['id'] == $this->session->userdata('user_id'))
    {
        echo form_open('messages/create');
        $text_area = array('cols'=>'30','rows'=>'4','name'=>'message');
        echo form_textarea($text_area);?><br/><?php
        echo form_submit('post','Post');
        echo form_close();
    }
    else{
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
    }
    echo form_open('messages/delete');
    foreach ($user_message as $k => $v){
        echo $v['username'].'&nbsp;&nbsp;Wrote:&nbsp;&nbsp;&nbsp;&nbsp;'; echo $v['message'];?>&nbsp;&nbsp;&nbsp;&nbsp;<br/>
        <?php
        if($v['id'] == $this->session->userdata('user_id'))
        {
            form_hidden('message_id',$v['id']);
            echo form_submit('delete','Delete post');
        }
        $post_date = $v['created'];
        $now = time();
        echo timespan($post_date, $now);?><br/><br/><?php
    }
    echo form_close();

    echo anchor('users/index','Go to all users');

    ?>

</div>



