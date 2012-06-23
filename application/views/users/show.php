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
            ?>
            <div id="show_post"><?php
                echo form_open('messages/create');
                $posted = array('name' => 'post', 'value' => 'Post', 'class' => 'btn btn-success');
                $text_area = array('cols' => '30', 'rows' => '4', 'name' => 'message');
                echo form_textarea($text_area);?><br/><?php
                echo form_submit($posted);
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
        <blockquote><p>
            <?php
            foreach ($user_message as $k):
                echo $k['username'] . '&nbsp;&nbsp;Wrote:&nbsp;&nbsp;&nbsp;&nbsp;';
                echo $k['message'];?></p><br/>
                <small>
                    <?php
                    $post_date = $k['created'];
                    $now = time();
                    echo timespan($post_date, $now);
                    if ($k['user_id'] == $this->session->userdata('user_id'))
                        echo anchor('messages/delete/' . $k['id'], 'Delete', array('class' => 'btn btn-danger'));
                    ?></small>
                <hr/><br/><br/>
                <?php
            endforeach;
            ?>
        </blockquote>
    </div>
</div>





