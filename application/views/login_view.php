<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/css/styles.css'); ?>" rel="stylesheet">
	<meta charset="utf-8">
	<title>TripWithMe</title>

</head>
<body>

<div id="container">
	<div id="container-2">
		<img src="<?php echo base_url("assets/img/logo.jpg"); ?>" id="image"/>
		<h1 id="head-1">TripWithMe</h1>
	</div>
	<div id="body">
		<h2 id="head-2">Login</h2>
		<?php echo form_open('Home/user'); ?>
			<div id="element">
				<lable >Email:<lable><br>
				<input type="text" name="email">
			</div>
			<div id="element">
				<lable>Password:<lable><br>
				<input type="password" name="password">
			</div>
			<div id="element">
				<button href="<?php echo base_url('index.php/Home/user/')?>">Login</button><br><br>
				
				<a href="<?php echo base_url('index.php/User/signUp/')?>">Sign up for TripWithMe.</a>
			</div>
		<?php echo form_close(); ?>
	</div>

	
</div>

</body>
</html>
