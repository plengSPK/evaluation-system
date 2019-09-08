<?php

class Approve_model extends CI_Model
{
    
    public function InsertNewApprove($data_insert){        
        $query = $this->db->insert('approves', $data_insert);
        return $query;
    }

    public function GetApprove($request_id){    
        $query = $this->db->get_where('approves', array('request_id' => $request_id));
        if ($query->num_rows() > 0)
        {           
            return $query->result_array();
        }
    }
}