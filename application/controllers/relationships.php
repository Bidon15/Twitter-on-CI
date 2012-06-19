<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Bidon
 * Date: 18.06.12
 * Time: 12:20
 * To change this template use File | Settings | File Templates.
 */

class Relationships extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('membership_model');
    }

    public function create()
    {
        if($this->input->post('follow'))
        {
            $this->membership_model->follow();
        }
        redirect('users/show/'.$this->input->post('user_to_id'));

    }

    public function delete()
    {
        if($this->input->post('unfollow'))
        {
            $this->membership_model->unfollow();
        }
        redirect('users/show/'.$this->input->post('user_to_id'));
    }






}