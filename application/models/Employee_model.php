<?php
class Employee_model extends CI_Model {

    function getEmployee($limit, $start){
        $this->db->select('C.company_name,E.*');
        $this->db->from('employee E');
        $this->db->join('company C', 'C.company_id = E.company_id', 'left'); 
        $this->db->limit($limit, $start);
        $company_data = $this->db->get()->result_array();
        return $company_data;
    }
    
    function getSingleEmployee($employee_id){       
        $this->db->select('C.company_name,C.company_id,E.*');
        $this->db->from('employee E');
        $this->db->join('company C', 'C.company_id = E.company_id', 'left'); 

        if($employee_id){
            $this->db->where('employee_id',$employee_id);
        }
        $employee_data = $this->db->get()->row_array();
        return $employee_data;
    }

    function newEmployee($data){
        $this->db->insert('employee', $data);
        return $this->db->insert_id();
    }

    function updateEmployee($data,$employee_id){
        $this->db->where('employee_id', $employee_id);
        $this->db->update('employee', $data);
    }

    function deleteCompany($employee_id){
        $this->db->where('employee_id' , $employee_id);
        $query = $this->db->delete('employee');
    }

    function get_count(){
        return $this->db->count_all("employee");
    }
}
?>