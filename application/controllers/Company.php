<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {
 public function __construct()
 {
  parent::__construct();
  $this->lang->load('message','english');
  $this->load->library(array('form_validation','session'));
  $this->load->model('Company_model');
  if(!$this->session->userdata('id'))
  {
   redirect('login');
  }
 }

 function index()
 {
//   echo '<br /><br /><br /><h1 align="center">Welcome User</h1>';
    $data=array();
    $data['companydata']=$this->Company_model->getCompany();
    $this->load->view('company/company',$data);
  
 }
 function addCompany()
 {
    
    $data['button'] ="Create";
    $data['title'] ="New Company";
     $this->load->view('company/add_company',$data);
 }
 function editCompany($company_id)
 {
     $data=array();
     if(isset($company_id)){
         $data['company_id']=$company_id;
        $data['companydata']=$this->Company_model->getSingleCompany($company_id);

     }
     $data['button'] ="Update";     
     $data['title'] ="Update Company";
     $this->load->view('company/add_company',$data);
 }
 function addNewCompany()
 {
    $this->form_validation->set_rules('company_name', 'Company Name', 'required');
    $this->form_validation->set_rules('company_email', 'Company Email', 'required');
    $this->form_validation->set_rules('company_website', 'Company Website', 'required');

    $this->form_validation->set_error_delimiters('<div class="error">','</div>');
    $this->form_validation->set_message('required', 'Enter %s');
    $data['button'] ="Create";     
    $data['title'] ="New Company";
    if ($this->form_validation->run() === FALSE)
    {  
        $this->load->view('company/add_company',$data);
    }
    else
    {   
            $company_name=$_POST['company_name'];
            $company_email=$_POST['company_email'];
            $company_website=$_POST['company_website'];
           
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
            $config['file_name'] = $_FILES['company_logo']['name'];
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('company_logo'))
            {
                    $error = array('error' => $this->upload->display_errors());
                    $data['error']=$error;
                    $this->load->view('company/add_company', $data);
            }
            else
            {
                    $imageDetailArray = $this->upload->data();
                    $imagepath =  $imageDetailArray['file_name'];
                    
                    $data=array(
                        'company_name' =>$company_name,
                        'email' => $company_email,
                        'logo' => $imagepath,
                        'website' => $company_website
                    );

                    $newCompany=$this->Company_model->newCompany($data);
                    $this->session->set_flashdata('msg', 'Successfully Added');
                    redirect('company');
                    }
                }
            
 }
function updateCompany($company_id){
    $company_name=$_POST['company_name'];
    $company_email=$_POST['company_email'];
    $company_website=$_POST['company_website'];
    $data['button'] ="Update";     
    $data['title'] ="Update Company";
    $config['upload_path']          = './uploads/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['max_size']             = 100;
    $config['max_width']            = 100;
    $config['max_height']           = 100;
    $config['file_name'] = $_FILES['company_logo']['name'];
    $this->load->library('upload', $config);
    if(isset($_FILES)){
            if ( ! $this->upload->do_upload('company_logo'))
            {
                    $error = array('error' => $this->upload->display_errors());
                    $data['error']=$error;
                    $this->load->view('company/add_company', $data);
            }
            else
            {
                    $imageDetailArray = $this->upload->data();
                    $imagepath =  $imageDetailArray['file_name'];
                    
                    $data=array(
                        'company_name' =>$company_name,
                        'email' => $company_email,
                        'logo' => $imagepath,
                        'website' => $company_website
                    );

                    $newCompany=$this->Company_model->updateCompany($data,$company_id);
                    $this->session->set_flashdata('msg', 'Successfully Updated');
                    redirect('company');
                    }
                }else{
                    $data=array(
                        'company_name' =>$company_name,
                        'email' => $company_email,
                        'website' => $company_website
                    );

                    $newCompany=$this->Company_model->updateCompany($data,$company_id);
                    $this->session->set_flashdata('msg', 'Successfully Updated');
                    redirect('company');
                }
            
}

function deleteCompany($company_id){
    $this->Company_model->deleteCompany($company_id);
    $this->session->set_flashdata('msg', 'Successfully Deleted');
    redirect('company');
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

