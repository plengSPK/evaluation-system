<?php

class Department_model extends CI_Model
{
    public function getAllDepartment(){
        $query = $this->db->get('departments');
        if ($query->num_rows() > 0)
        {           
            return $query->result_array();
        }
    }
}
