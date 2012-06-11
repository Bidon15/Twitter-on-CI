<h1>Create an Account</h1>

<fieldset>
    <legend>Personal Information</legend>

    <?php

    echo form_open('sessions/signup');
    echo form_input('first_name', set_value('first_name', 'First Name'));
    echo form_input('last_name', set_value('last_name', 'Last Name'));
    echo form_input('email_address', set_value('email_address', 'Email Address'));
    ?>
</fieldset>
<fieldset>
    <legend>Singup Info</legend>
    <?php
    echo form_input('username', set_value('username', 'Username'));
    echo form_password('password', set_value('password', 'Password'));
    echo form_password('password2', set_value('password2', 'Password Again'));
    echo form_submit('submit', 'Create Account');
    //$activation_key = uniqid('',true);

    ?>

    <?php echo validation_errors('<p class="error">');?>
</fieldset>