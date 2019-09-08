<?php

class Approve_model extends CI_Model
{
    
    public function InsertNewApprove($data_insert){        
        $query = $this->db->insert('approves', $data_insert);
        return $query;
    }
}