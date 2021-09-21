<?php
class Company_model extends CI_Model
{
    function getCompany($limit, $start)
    {
        $this->db->limit($limit, $start);
        $company_data=$this->db->get('company')->result_array();
        return $company_data;
    }

    function getSingleCompany($company_id)
    {
        if($company_id){
            $this->db->where('company_id',$company_id);
        }
        $company_data=$this->db->get('company');
        $company_data=$company_data->row_array();

        if (!empty($company_data)){
            return $company_data;
        }
        else{
            return 0;
        }
    }

    function newCompany($data){
        $this->db->insert('company', $data);
        return $this->db->insert_id();
    }

    function updateCompany($data,$company_id){
        $this->db->where('company_id', $company_id);
        $this->db->update('company', $data);
    }

    function deleteCompany($company_id){
        $this->db->where('company_id' , $company_id);
        $query = $this->db->delete('company');
    }

    function get_count(){
        return $this->db->count_all("company");
    }
}

?>