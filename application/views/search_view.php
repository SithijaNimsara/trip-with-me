<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="<?php echo base_url('assets/css/styles.css'); ?>" rel="stylesheet">
	<meta charset="utf-8">
	<title>Home</title>
	
</head>
<body>
    <div id="container-5">
		<div class="split left">
		<?php foreach ($user as $key => $userData) :?>
			<div id="home">
			<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($userData->image) . '" id="infor-image"/>' ?>
				<h1 id="head-infor"><?php echo $userData->name?></h1>
				<h3 style="margin-top: 1.2cm;"><?php echo $userData->address?></h3>
				<h3><?php echo $userData->email?></h3>
				<h3><?php echo $userData->state?></h3>
				<h3><?php echo $userData->country?></h3>
			</div>
		<?php endforeach; ?>

        <div class="split right">
		<?php foreach ($hotel as $key => $hotelData) :?>
			<div id="home">
				<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($hotelData->image) . '" id="infor-image"/>' ?>
				<h1 id="head-infor"><?php echo $hotelData->name?></h1>
				<h4 id="search-infor"><?php echo $hotelData->address?></h4>
				<h4 id="search-infor"><?php echo $hotelData->email?></h4>
                
				<span class='line one'></span>
			</div>
		<?php endforeach; ?>


            <!-- <div id="home">
				<img src="<?php echo base_url("assets/img/logo.jpg"); ?>" id="news-image-1"/>
				<h1 id="head-infor">weweeeADC Restaurant</h1>
				<h4 id="search-infor">88/c, annipti road,214/c, </h4>
                <h4 id="search-infor">698 ratings </h4>
				<span class='line one'></span>
			</div> -->
		</div>
    </div>
</body>
</html>