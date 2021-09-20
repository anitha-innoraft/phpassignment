<!DOCTYPE html>
<html>
<head>
 <title>Add Company</title>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<?php
echo '<p align="center" style="margin-left:920px;Margin-top:30px;"><a href="'.site_url().'Company/logout">Welcome Admin, Logout</a></p>';
?>
<body>
    
 <div class="container">
 <select class="form-control" style="float:right;width:17%;" onchange="javascript:window.location.href='<?php echo site_url(); ?>LanguageSwitcher/switchLang/'+this.value;">
    <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
    <option value="french" <?php if($this->session->userdata('site_lang') == 'french') echo 'selected="selected"'; ?>>French</option>
</select>
  <br />
  <h3 align="center"><?php echo $title;?></h3>
  <br />
  <!-- <a href="<?php echo site_url(); ?>Company" class="btn btn_primary">Companies List</a> -->
  <?php if($this->session->flashdata('msg')): ?>
    <p><?php echo $this->session->flashdata('msg'); ?></p>
<?php endif; ?>
  <div class="panel panel-default">
     
   <div class="panel-heading"><?php echo $title;?></div>
  
   <div class="panel-body">
    <?php
    if(isset($companydata)){
        $action=site_url()."Company/updateCompany/".$company_id;
    }else{
        $action=site_url()."Company/addNewCompany/";
    }
    ?>
    <form method="post" action="<?php echo $action;?>" enctype='multipart/form-data'>
     <div class="form-group">
      <label>Company Name</label>
      <input type="text" name="company_name" class="form-control" value="<?php if(isset($companydata)){ echo $companydata['company_name'];}?>" />
      <span class="text-danger"><?php echo form_error('company_name'); ?></span>
     </div>
     <div class="form-group">
      <label>Company Email</label>
      <input type="text" name="company_email" class="form-control" value="<?php if(isset($companydata)){ echo $companydata['email'];}?>" />
      <span class="text-danger"><?php echo form_error('company_email'); ?></span>
     </div>
     <div class="form-group">
      <label>Company Logo</label>
      <input type="file" name="company_logo" class="form-control" value="" />
      <?php 
        if(isset($error)){?>
        <span style="color:red;"><?php echo $error['error'];?></span>;
        <?php }?>
     </div>
     <div class="form-group">
      <label>Company Website</label>
      <input type="text" name="company_website" class="form-control" value="<?php if(isset($companydata)){ echo $companydata['website'];}?>" />
      <span class="text-danger"><?php echo form_error('company_website'); ?></span>
     </div>
     <div class="form-group">
      <input type="submit" name="Create" value="<?php echo $button;?>" class="btn btn-info" />
     </div>
    </form>
   </div>
  </div>
 </div>
</body>
</html>