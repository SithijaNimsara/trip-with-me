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
		<div class="split left-business">
			<div id="home">
				<?php foreach ($hotel as $key => $hotelData) :?>
					<!-- <img src="<?php echo base_url("assets/img/logo.jpg"); ?>" id="infor-image"/> -->
					<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($hotelData->image) . '" id="infor-image"/>' ?>
					<h1 id="head-infor"><?php echo $hotelData->name?></h1>
					<h3 style="margin-top: 1.2cm;"><?php echo $hotelData->address?></h3>
					<h3><?php echo $hotelData->email?></h3>
					<h3><?php echo $hotelData->state?></h3>
					<h3><?php echo $hotelData->country?></h3>
					<form enctype="multipart/form-data" action="<?php echo base_url('Home/newPost')?>" method="POST">
						<input name="hotelId"  id="hotelId" hidden value="<?php echo $hotelData->hotel_id?>">
						<textarea id="text-area" name="text-area" rows="5" cols="40" placeholder="Caption here...">
						</textarea>
						<input type="file" id="text-input" name="img" accept="image/*">
						<button>Post</button>
					</form>
				<?php endforeach; ?>
				
			</div>
		</div>
		<div class="split right">
			<div id="home">
			<?php foreach ($post as $key => $postData) :?>
				<?php if ( $hotelData->hotel_id === $postData->hotel_id ) : ?>
					<!-- <img src="<?php echo base_url("assets/img/logo.jpg"); ?>" id="news-image-1"/> -->
					<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($postData->h_image) . '" id="news-image-1"/>' ?>
					<p id="postId" hidden><?php echo $postData->post_id?></p>
					<h1 id="head-infor"><?php echo $postData->name?></h1>
					<button type="button" id="close" class="close" aria-label="Close">
						<span aria-hidden="true">&#128473</span>
					</button>
					<h4 style="margin-top: 0.8cm;"><?php echo $postData->caption?></h4>
					<!-- <img src="<?php echo base_url("assets/img/logo.jpg"); ?>" id="news-image-2"/> -->
					<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($postData->p_image) . '" id="news-image-2"/>' ?>

					<span class='line one'></span>

					<!-- <input type="text" id="comment-text" name="comment">
					<button type="button" class="primary">comment</button> -->
					<div id="comment-container">
					<?php foreach ($comment as $key => $commentData) :?>
						<?php if ( $postData->post_id === $commentData->post_id ) : ?>
							<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($commentData->image) . '" id="comment-image"/>' ?>
							<!-- <img src="<?php echo base_url("assets/img/logo.jpg"); ?>" id="comment-image"/> -->
							<h4 id="commenter"><b><?php echo $commentData->name?></b></h4>
							<p id="comment"><?php echo $commentData->comment?></p>
						<?php endif; ?>
					<?php endforeach; ?>
					</div>
					
					<span class='line two'></span>
				<?php endif; ?>
			<?php endforeach; ?>
			</div>
			
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".close").click(function() {
				$postId = document.getElementById("postId").innerHTML;
				$url = '<?= base_url() ?>index.php/Home/deletePost/' +$postId;
				$.ajax({
					url: $url,	
					type: 'DELETE',
					success: function() {
						console.log('success');
						location.href="<?= base_url() ?>index.php/Home/user";
					}
				});
			});
		});


		// $(document).ready(function() {
		// 	$("#close").click(function() {
		// 		$.ajax({
		// 			url: $url,	
		// 			type: 'POST',
		// 		});
		// 	});
		// });
	</script>
</body>
</html>