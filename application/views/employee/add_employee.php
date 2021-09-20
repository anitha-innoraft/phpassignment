<!DOCTYPE html>
<html>
<head>
 <title>Add Employee</title>
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
  <!-- <a href="<?php echo site_url(); ?>Employee" class="btn btn_primary">Employees List</a> -->
  <?php if($this->session->flashdata('msg')): ?>
    <p><?php echo $this->session->flashdata('msg'); ?></p>
<?php endif; ?>
  <div class="panel panel-default">
     
   <div class="panel-heading"><?php echo $title;?></div>
  
   <div class="panel-body">
    <?php
    if(isset($employeedata)){
        $action=site_url()."Employee/updateEmployee/".$employee_id;
    }else{
        $action=site_url()."Employee/addNewEmployee/";
    }
    ?>
    <form method="post" action="<?php echo $action;?>" enctype='multipart/form-data'>
     <div class="form-group">
      <label>First Name</label>
      <input type="text" name="first_name" class="form-control" value="<?php if(isset($employeedata)){ echo $employeedata['first_name'];}?>" />
      <span class="text-danger"><?php echo form_error('first_name'); ?></span>
     </div>
     <div class="form-group">
      <label>Last Name</label>
      <input type="text" name="last_name" class="form-control" value="<?php if(isset($employeedata)){ echo $employeedata['last_name'];}?>" />
      <span class="text-danger"><?php echo form_error('last_name'); ?></span>
     </div>
     <div class="form-group">
      <label>Email</label>
      <input type="text" name="employee_email" class="form-control" value="<?php if(isset($employeedata)){ echo $employeedata['email'];}?>" />
      <span class="text-danger"><?php echo form_error('employee_email'); ?></span>
     </div>
     <div class="form-group">
      <label>Phone</label>
      <input type="text" name="phone" class="form-control" value="<?php if(isset($employeedata)){ echo $employeedata['phone'];}?>" />
      <span class="text-danger"><?php echo form_error('phone'); ?></span>
     </div>
     <div class="form-group">
      <label>Company</label>
        <select name="company" class="form-control" id="company" >
        <option value="">Select company</option>
        <?php
        foreach($companydata as $dataval){
            if($dataval['company_id'] == $employeedata['company_id']){ $selected="selected";}else{ $selected=""; }
            echo "<option value='".$dataval['company_id']."' ".$selected.">".$dataval['company_name']."</option>";
        }

        ?>

        </select>
        
      <span class="text-danger"><?php echo form_error('company'); ?></span>
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