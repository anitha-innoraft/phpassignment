<!DOCTYPE html>
<html>
<head>
 <title>Employees List</title>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 <link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
 <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
 <script>
 jQuery(document).ready( function () {
    $('#employee_table').DataTable();
} );
</script>
 
 <style>
     .link_btn{
        background-color: #337ab7;
        color: white;
        padding: 1em 1.5em;
        text-decoration: none;
        text-transform: uppercase;
        padding-right:10px;
        border: 1px solid #fff;
     }
</style>
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
     <!-- As a link -->
     <nav class="navbar navbar-light bg-light" style="width:50%;">
  <a class="navbar-brand link_btn" href="<?php echo site_url();?>Company">Company</a>
  <a class="navbar-brand link_btn" href="<?php echo site_url();?>Employee">Employee</a>
</nav>
  <br />
  <h3 align="center"><?php echo $this->lang->line('all_employees'); ?></h3>
  <br />
  <div class="panel panel-default">
   <!-- <div class="panel-heading">Employees List</div> -->
   <div class="panel-body">

<a href="<?php echo site_url();?>Employee/addEmployee" class="btn btn-success" style="float:right;margin-bottom:10px;">Add Employee</a>
<table class="table table-striped table-bordered" id="employee_table">
    <thead>
        <tr class="bg-primary text-white">
            <th>Sr#</th>
            <th>Employee Name</th>
            <th>Employee Email</th>
            <th>Employee Phone</th>
            <th>Employee Company</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $s  =   '';
        foreach($employeedata as $val){
            $s++;
        ?>
        <tr>
            <td><?php echo $s;?></td>
            <td><?php echo $val['first_name']." ".$val['last_name'];?></td>
            <td><?php echo $val['email'];?></td>
            <td><?php echo $val['phone'];?></td>
            <td><?php echo $val['company_name'];?></td>
            <td align="center">
                <a href="<?php echo site_url();?>Employee/editEmployee/<?php echo $val['employee_id'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Edit</a> | 
                <a href="<?php echo site_url();?>Employee/deleteEmployee/<?php echo $val['employee_id'];?>" class="text-danger"><i class="fa fa-fw fa-trash"></i> Delete</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>
  </div>
 </div>
</body>
</html>