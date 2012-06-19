<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Bidon
 * Date: 18.06.12
 * Time: 12:38
 * To change this template use File | Settings | File Templates.
 */

class Messages extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('message_model');
    }

    public function create()
    {
        if($this->input->post('post'))
        {
            $this->message_model->create();
        }
        redirect('users/show/'.$this->session->userdata('user_id'));

    }

    public function delete()
    {
        if($this->input->post('delete'))
        {
            $this->message_model->delete();
        }
        redirect('users/show/'.$this->session->userdata('user_id'));
    }


}