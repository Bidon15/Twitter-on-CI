<div id="login form" align="center">
    <h1>Sign In</h1>
    <?php

    echo form_open('sessions/signin');
    echo form_input('username', 'Username');
    echo form_password('password', 'Password');
    echo form_checkbox('cookie', 'remember', TRUE).'Remember Me!';
    echo form_submit('submit','Sign In');
    echo anchor('sessions/signup', 'Create Account');
    ?>


</div>