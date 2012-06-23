<div id="parent">
    <h1>Create an Account</h1>

    <div class="left">
        <fieldset>
            <legend>Personal Information</legend>
            <?php
            echo form_open('sessions/signup');
            echo form_input('first_name', set_value('first_name', 'First Name')).'<br/>';
            echo form_input('last_name', set_value('last_name', 'Last Name')).'<br/>';
            echo form_input('email_address', set_value('email_address', 'Email Address')).'<br/>';
            ?>
        </fieldset>
    </div>

    <div class="right">
        <fieldset>
            <legend>Singup Info</legend>
            <?php
            echo form_input('username', set_value('username', 'Username')).'<br/>';
            echo form_password('password', set_value('password', 'Password')).'<br/>';
            echo form_password('password2', set_value('password2', 'Password Again')).'<br/>';
            $submit = array('name'=>'submit','value'=>'Create Account','class'=>'btn btn-info');
            echo form_submit($submit);
            //$activation_key = uniqid('',true);
            ?>
            <?php echo validation_errors('<p class="error">');?>
        </fieldset>
    </div>
</div>