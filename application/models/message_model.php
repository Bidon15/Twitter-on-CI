<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Bidon
 * Date: 18.06.12
 * Time: 12:25
 * To change this template use File | Settings | File Templates.
 */

class Message_model extends CI_Model {

    public function create()
    {
        $new_message = array(
            'user_id'=>$this->session->userdata('user_id'),
            'message'=>$this->input->post('message'),
            'created'=>now()
        );
        $this->db->insert('messages',$new_message);
    }

    public function delete()
    {

    }

    public function get_messages($id=NULL)
    {
        if($id != $this->session->userdata('user_id'))
        {
            $this->db->select('*');
            $this->db->from('messages');
            $this->db->join('relationships','relationships.user_to_id = messages.user_id');
            $this->db->where('relationships.user_to_id',$id);
            $query = $this->db->get();
            return $query->result();
        }
        else
        {
            $this->db->select('user_to_id');
            $this->db->from('relationships');
            $this->db->where('user_from_id',$this->session->userdata('user_id'));
            //$this->db->join('messages','messages.user_id = relationships');

            $query = $this->db->get();
//            $query = $this->db->get_where('messages',array('user_id'=>$this->session->userdata('user_id')));
            $my_id = $query->result_array();
            foreach($my_id as $k => $v)
            {
                $f_id[] = $v['user_to_id'];

            }
            $this->db->from('messages');
            $this->db->where('user_id',$this->session->userdata('user_id'));
            $this->db->or_where_in('user_id',$f_id);

            $query=$this->db->get();

            $this->db->select('username, id');
            $this->db->from('members');
            $this->db->where('id',$this->session->userdata('user_id'));
            $this->db->or_where_in('id',$f_id);

            $q=$this->db->get();
            echo '<pre>';
            //print_r($q->result_array());
            echo '</pre>';
           $result = $query->result_array();

            foreach($q->result_array() as $qk=>$qv)
            {
                foreach($result as $query_k=>&$query_v)
                {

                    if($qv['id'] == $query_v['user_id'])
                    {
                        $query_v['username']=$qv['username'];
                    }


                }
            }
            return $result;


        }


        /*else
        {

        }*/


    }







}