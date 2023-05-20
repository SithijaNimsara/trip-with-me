<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="<?php echo base_url('assets/css/styles.css'); ?>" rel="stylesheet">
	<meta charset="utf-8">
	<title>Edit Profile</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.0.0/backbone-min.js"></script>

</head>
<body>
    
    <div id="container-5">
		<div class="split edit-left">
			<div id="home">
                <h1 id="edit-head-1">Edit Profile</h1>
			</div>
		</div>
		<div class="split edit-right">
			<div id="home">
            <?php foreach ($user as $key => $userData) :?>

                <!-- <?php if ($this->session->userdata('type')=='normal'){
                        echo '<p id="postId" ><?php echo $userData->user_id?></p>';
                    }else{
                        echo '<p id="postId"><?php echo $userData->hotel_id?></p>';
                    }
                ?> -->
                <h1 id="edit-head-2"><?php echo $userData->name?></h1>
                <!-- <img src="<?php echo base_url("assets/img/logo.jpg"); ?>" id="infor-image-edit"/> -->
                <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($userData->image) . '" id="infor-image-edit"/>' ?>
                <div id="edit-user">
                    <lable>Username<lable><br>
                    <input id="edit-input-1" type="text" name="uname" class="uname" value="<?php echo $userData->name?>">
                </div>
                <div id="edit-user">
                    <lable>Email<lable>
                    <lable style="margin-left: 5.5cm;">State/Distric<lable>
                    
                </div>
                <div id="edit-user">
                    <input id="edit-input-1" type="text" name="email" class="email" value="<?php echo $userData->email?>">
                    <input type="text" id="edit-input-2" name="state" class="state" value="<?php echo $userData->state?>">
                </div>
                <div id="edit-user">
                    <lable>Password<lable>	
                    <lable style="margin-left: 4.8cm;">Repeat Password<lable>
                </div>
                <div id="edit-user">
                    <input id="edit-input-1" type="password" name="pw" class="pw" value="<?php echo $userData->password?>">            
                    <input type="password" name="repeatpw" id="edit-input-2" value="<?php echo $userData->password?>">
                    <button id="edit-button" class="edit">Update</button>
                </div>
                
                <div id="edit-user">
                    <lable>Address<lable>	
                    <lable style="margin-left: 5.1cm;">Country<lable>
                </div>
                <div id="edit-user">
                    <input type="text" name="address" class="address" value="<?php echo $userData->address?>">            
                    <input type="text" name="country" id="edit-input-2" class="country" value="<?php echo $userData->country?>">
                    <button id="edit-button">Delete Profile</button>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script>

        $(document).ready(function () {
            $('.edit').click(function (event) {
                event.preventDefault();
                doUpdate();
            });
        });
        
      

        var ItemModel = Backbone.Model.extend({
            defaults: {
                username: '',
                email: '',
                state: '',
                password: '',
                address: '',
                country: ''
            },
            initialize: function () {
                console.log('user has been intialized');
            },
            urlRoot: "<?php echo base_url(); ?>index.php/EditProfile/update"
        });


        function doUpdate() {
                //retreive by id from local cache
            
            console.log("doUpdate");

            var data = {
                username: $('input.uname').val(),
                email: $('input.email').val(),
                state: $('input.state').val(),
                password: $('input.pw').val(),
                address: $('input.address').val(),
                country: $('input.country').val()
            };
            var itemModel = new ItemModel();
            
            itemModel.save(data, {
                type: 'PUT',
                dataType: "text",
                success: function(response) {
                    console.log('success');
                    location.href="<?= base_url() ?>index.php/EditProfile/update";
                },
                error: function(response){
                    console.log('error', response);
                    
                }
            })
        }

    </script>

    
</body>
</html>