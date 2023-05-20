<html>

<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"/>
	<link href="<?php echo base_url('assets/css/styles.css'); ?>" rel="stylesheet">
	<meta charset="utf-8">
	<title>TripWithMe</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div id="container-4">
        <div>
			
            <img src="<?php echo base_url("assets/img/logo.jpg"); ?>"  id="image" style="width: 2cm;"/>
            <h1 id="head-1"><a href="<?php echo base_url('index.php/Home/user/')?>">TripWithMe</a></h1>
			<?php if ($this->session->userdata('type')=='normal'){
				echo '<input type="text" id="search-text" class="search" name="search">';
			
				echo '<button type="button" id="search-btn" class="btn btn-default">
					<span class="bi bi-search"></span>
				</button>';
			}?>
			
			<span style="font-size: 50px; -webkit-text-stroke-width: 0px; opacity: 1;" id="power-icon" class="bi bi-power"></span>
			<span style="font-size: 45px; -webkit-text-stroke-width: 0px; opacity: 1;" id="person-icon" class="bi bi-person-circle" ></span>
			<?php if ($this->session->userdata('type')=='normal'){
				echo '<button type="button" id="hotel-key" class="btn btn-secondary">Hotel</button>';
				echo '<button type="button" id="restau-key" class="btn btn-secondary">restaurent</button>';
			}?>

            <!-- disabled="<?php $this->session->userdata('type')=='business'?>"  -->
        </h1>
        </div>
    </div>
</body>
<script type="text/javascript">
		$(document).ready(function() {
	  		$("#power-icon").click(function() {
				var comment = $("input#search-text").val(); 
				$.ajax({
					url: '<?= base_url() ?>index.php/Home/logOut',	
					type: 'GET',
					success: function(data) {
						console.log("success");
						location.href="<?= base_url() ?>";
					},
					error: function(res) {
						console.log("error");	
					}
				});
			})
		
		});

        $(document).ready(function() {
	  		$("#person-icon").click(function() {
				$.ajax({
					url: '<?= base_url() ?>index.php/EditProfile/editUser',	
					type: 'GET',
					success: function(data) {
						console.log("success");
						location.href="<?= base_url() ?>index.php/EditProfile/editUser";
					},
					error: function(res) {
						console.log("error");	
					}
				});
			})
		
		});


		$(document).ready(function() {
	  		$("#search-btn").click(function() {
				$search = $("input#search-text").val(); 
				$url = '<?= base_url() ?>index.php/Home/search/' +$search;
				$.ajax({
					url: $url,	
					type: 'GET',
					success: function(data) {
						console.log("success");
						location.href=$url;
					},
					error: function(res) {
						console.log("error");	
					}
				});
			})
		
		});

		$(document).ready(function() {
			$("#hotel-key").click(function() {
				$search = $("input#search-text").val(); 
				$url = '<?= base_url() ?>index.php/Home/search/hotel/' +$search;
				$.ajax({
					url: $url,	
					type: 'GET',
					success: function(data) {
						console.log("success");
						location.href=$url;
					},
					error: function(res) {
						console.log("error");	
					}
				});
			});
		});

		$(document).ready(function() {
			$("#restau-key").click(function() {
				$search = $("input#search-text").val(); 
				$url = '<?= base_url() ?>index.php/Home/search/restaurent/' +$search;
				$.ajax({
					url: $url,	
					type: 'GET',
					success: function(data) {
						console.log("success");
						location.href=$url;
					},
					error: function(res) {
						console.log("error");	
					}
				});
			});
		});

</script>
</html>