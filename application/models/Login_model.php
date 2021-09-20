<?php
class Login_model extends CI_Model
{
 function can_login($email, $password)
 {
  $this->db->where('user_email', $email);
  $query = $this->db->get('users');
  if($query->num_rows() > 0)
  {
    
   foreach($query->result() as $row)
   {
       $password = md5($password);
       $store_password = $row->user_password;
     if($password == $store_password)
     {
      $this->session->set_userdata('id', $row->user_id);
     }
     else
     {
      return 'Wrong Password';
     }   
   }
  }
  else
  {
   return 'Wrong Email Address';
  }
 }
}

?>
