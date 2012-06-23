<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Bidon
 * Date: 07.06.12
 * Time: 15:17
 * To change this template use File | Settings | File Templates.
 */

class Membership_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function validate()
    {
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password', md5($this->input->post('password')));
        $query = $this->db->get('members');
        if ($query->num_rows() == 1) {
            $id_row = $query->row();
            $id_user = $id_row->id;
            return $id_user;
        }
        return FALSE;
    }

    public function create_member($activation_key)
    {
        $new_member_insert_data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email_address' => $this->input->post('email_address'),
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'activation_key' => $activation_key,
            'activated' => 0
        );

        $insert = $this->db->insert('members', $new_member_insert_data);
        return $insert;
    }

    public function activate_user($activation_key)
    {
        $this->db->where('activation_key', $activation_key);
        $query = $this->db->get('members');
        if ($query->num_rows() == 1) {
            $data = array('activation_key' => NULL,
                'activated' => now());
            $this->db->where('activation_key', $activation_key);
            $this->db->update('members', $data);
            return TRUE;
        }
        else
            return FALSE;

    }

    public function  get_followings($id, $is_count = NULL)
    {
        $this->db->select('members.username, members.id, members.email_address,members.image')->from('members')
            ->join('relationships', 'members.id = relationships.user_to_id')
            ->where('relationships.user_from_id', $id);
        $query = $this->db->get();
        if ($is_count != NULL) {
            return $query->result_array();
        }
        else {
            return $query->num_rows();
        }

    }


    public function  get_followers($id = NULL, $is_count = NULL, $limit, $offset)
    {
        if ($id == NULL) {
            $this->db->limit($limit, $offset);
            $this->db->order_by('activated', 'desc');
            $query = $this->db->get('members');
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
        }
        else {
            $this->db->select('members.username,members.id,members.image,members.email_address')->from('members')
                ->join('relationships', 'members.id = relationships.user_from_id')
                ->where_in('relationships.user_to_id', $id);
            $query = $this->db->get();
//            echo "<pre>test";
//            print_r ($query->result_array());
//            echo "</pre>";
//            exit;
            if ($is_count == NULL) {
                return $query->num_rows();
            }
            else {
                return $query->result_array();
            }
        }

    }


    public function count_users()
    {
        return $this->db->count_all('members');
    }

    public function do_upload($image_name)
    {
        $this->db->where('id', $this->session->userdata('user_id'));
        $query = $this->db->get('members');
        $image_row = $query->row();
        if (($image_user = $image_row->image) == NULL) {
            $data = array('image' => $image_name);
            $this->db->where('id', $this->session->userdata('user_id'));
            $this->db->update('members', $data);
        }
        else {
            $data = array('image' => $image_name);
            unlink('./uploads/' . $image_user);
            $this->db->where('id', $this->session->userdata('user_id'));
            $this->db->update('members', $data);

        }

    }

    public function update_user()
    {
        $this->db->where('password', md5($this->input->post('password')));
        $this->db->where('id', $this->session->userdata('user_id'));
        $query = $this->db->get('members');
        if ($query->num_rows() == 1) {
            if($this->input->post('new_email_address')=='')
            {
                $updated_data = array(
                    'password' => md5($this->input->post('new_password'))
                );
            }
            else
            {
                $updated_data = array(
                    'email_address' => $this->input->post('email_address'),
                    'password' => md5($this->input->post('new_password'))
                );

            }
            $this->db->where('id', $this->session->userdata('user_id'));
            $this->db->update('members', $updated_data);
        }
        return FALSE;
    }

    public function get_users($id)
    {
        $query = $this->db->get_where('members', array('id' => $id));
        return $query->row_array();
    }

    public function if_followed($id)
    {
        $array = array('user_from_id' => $this->session->userdata('user_id'), 'user_to_id' => $id);
        $this->db->where($array);
        $query = $this->db->get('relationships');
        if ($query->num_rows() == 1) {
            return TRUE;
        }
        else {
            return FALSE;
        }

    }

    public function follow()
    {
        $new_relationship = array(
            'user_from_id' => $this->session->userdata('user_id'),
            'user_to_id' => $this->input->post('user_to_id')
        );
        $this->db->insert('relationships', $new_relationship);
    }

    public function unfollow()
    {
        $this->db->where('user_from_id', $this->session->userdata('user_id'));
        $this->db->delete('relationships');
    }
}