<div id="parent">
    <div class="left">
        <div id="show_user">
            <div id="image">
                <?php if ($users['image'] == NULL) { ?> <img
                src="http://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($users['email_address'])));?>"/>
                <?php } else echo img($this->config->item('url_users_images') . $users['image']); ?>
            </div>
            <div id="username">
                <span style="font-size: 14pt;"><?php echo $users['username'];?></span>
            </div>
        </div>
        <div id="follow">
            <?php echo anchor('users/following/' . $users['id'] . '/' . $count_followings, 'Following:  ' . $count_followings)  ?>
            &nbsp;&nbsp;&nbsp;&nbsp;<?php echo anchor('users/followers/' . $users['id'] . '/' . $count_followers, 'Followers:  ' . $count_followers)?>
        </div>


        <?php
        if ($users['id'] == $this->session->userdata('user_id')):
            ?><div id="show_post"><?php
            echo form_open('messages/create');
            $text_area = array('cols' => '30', 'rows' => '4', 'name' => 'message');
            echo form_textarea($text_area);?><br/><?php
            echo form_submit('post', 'Post');
            echo form_close();
            ?>
            </div>

            <?php else :
            if ($if_followed) {
                echo form_open('relationships/delete');
                echo form_hidden('user_to_id', $users['id']);
                echo form_submit('unfollow', 'Unfollow');
                echo form_close();
            }
            else {
                echo form_open('relationships/create');
                echo form_hidden('user_to_id', $users['id']);
                echo form_submit('follow', 'Follow');
                echo form_close();

            }
        endif;
        ?>
    </div>
    <div class="right">
        <?php
        echo form_open('messages/delete');
        ?><blockquote><p>
        <?php
        foreach ($user_message as $k => $v) {

            if (isset($v['message'])) {
                echo $v['username'] . '&nbsp;&nbsp;Wrote:&nbsp;&nbsp;&nbsp;&nbsp;';
                echo $v['message'];?></p><br/><small>
                <?php
                    $post_date = $v['created'];
                    $now = time();
                    echo timespan($post_date, $now);
                if ($v['id'] == $this->session->userdata('user_id')) {
                    form_hidden('message_id', $v['id']);
                    echo form_submit('delete', 'Delete post');
                }
                ?></small><hr/><br/><br/><?php
            }
        }
        echo form_close();
        ?>
    </blockquote>
    </div>
</div>





