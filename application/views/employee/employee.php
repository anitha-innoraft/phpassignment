<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $this->lang->line('employees_list');?></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css" />
	</head>
	<?= '<p align="center" style="margin-left:920px;Margin-top:30px;"><a href="'.site_url().'employee/logout">Welcome Admin, Logout</a></p>';?>
	<body>
		<div class="container">
			<select class="form-control" style="float:right;width:17%;" onchange="javascript:window.location.href='<?php echo site_url(); ?>LanguageSwitcher/switchLang/'+this.value;">
				<option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
				<option value="french" <?php if($this->session->userdata('site_lang') == 'french') echo 'selected="selected"'; ?>>French</option>
			</select>
			<!-- As a link -->
			<nav class="navbar navbar-light bg-light" style="width:50%;">
				<a class="navbar-brand link_btn" href="<?php echo site_url();?>company"><?php echo $this->lang->line('menu_company');?></a>
				<a class="navbar-brand link_btn" href="<?php echo site_url();?>employee"><?php echo $this->lang->line('menu_employee');?></a>
			</nav>
			<br />
			<h3 align="center"><?php echo $this->lang->line('all_employees'); ?></h3>
			<br />
			<div class="panel panel-default">
				<div class="panel-body">
					<a href="<?php echo site_url();?>employee/addEmployee" class="btn btn-success" style="float:right;margin-bottom:10px;"><?php echo $this->lang->line('add_employee');?></a>
					<table class="table table-striped table-bordered" id="employee_table">
						<thead>
							<tr class="bg-primary text-white">
								<th>Sr#</th>
								<th><?php echo $this->lang->line('employee_name');?></th>
								<th><?php echo $this->lang->line('employee_email');?></th>
								<th><?php echo $this->lang->line('employee_phone');?></th>
								<th><?php echo $this->lang->line('employee_company');?></th>
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
									<a href="<?php echo site_url();?>employee/editEmployee/<?php echo $val['employee_id'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Edit</a> | 
									<a href="<?php echo site_url();?>employee/deleteEmployee/<?php echo $val['employee_id'];?>" class="text-danger"><i class="fa fa-fw fa-trash"></i> Delete</a>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<p style="float:right;"><?php echo $links; ?></p>
				</div>
			</div>
		</div>
	</body>
</html>