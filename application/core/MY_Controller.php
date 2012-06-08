<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Bidon
 * Date: 06.06.12
 * Time: 16:29
 * To change this template use File | Settings | File Templates.
 */

class MY_Controller extends CI_Controller{
    public function output()
    {
        $data['main_content'] = 'signin_form';
        $this->load->view('includes/template',$data);
    }


}