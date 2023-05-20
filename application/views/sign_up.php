<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/css/styles.css'); ?>" rel="stylesheet">
	<meta charset="utf-8">
	<title>TripWithMe</title>
	
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.0.0/backbone-min.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>

<div id="container">
	<div id="container-3">
		<img src="<?php echo base_url("assets/img/logo.jpg"); ?>" id="image"/>
		<h1 id="head-1">TripWithMe</h1>
	</div>
	<div id="body-signup">
		<h2 id="head-2">SignUp</h2>
		<form enctype="multipart/form-data" action="<?php echo base_url('User/register')?>" method="POST">
		
		<input type="file" id="text-input" name="img" accept="image/*">
		<div>
			<lable>Username<lable><br>
			<input type="text" id="text-input" name="uname">
		</div>
		
        <div>
			<lable>Email<lable><br>
			<input type="text" id="text-input" name="email">
		</div>
		<div>
			
		</div>
		<div>
			<lable>Password<lable>
			<lable id="label-signup-1">Address<lable>
			
		</div>
		<div>
			<input type="password" id="text-input" name="pw">
			<input type="text" id="text-input-2" name="address">
		</div>
        <div>
			<lable>Repeat Password<lable>	
			<lable id="label-signup-2">State/Distric<lable>

		</div>
		<div>
			<input type="password" name="repeatpw" id="text-input">            
			<input type="text" name="state" id="text-input-2">
		</div>
			<lable>Country<lable><br>
			<input type="text" name="country" id="text-input"><br><br>

			<p><b>Below detail only applicable for Business Users</b></p>

            <input type="checkbox" name="business" value="Hotel" id="text-input" class="check">
            <lable>Hotel<lable><br>
			<input type="checkbox" name="business" value="Restaurent" id="text-input" class="check">
            <lable>Restaurent<lable><br>

        <!-- <div>
            <lable>Business Type<lable>
            <select name="type" id="btype" name="btype" value="btype">
                <option value="hotel">Hotel</option>
                <option value="restaurent">Restaurent</option>
            </select>
        </div> -->
		
		<input type="submit" id="signup-btn" value="Sign up" id="signup-btn">

		</form>
		<div id="signup-btn">
			<a href="<?php echo base_url('index.php/User/index/')?>">Already have an account?</a>
		</div>

		
	</div>

	
</div>


<script type="text/javascript">
   $(document).ready(function(){

      $('.check').click(function() {
         $('.check').not(this).prop('checked', false);
      });

   });
   </script>

</body>
</html>