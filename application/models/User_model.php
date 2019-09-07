<?php

class User_model extends CI_Model
{

    public function insertUser($name, $email, $password, $department, $level)
    {
        $query = $this->db->query("INSERT INTO users (name, email, password, department_id, level) VALUES ('$name', '$email', md5('$password'), $department, $level)");
        return $query;
    }

    public function loginUser($email, $password)
    {
        $query = $this->db->query("SELECT * FROM users WHERE email='$email' AND password=md5('$password')");
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserInfo($email){
        $query = $this->db->get_where('users', array('email' => $email));
        return $query->result_array();
    }

    public function getUserInfo_by_id($id){
        $query = $this->db->get_where('users', array('user_id' => $id));
        return $query->result_array();
    }

    public function getAllEmp_by_department($department_id, $user_id = 0){
        if($user_id == 0){
            $query = $this->db->get_where('users', array('department_id' => $department_id, 
                                                         'level' => '1'));
        }else{     
            $query = $this->db->get_where('users', array('department_id' => $department_id, 
                                                         'level' => '1', 
                                                         'user_id !=' => $user_id));
        }

        if ($query->num_rows() > 0)
        {  
            return $query->result_array();
        }
    }
}
