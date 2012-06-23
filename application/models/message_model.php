<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Bidon
 * Date: 18.06.12
 * Time: 12:25
 * To change this template use File | Settings | File Templates.
 */

class Message_model extends CI_Model
{

    public function create()
    {
        $new_message = array(
            'user_id' => $this->session->userdata('user_id'),
            'message' => $this->input->post('message'),
            'created' => now()
        );
        $this->db->insert('messages', $new_message);
    }

    public function delete($id)
    {
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->where('id', $id);
        $this->db->delete('messages');
    }

    public function get_messages($id)
    {
        if ($id != $this->session->userdata('user_id')) {
            $this->db->select('members.id, members.username, messages.message, messages.created,messages.id,messages.user_id');
            $this->db->from('members');
            $this->db->join('messages', 'members.id=messages.user_id');
            $this->db->where('members.id', $id);
            $query = $this->db->get();

            return $query->result_array();

        }
        else {
            $this->db->select('user_to_id')->from('relationships')->where('user_from_id', $this->session->userdata('user_id'));
            $chosen_id = $this->db->get();
            if($chosen_id->num_rows() > 0)
            {
                foreach ($chosen_id->result_array() as $v) {
                        $follow_id[] = $v['user_to_id'];
                }

                $this->db->select('members.username, messages.message, messages.created, messages.user_id,members.id,messages.id')->from('members', 'messages')
                    ->join('messages', 'members.id = messages.user_id')->where_in('members.id', $follow_id)->or_where('members.id',$this->session->userdata('user_id'))
                    ->order_by('messages.created', 'desc');
                $query=$this->db->get();
            }
            else
            {
                $this->db->select('members.id, members.username, messages.message, messages.created');
                $this->db->from('members');
                $this->db->join('messages', 'members.id=messages.user_id', 'left');
                $this->db->where('members.id', $id);
                $query = $this->db->get();

            }
            return $query->result_array();

        }

    }


}