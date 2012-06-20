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

    public function delete()
    {
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->where('id', $this->input->post('message_id'));
        $this->db->delete('messages');
    }

    public function get_messages($id)
    {
        if ($id != $this->session->userdata('user_id')) {
            $this->db->select('members.id, members.username, messages.message, messages.created');
            $this->db->from('members');
            $this->db->join('messages', 'members.id=messages.user_id', 'left');
            $this->db->where('members.id', $id);
            $query = $this->db->get();

            return $query->result_array();

        }
        else {
           // echo "<pre>";
            $this->db->select('user_to_id')->from('relationships')->where('user_from_id', $this->session->userdata('user_id'));
            $chosen_id = $this->db->get();
//            echo "<pre>";
//            print_r ($chosen_id->result_array());
//            echo "</pre>";
//            exit;
            if($chosen_id->num_rows() > 0)
            {
                foreach ($chosen_id->result_array() as $v) {
                        $follow_id[] = $v['user_to_id'];
                }

                $this->db->select('members.username, messages.message, messages.created, messages.user_id,members.id')->from('members', 'messages')
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



           // echo "</pre>";
            //exit;


//            $this->db->select('user_to_id');
//            $this->db->from('relationships');
//            $this->db->where('user_from_id', $this->session->userdata('user_id'));
//            $query = $this->db->get();
//            $users_id = $query->result_array();
//            foreach ($users_id as $k => $v) {
//                $followed_id[] = $v['user_to_id'];
//
//            }
//            $this->db->from('messages');
//            $this->db->where('user_id', $this->session->userdata('user_id'));
//            $this->db->or_where_in('user_id', $followed_id);
//            $query = $this->db->get();
//
//            $this->db->select('username, id');
//            $this->db->from('members');
//            $this->db->where('id', $this->session->userdata('user_id'));
//            $this->db->or_where_in('id', $followed_id);
//
//            $q = $this->db->get();
////            echo '<pre>';
////            print_r($q->result_array());
////            echo '</pre>';
//            $result = $query->result_array();
//
//            foreach ($q->result_array() as $qk => $qv) {
//                foreach ($result as $query_k => &$query_v) {
//                    if ($qv['id'] == $query_v['user_id']) {
//                        $query_v['username'] = $qv['username'];
//                    }
//                }
//            }
            return $query->result_array();
        }

    }


}