<div id='parent'>
    <h1 align="center" style="font-size: 33pt;">Sign In</h1>
    <?php
    echo $this->session->flashdata('activation');
    $attributes=array('class'=>'well');
    $submit=array('name'=>'submit','value'=>'Sign in','class'=>'btn btn-large btn-primary');
    ;?>
    <div style="width: 300px; margin: 100 auto; font-size: 14pt;">
    <?php echo form_open('sessions/signin',$attributes);?>
    <span class="label label-important" style="font-size: 13pt">Username</span>
    <?php echo form_input('username');?><br/>
    <span class="label label-important" style="font-size: 13pt">Password</span>
    <?php echo form_password('password');?><br/>
    <?php echo 'Remember Me!  '.form_checkbox('cookie', 'remember', TRUE);?><br/><br/>
    <?php echo form_submit($submit);?>
    </div>

</div>