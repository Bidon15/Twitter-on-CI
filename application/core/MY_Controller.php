<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Bidon
 * Date: 06.06.12
 * Time: 16:29
 * To change this template use File | Settings | File Templates.
 */

class MY_Controller extends CI_Controller{

    public function verify_user(){


        if($this->session->userdata('user_id')==NULL)
        {

            $cookie=$this->input->cookie('user_id');

            if($cookie)
            {
                $this->session->set_userdata(array('user_id' => $cookie));
                return TRUE;
            }
            else
            {

            return FALSE;
            }
        }
        else
        {
            return TRUE;
        }

    }

    public function check_permission()
    {
        if(!$this->verify_user())
        {
            redirect('sessions/signin');
        }
    }


    public function output($view_name,$content)
    {
        //$data=$this->retrieve();
        //$data = 'signin_form';
        $this->load->view('includes/header');
        $this->load->view($view_name,$content);

        $this->load->view('includes/footer');
    }


}