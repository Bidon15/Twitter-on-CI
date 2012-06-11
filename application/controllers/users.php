<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Bidon
 * Date: 11.06.12
 * Time: 13:22
 * To change this template use File | Settings | File Templates.
 */

class Users extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->check_permission();

    }
    public function index()
    {
        echo '123';
        var_dump($this->input->cookie('user_id'));

    }


}