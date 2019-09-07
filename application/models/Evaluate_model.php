<?php

class Evaluate_model extends CI_Model
{
    public function getEvaluation_by_emp($department_id, $evaluator_user_id, $quarter, $year){        

        //$this->db->select('target_user_id');
        $query = $this->db->get_where('evaluates', array('evaluator_user_id' => $evaluator_user_id, 
                                                         'department_id' => $department_id, 
                                                         'quarter' => $quarter, 
                                                         'year' => $year));
        if ($query->num_rows() > 0)
        {           
            return $query->result_array();
        }
    }
    
    public function getEvaluation_by_id($evaluate_id){        

        $query = $this->db->get_where('evaluates', array('evaluate_id' => $evaluate_id));
        if ($query->num_rows() > 0)
        {           
            return $query->result_array();
        }
    }

    public function getEvaluation_by_targetUser($target_user_id, $quarter ,$year){        

        $query = $this->db->get_where('evaluates', array('target_user_id' => $target_user_id, 
                                                         'quarter' => $quarter, 
                                                         'year' => $year));
        if ($query->num_rows() > 0)
        {           
            return $query->result_array();
        }
    }

    public function getAllEvaluation($department_id, $quarter, $year){        

        $query = $this->db->get_where('evaluates', array('department_id' => $department_id,'evaluator_user_id != target_user_id'));
        if ($query->num_rows() > 0)
        {           
            return $query->result_array();
        }
    }

    
    public function InsertNewRecord($data_insert){  

        $val_check = $this->checkAlreadyRecorded($data_insert['evaluator_user_id'], $data_insert['target_user_id'], $data_insert['quarter'], $data_insert['year']);
        if($val_check != false){   
            $this->db->where('evaluate_id', $val_check[0]['evaluate_id']);
            $query = $this->db->update('evaluates', $data_insert);
            return $query;
        }else {
            $query = $this->db->insert('evaluates', $data_insert);
            return $query;
        }
    }

    public function checkAlreadyRecorded($evaluator_user_id, $target_user_id, $quarter, $year){
        $this->db->select('evaluate_id');
        $query = $this->db->get_where('evaluates', array('evaluator_user_id' => $evaluator_user_id,
                                                         'target_user_id' => $target_user_id,
                                                         'quarter' => $quarter,
                                                         'year' => $year  ));
        if ($query->num_rows() > 0)
        {           
            return $query->result_array();
        }else{
            return false;
        }
    }
}
