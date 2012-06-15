<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Bidon
 * Date: 07.06.12
 * Time: 14:11
 * To change this template use File | Settings | File Templates.
 */


class Sessions extends MY_Controller
{

    public function index()
    {
        redirect('sessions/signin');
    }

    public function signin()
    {
        $this->load->model('membership_model');
        $content = '';

        if ($this->membership_model->validate() !== FALSE) {
            $data = array(
                'name' => 'user_id',
                'value' => $query = $this->membership_model->validate(),
                'expire' => 2629748
            );

            $this->session->set_userdata('user_id', $this->membership_model->validate());
            if ($this->input->post('cookie'))
                $this->input->set_cookie($data);
            redirect('users/index');
        }
        else {
            $this->output('sessions/signin_form',$content);
        }
    }

    /*public function members_area()
    {
        $this->output('sessions/members_area','');
    }*/


    public function signout()
    {
        $this->session->sess_destroy();
        delete_cookie();
        $this->output('sessions/signin_form','');
    }

    public function signup()
    {
        $this->load->library('form_validation');
        //validation

        $this->form_validation->set_rules('first_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email|is_unique[members.email_address]');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|is_unique[members.username]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('password2', 'Password Again', 'trim|required|matches[password]');
        if ($this->form_validation->run() == FALSE) {
            $this->output('sessions/signup_form','');
        }

        else {
            $this->load->model('membership_model');
            $activation_key = random_string('unique');
            if ($query = $this->membership_model->create_member($activation_key)) {
                $this->_sending_email($this->input->post('email_address'), $activation_key);
                $this->session->set_flashdata('activation','Your account has been created. To start twitting please activate the link that has been sent to your mail');
                redirect('sessions/signin');

            }
            else {
                $this->output('sessions/signup_form','');
            }


        }
    }

    private function _sending_email($email, $activation_key)
    {
        $this->load->library('email');
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from('braveryandglory@gmail.com', 'Administration');
        $this->email->to($email);
        $this->email->subject('Activation message');
        $this->email->message('Please click on the link to activate your account '.anchor('users/activation/'.$activation_key));
        $this->email->send();
    }

}


?>