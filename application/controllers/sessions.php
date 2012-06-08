<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Bidon
 * Date: 07.06.12
 * Time: 14:11
 * To change this template use File | Settings | File Templates.
 */


class Sessions extends MY_Controller{

    public function index()
    {
        redirect('sessions/signin');
    }

    public function signin()
    {
        $this->load->model('membership_model');


        if($this->membership_model->validate() !== FALSE)
        {
            $data = array(
                'username'=>$this->input->post('username'),
                'id'=>$query = $this->membership_model->validate(),
            );

            $this->session->set_userdata($data);
            $this->input->set_cookie($data);
            redirect('members_area');
        }
        else
        {
            $this->output();
        }
    }

    public function members_area()
    {
        $this->load->view('members_area');
    }

    public function signout()
    {
        $this->load->model('membership_model');
        $this->session->sess_destroy();
        $this->input->delete_cookie();
        $this->output();
    }

    public function signup()
    {
        $data['main_content'] = 'signup_form';
        $this->load->view('includes/template',$data);
    }

    public function create_member()
    {
        $this->load->library('form_validation');
        //validation

        $this->form_validation->set_rules('first_name','Name','trim|required');
        $this->form_validation->set_rules('last_name','Last Name','trim|required');
        $this->form_validation->set_rules('email_address','Email Address','trim|required|valid_email');

        $this->form_validation->set_rules('username','Username','trim|required|min_length[4]');
        $this->form_validation->set_rules('password','Password','trim|required|min_length[4]');
        $this->form_validation->set_rules('password2','Password Again','trim|required|matches[password]');
        if($this->form_validation->run() == FALSE)
        {
            $this->signup();
        }

        else
        {
            $this->load->model('membership_model');
            if($query = $this->membership_model->create_member())
            {
                $data['main_content'] = 'signup_successful';
                $this->load->view('includes/template',$data);
            }
            else
            {
                $this->load->view('signup_form');
            }
        }
    }

}




?>