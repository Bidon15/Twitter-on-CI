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
        $config['total_rows'] = $this->membership_model->count_users();
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['results'] = $this->membership_model->get_followers(NULL,$config["per_page"], $page);
        $data['links'] = $this->pagination->create_links();
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

        $data['users'] = $this->membership_model->get_users($id);

        if (empty($data['users']))
        {
            show_404();
        }

        $this->output('users/show',$data);
    }

    public function edit()
    {

        if($this->input->post('change'))
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email|is_unique[members.email_address]');
            $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[4]');
            $this->form_validation->set_rules('new_password2', 'New Password Again', 'trim|required|matches[new_password]');
            if ($this->form_validation->run() == FALSE) {
                $this->output('users/edit','');
            }
            else {
                $this->membership_model->update_user();

            }
        }
        if($this->input->post('upload')){

            if (!empty($_FILES['image']['tmp_name']))
            {
                $image_name = random_string('unique').'.jpg';
                move_uploaded_file($_FILES['image']['tmp_name'], $this->config->item('path_users_images') . $image_name);
                $config = array(
                    'source_image'=>$this->config->item('path_users_images') . $image_name,
                    'maintain_ratio'=>TRUE,
                    'width' => 80,
                    'height'=> 80
                );
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->membership_model->do_upload($image_name);
            }
        }
        $data['users'] = $this->membership_model->get_users($this->session->userdata('user_id'));
        $this->output('users/edit',$data);

    }








}