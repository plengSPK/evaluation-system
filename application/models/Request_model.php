<?php

class Request_model extends CI_Model
{
    public function getAllRequest($department_id){        

        $query = $this->db->get_where('requests', array('department_id' => $department_id));
        if ($query->num_rows() > 0)
        {           
            return $query->result_array();
        }
    }
    
    public function getAllRequest_by_Byuser($by_user_id){        

        $query = $this->db->get_where('requests', array('by_user_id' => $by_user_id));
        if ($query->num_rows() > 0)
        {           
            return $query->result_array();
        }
    }
    
    public function getRequest_by_id($request_id){        

        $query = $this->db->get_where('requests', array('request_id' => $request_id));
        if ($query->num_rows() > 0)
        {           
            return $query->result_array();
        }
    }

    public function InsertNewRequest($data_insert){
        
        $val_check = $this->checkNewRequest($data_insert['target_user_id'], $data_insert['by_user_id'], $data_insert['department_id']);
        if($val_check != false){   
            $this->db->where('request_id', $val_check[0]['request_id']);
            $query = $this->db->update('requests', $data_insert);
            return $query;
        }else {
            $query = $this->db->insert('requests', $data_insert);
            return $query;
        }
    }
    
    public function UpdateStatus($request_id, $status){
        
        $this->db->where('request_id', $request_id);
        $query = $this->db->update('requests', array('status' => $status));
        
        return $query;
    }

    public function checkNewRequest($target_user_id, $by_user_id, $department_id){
        $this->db->select(array('request_id','status'));
        $query = $this->db->get_where('requests', array('target_user_id' => $target_user_id,
                                                         'by_user_id' => $by_user_id,
                                                         'department_id' => $department_id,
                                                         'status' => '0'  ));
        if ($query->num_rows() > 0)
        {           
            return $query->result_array();
        }else{
            return false;
        }
    }

}
