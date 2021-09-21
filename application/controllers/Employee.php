<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Employee_model');
        $this->load->model('Company_model');
        $this->load->library(array('form_validation','session'));
        $this->load->library("pagination");

        if(!$this->session->userdata('id'))
        {
            redirect('login');
        }
    }

    function index()
    {
        $data=array();
        $config = array();
        $config["base_url"] = base_url() . "index.php/employee/index";
        $config["total_rows"] = $this->Employee_model->get_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['employeedata']=$this->Employee_model->getEmployee($config["per_page"], $page);

        $this->load->view('employee/employee',$data);
    
    }

    function addEmployee()
    {
        $data=array(); 
        $data['companydata']=$this->Company_model->getCompanydata();
        $data['button'] ="Create";
        $data['title'] ="new_employee";
        $this->load->view('employee/add_employee',$data);
    }

    function editEmployee($employee_id)
    {
        $data=array();

        if(isset($employee_id)){
            $data['employee_id']=$employee_id;
            $data['employeedata']=$this->Employee_model->getSingleEmployee($employee_id);
            $data['companydata']=$this->Company_model->getCompanydata();
        }
        $data['button'] ="Update";     
        $data['title'] ="update_employee";
        $this->load->view('employee/add_employee',$data);
    }
        
    function addNewEmployee()
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Email', 'required');
        $this->form_validation->set_rules('company', 'Company', 'required');
        $this->form_validation->set_rules('employee_email', 'Email', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');

        $this->form_validation->set_error_delimiters('<div class="error">','</div>');
        $this->form_validation->set_message('required', 'Enter %s');
        $data['button'] ="Create";     
        $data['title'] ="new_employee";

        if ($this->form_validation->run() === FALSE)
        {  
            $this->load->view('employee/add_employee',$data);
        }
        else
        {
            $first_name=$_POST['first_name'];
            $last_name=$_POST['last_name'];
            $company_id=$_POST['company'];
            $email=$_POST['employee_email'];
            $phone=$_POST['phone'];
        
            $data=array(
                'first_name' =>$first_name,
                'last_name' => $last_name,
                'company_id' => $company_id,
                'email' => $email,
                'phone' => $phone
            );

            $newEmployee=$this->Employee_model->newEmployee($data);                
            $this->session->set_flashdata('msg', 'Successfully Added');
            redirect('employee');
        }
                    
    }

    function updateEmployee($employee_id)
    {
        $first_name=$_POST['first_name'];
        $last_name=$_POST['last_name'];
        $company_id=$_POST['company'];
        $email=$_POST['employee_email'];
        $phone=$_POST['phone'];

        $data=array(
            'first_name' =>$first_name,
            'last_name' => $last_name,
            'company_id' => $company_id,
            'email' => $email,
            'phone' => $phone
        );

        $newEmployee=$this->Employee_model->updateEmployee($data,$employee_id);
        redirect('employee');          
    }

    function deleteEmployee($employee_id)
    {
        $this->Employee_model->deleteEmployee($employee_id);
        redirect('employee');
    }

    function logout()
    {
        $data = $this->session->all_userdata();
        
        foreach($data as $row => $rows_value)
        {
            $this->session->unset_userdata($row);
        }
        redirect('login');
    }
}

?>

