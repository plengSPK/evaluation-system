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

    public function getDepartment_by_id($department_id){
        $query = $this->db->get_where('departments', array('department_id' => $department_id));
        return $query->result_array();
    }
}
