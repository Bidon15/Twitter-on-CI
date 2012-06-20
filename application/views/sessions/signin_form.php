
    <h1 align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif;">Sign In</h1>
    <?php
    echo $this->session->flashdata('activation');
    $attributes=array('class'=>'well');
    $submit=array('name'=>'submit','value'=>'Sign in','class'=>'btn btn-primary');
    ;?>
    <div style="width: 300px; margin: 100 auto">
    <?php echo form_open('sessions/signin',$attributes);?>
    <span class="label label-important">Username</span>
    <?php echo form_input('username');?><br/>
    <span class="label label-important">Password</span>
    <?php echo form_password('password');?><br/>
    <?php echo 'Remember Me!  '.form_checkbox('cookie', 'remember', TRUE);?><br/><br/>
    <?php echo form_submit($submit);?><br/><br/><br/>
    <?php echo anchor('sessions/signup', 'Wanna be famous? Create an account!');?>
    </div>

