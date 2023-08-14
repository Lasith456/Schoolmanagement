<?php
    class Usermodel extends CI_Model {
        function getUser($username1) {
            // Select all columns (*)
            $this->db->select('*');
            
            // From the 'users' table
            $this->db->from('users');
            
            // Where the 'userName' column matches 'Admin'
            $this->db->where('userName', $username1);
            
            // Execute the query
            $query = $this->db->get();
            
            // Return the result as an array of objects
            return $query->result();
        }
        function getuserdetails($userid){
            // Select all columns (*)
            $this->db->select('*');
            
            // From the 'users' table
            $this->db->from('users');
            
            // Where the 'userName' column matches 'Admin'
            $this->db->where('user_id', $userid);
            
            // Execute the query
            $query = $this->db->get();
            
            // Return the result as an array of objects
            return $query->result();
        }
        function getallteachers(){
            // Select all columns (*)
            $this->db->select('*');
            
            // From the 'users' table
            $this->db->from('Teacher');

            // Execute the query
            $query = $this->db->get();
            
            // Return the data as an array of objects
            return $query->result();
        }
        function getuserdata($search,$limit,$offset){
            $sql = "SELECT users.userName, users.phoneNumber, users.email, users.Address, users.startDate, users.FullName 
        FROM users 
        WHERE userName LIKE '%$search%' OR phoneNumber LIKE '%$search%' OR email LIKE '%$search%' OR Address LIKE '%$search%' OR FullName LIKE '%$search%' ";
            $query = $this->db->query($sql."LIMIT $limit OFFSET $offset");

            $ret['all_users']=$query->result();
            $query1 = $this->db->query($sql);
            $ret['row_count']=$query1->num_rows();
            return $ret;
        }
        function all_student_count(){
            // Select all columns (*)
            $this->db->select('fullName');
            
            // From the 'users' table
            $this->db->from('student');
   
            // Execute the query
            $query = $this->db->get();
            
            // Return the result as an array of objects
            return $query->num_rows();
        }function all_student($limit, $start, $order, $dir) {
            $sql = "SELECT student.fullName, student.Email, student.mobileNumber, student.Address FROM student ORDER BY $order $dir LIMIT $limit OFFSET $start";
            $query = $this->db->query($sql);
            return $query->result();
        }
        
        function search_student($search, $limit, $start, $order, $dir) {
            $sql = "SELECT student.fullName, student.Email, student.mobileNumber, student.Address FROM student WHERE student.fullName LIKE '%".$search."%' ORDER BY $order $dir LIMIT $limit OFFSET $start";
            $query = $this->db->query($sql);
            return $query->result();
        }
        
           
        function student_filtered_count($search){
            $sql = "SELECT COUNT(*) as count FROM student WHERE student.fullName LIKE ?";
            $query = $this->db->query($sql, array($search.'%'));
            $result = $query->row();
            return $result->count;
        }

    }

?>