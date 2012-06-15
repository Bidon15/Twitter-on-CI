<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Bidon
 * Date: 07.06.12
 * Time: 15:17
 * To change this template use File | Settings | File Templates.
 */

class Membership_model extends CI_Model{

    var $gallery_path;
    var $gallery_path_url;
    public function __construct()
    {
        parent::__construct();
        $this->gallery_path = realpath(APPPATH.'../uploads');
        $this->gallery_path_url = base_url().'uploads/';

    }

    public function validate()
    {
        $this->db->where('username',$this->input->post('username'));
        $this->db->where('password',md5($this->input->post('password')));
        $query = $this->db->get('members');
        if($query->num_rows() == 1)
        {
            $id_row = $query->row();
            $id_user = $id_row->id;
            return $id_user;
        }
        return FALSE;
    }

    public function create_member($activation_key)
    {
        $new_member_insert_data = array(
            'first_name'=>$this->input->post('first_name'),
            'last_name'=>$this->input->post('last_name'),
            'email_address'=>$this->input->post('email_address'),
            'username'=>$this->input->post('username'),
            'password'=>md5($this->input->post('password')),
            'activation_key'=>$activation_key,
            'activated'=>0
        );

        $insert = $this->db->insert('members',$new_member_insert_data);
        return $insert;
    }

    public function activate_user($activation_key)
    {
        $this->db->where('activation_key', $activation_key);
        $query = $this->db->get('members');
        if($query->num_rows() == 1)
        {
            $data = array('activation_key'=> NULL,
                          'activated' =>now());
            $this->db->where('activation_key', $activation_key);
            $this->db->update('members', $data);
            return TRUE;
        }
        else
            return FALSE;

    }

    public function  get_followers($id = NULL,$limit,$offset)
    {
        if($id == NULL){
            $this->db->limit($limit, $offset);
            $this->db->order_by('activated', 'desc');
            $query = $this->db->get('members');
            if ($query->num_rows() > 0) {

                return $query->result();
            }
        }

    }

    public function count_users() {
        return $this->db->count_all('members');
    }

    public function do_upload($image_name)
    {   $this->db->where('id',$this->session->userdata('user_id'));
        $query = $this->db->get('members');
        $image_row = $query->row();
        if(($image_user = $image_row->image) == NULL)
        {
            $data = array('image'=>$image_name);
            $this->db->where('id',$this->session->userdata('user_id'));
            $this->db->update('members', $data);
        }
        else
        {   $data = array('image'=>$image_name);
            unlink('./uploads/'.$image_user);
            $this->db->where('id',$this->session->userdata('user_id'));
            $this->db->update('members', $data);

        }

    }

    public function update_user()
    {

        $this->db->where('password',md5($this->input->post('password')));
        $this->db->where('id',$this->session->userdata('user_id'));
        $query = $this->db->get('members');
        if($query->num_rows() == 1)
        {

            $updated_data = array(
                'email_address'=>$this->input->post('email_address'),
                'password'=>md5($this->input->post('new_password'))
            );
            $this->db->where('id',$this->session->userdata('user_id'));
            $this->db->update('members',$updated_data);
        }
        return FALSE;
    }

    public function get_users($id)
    {
        $query = $this->db->get_where('members',array('id'=>$id));
        return $query->row_array();
    }





    //Under Construction
    /*public function get_images($id) {

        $files = scandir($this->gallery_path);
        $files = array_diff($files, array('.', '..'));

        $images = array();

        foreach ($files as $file) {
            $images []= array (
                'url' => $this->gallery_path_url . $file,

            );
        }
    }*/






}