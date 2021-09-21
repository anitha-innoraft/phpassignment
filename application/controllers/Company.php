<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation','session'));
        $this->load->library("pagination");
        $this->load->model('Company_model');
        
        if(!$this->session->userdata('id'))
        {
            redirect('login');
        }
    }

    function index()
    {
        $data=array();
        $config = array();
        $config["base_url"] = base_url() . "index.php/company/index";
        $config["total_rows"] = $this->Company_model->get_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);
		
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		
        $data["links"] = $this->pagination->create_links();
        $data['companydata']=$this->Company_model->getCompany($config["per_page"], $page);

        $this->load->view('company/company',$data);
    
    }

    function addCompany()
    {    
        $data['button'] ="Create";
        $data['title'] ="new_company";
        $this->load->view('company/add_company',$data);
    }

    function editCompany($company_id)
    {
        $data=array();

        if(isset($company_id)){
            $data['company_id']=$company_id;
            $singleComp=$this->Company_model->getSingleCompany($company_id);

            if($singleComp !=0){
                $data['companydata']=$singleComp;
            }
        }

        $data['button'] ="Update";     
        $data['title'] ="update_company";
        $this->load->view('company/add_company',$data);
    }

    function addNewCompany()
    {
        $this->form_validation->set_rules('company_name', 'Company Name', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">','</div>');
        $this->form_validation->set_message('required', 'Enter %s');

        $data['button'] ="Create";     
        $data['title'] ="new_company";

        if ($this->form_validation->run() === FALSE)
        {  
            $this->load->view('company/add_company',$data);
        }
        else
        {   
            $company_name=$_POST['company_name'];
            $company_email=$_POST['company_email'];
            $company_website=$_POST['company_website'];
        
            if(isset($_FILES['name'])){

                $uploaddata=$this->uploadFile($_FILES);

                if (isset($uploaddata['error']))
                {
                    
                    $data['error']=$uploaddata;
                    $this->load->view('company/add_company', $data);
                }
                else
                {
                    $imagepath =  $uploaddata['filename'];
                    
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

            }else{

                $data=array(
                    'company_name' =>$company_name,
                    'email' => $company_email,
                    'website' => $company_website
                );

                $newCompany=$this->Company_model->newCompany($data);
                $this->session->set_flashdata('msg', 'Successfully Added');
                redirect('company');

            }
        }
                
    }

    function updateCompany($company_id)
    {
        $company_name=$_POST['company_name'];
        $company_email=$_POST['company_email'];
        $company_website=$_POST['company_website'];

        $data['button'] ="Update";     
        $data['title'] ="update_company";

        if(isset($_FILES['name'])){

            $uploaddata=$this->uploadFile($_FILES);

            if(isset($uploaddata['error']))
            {
                $data['error']=$uploaddata;
                $this->load->view('company/add_company', $data);
            }
            else
            {                    
                $imagepath =  $uploaddata['filename'];

                $singleComp=$this->Company_model->getSingleCompany($company_id);

                if($singleComp !=0){
                    $oldFilename=$singleComp['logo'];
                    unlink("uploads/".$oldFilename);
                }

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

    function logout(){
        $data = $this->session->all_userdata();

        foreach($data as $row => $rows_value)
        {
            $this->session->unset_userdata($row);
        }
        redirect('login');
        
    }

    function uploadFile($file)
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 400;
        $config['max_height']           = 500;
        $config['file_name'] = $file['company_logo']['name'];

        $this->load->library('upload', $config);

        if(isset($file))
        {
            if ( ! $this->upload->do_upload('company_logo'))
            {
                $error = array('error' => $this->upload->display_errors());
                return $error;
            }
            else
            {
                $imageDetailArray = $this->upload->data();
                $imagepath['filename'] =  $imageDetailArray['file_name'];
                return $imagepath;
            }
        }
    }

}

?>

