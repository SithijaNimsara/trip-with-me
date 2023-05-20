<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="<?php echo base_url('assets/css/styles.css'); ?>" rel="stylesheet">
	<meta charset="utf-8">
	<title>Home</title>

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.0.0/backbone-min.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	
</head>
<body>
	<div id="container-5">
		<div class="split left">
			<div id="home">
				<?php foreach ($user as $key => $userData) :?>
					<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($userData->image) . '" id="infor-image"/>' ?>
					<h1 id="head-infor"><?php echo $userData->name?></h1>
					<h3 style="margin-top: 1.2cm;"><?php echo $userData->address?></h3>
					<h3><?php echo $userData->email?></h3>
					<h3><?php echo $userData->state?></h3>
					<h3><?php echo $userData->country?></h3>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="split right">
			<div id="home">
				<?php 
				$i = 0;
				foreach ($post as $key => $postData) :?>
					<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($postData->h_image) . '" id="news-image-1"/>' ?>
					<input class="postId" hidden value='<?= $postData->post_id; ?>'>
					<h1 id="head-infor"><?php echo $postData->name?></h1>
					<h4 style="margin-top: 0.8cm;"><?php echo $postData->caption?></h4>
					<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($postData->p_image) . '" id="news-image-2"/>' ?>

					<div id="like-div">
						<span class='line one'></span>
						<?php
						$bool = false;
						foreach ($like as $key => $likeData) :?>
							<?php if ( $likeData->post_id === $postData->post_id) :?>
								<?php $bool=true; ?>
							<?php endif; ?>
						<?php endforeach; ?>
						
						<?php if ( $bool) :?>
							<?php echo '<button type="button" class="like-btn-2" id="like-btn" style="background-color: rgb(103, 208, 250);" disabled=true data-id='. $postData->post_id .' >Liked</button>' ?>
						<?php endif; ?>
						<?php if ( !$bool) :?>
							<?php echo '<button type="button" class="like-btn-2" id="like-btn"  data-id='. $postData->post_id .' >Like</button>' ?>
						<?php endif; ?>
						
						<?php
						$num = 0;
						foreach ($count as $key => $countData) :?>
							<?php if ( $countData->post_id === $postData->post_id) :?>
								<?php $num++; ?>
							<?php endif; ?>
						<?php endforeach; ?>
						
						
						<p class="like-count"><?= $num ?> Likes</p>
						<span class='line one'></span>
					</div>
					<input type="text" id="comment-text" class="comment-text-2" name="comment">
					<input type="submit" value="comment" class="comment-btn-2" data-id="<?= $postData->post_id ?>" id="<?= $i ?>">

					<div id="comment-container" class="comment-section">
						<?php foreach ($comment as $key => $commentData) :?>
							<?php if ( $postData->post_id === $commentData->post_id ) : ?>
								<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($commentData->image) . '" id="comment-image"/>' ?>
								<h4 id="commenter"><b><?php echo $commentData->name?></b></h4>
								<p id="comment"><?php echo $commentData->comment?></p>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
					
					<span class='line two'></span>
				
				<?php 
				$i++;
				endforeach; ?>
			</div>	
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
	  		$(".comment-btn-2").click(function() {
				// event.preventDefault();
				
				var index = $(this).attr('id');
				var postId = $(this).attr('data-id');
				//  var comment = $("input.comment-text-2").val(); 
				console.log(index, postId);

				
				
				var comment = $("input.comment-text-2").map(function() {		
					return $(this).val();  
				}).get();
				
				// var postId = document.getElementById("postId").innerHTML;

				var commentVal = comment[index];
				
				$.ajax({
					url: '<?= base_url() ?>index.php/Home/comment',	
					type: 'POST',
					data: {comment: commentVal, postId:postId},
					dataType: "html",
					success: function(data) {
						console.log("success");
						// $(".comment-section").load(" .comment-section > *");	  
						// $('.comment-section').load(location.href + ' .comment-section');
						location.href="<?= base_url() ?>index.php/Home/user";
					},
					error: function(res) {
						console.log("error");	
					}
				});
			})
		});

		$(document).ready(function() {
	  		$(".like-btn-2").click(function() {
				var postId = $(this).attr('data-id');
				
				console.log('like button', postId);
				$.ajax({
					url: '<?= base_url() ?>index.php/Home/like',	
					type: 'POST',
					data: {postId: postId},
					
					success: function(data) {
						console.log("success");
						location.href="<?= base_url() ?>index.php/Home/user";
					},
					error: function(res) {
						console.log("error");	
					}
				});

			})
		});


		// $(document).ready(function() {
		// 	$(".like-btn-2").each(function(){
		// 		var post_id = $(this).siblings(".postId").val(); 
        // 		var self = $(this);
		// 		$.ajax({
		// 			url: '<?= base_url() ?>index.php/Home/likeCount',	
		// 			type: 'POST',
		// 			data: "postId="+post_id,
					
		// 			success: function(data) {
		// 				console.log("success", data);
		// 				$(self).html(data);
		// 				// location.href="<?= base_url() ?>index.php/Home/user";
		// 			},
		// 			error: function(res) {
		// 				console.log("error");	
		// 			}
		// 		});
		// 	});
		// });
</script>
	
</body>
</html>

