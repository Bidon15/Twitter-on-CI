<div id="login form" align="center">
    <h1>Sign In</h1>
    <?php

    echo form_open('sessions/validate_credentials');
    echo form_input('username', 'Username');
    echo form_password('password', 'Password');
    echo form_submit('submit','Sign In');
    echo anchor('sessions/signup', 'Create Account');
    ?>


</div>