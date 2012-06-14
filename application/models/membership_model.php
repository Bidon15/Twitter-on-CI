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

    public function  get_followers($id = NULL,$limit = NULL,$offset = NULL)
    {
        if($id == NULL){
            $this->db->limit($limit, $offset);
            $this->db->order_by('activated', 'desc');
            $query = $this->db->get('members');
            if ($query->num_rows() > 0) {

                return $query->result();
            }
        }

        if($limit == NULL && $offset == NULL){
        $query = $this->db->get_where('members',array('id'=>$id));
        return $query->row_array();
        }
    }

    public function count_users() {
        return $this->db->count_all('members');
    }

    public function do_upload($id)
    {
        $config = array(
            'allowed_types' => 'jpg|png|bmp|jpeg',
            'upload_path' => $this->gallery_path,
            'file_name'=>$id
        );
        $image =
        $this->upload->initialize($config);
        $this->upload->do_upload();
        $image_data=$this->upload->data();

        $config = array(
            'source_image'=>$image_data['full_path'],
            'maintain_ratio'=>TRUE,
            'width' => 60,
            'height'=> 60

        );
        $this->image_lib->initialize($config);
        $this->image_lib->resize();

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