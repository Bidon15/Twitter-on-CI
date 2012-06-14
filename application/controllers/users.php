<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Bidon
 * Date: 11.06.12
 * Time: 13:22
 * To change this template use File | Settings | File Templates.
 */

class Users extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_permission();
        $this->load->model('membership_model');

    }

    public function index()
    {
        $config['base_url']='http://localhost/twitter/index.php/users/index/';
        $config["total_rows"] = $this->membership_model->count_users();
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->membership_model->get_followers(NULL,$config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['title'] = 'All users';
        $this->output('users/index',$data);

    }

    public function activation($activation_key)
    {


        if ($this->membership_model->activate_user($activation_key)) {
            $this->session->set_flashdata('activation','Your account has been activated. Please sign in and start trolling.');
            redirect('sessions/signin');

        }
        else {
            $this->session->set_flashdata('activation','You failed activating your account. Please contact our administration for further information.');
            redirect('sessions/signin');
        }

    }


    public function show($id)
    {

        $data['username'] = $this->membership_model->get_followers($id);

        if (empty($data['username']))
        {
            show_404();
        }

        $this->output('users/show',$data);
    }

    public function edit()
    {
        if($this->input->post('upload')){
            $this->membership_model->do_upload($this->session->userdata('user_id'));
        }
        $data['username'] = $this->membership_model->get_followers($this->session->userdata('user_id'));
        $data['email_address'] = $this->membership_model->get_followers($this->session->userdata('user_id'));
        $data['images'] = $this->membership_model->get_images($this->session->userdata('user_id'));

        //$this->load->view('gallery', $data);

        $this->output('users/edit',$data);
    }




}