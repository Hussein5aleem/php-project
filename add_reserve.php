<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hotel Online Reservation</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="st3.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: rgb(13, 8, 61); /* لون الخلفية الأسود */
            color: #ffffff; /* لون النص الأبيض */
        }
    </style>
</head>

<body class="holl">
<nav style = "background-color:rgba(0, 0, 0, 0.1);" class = "navbar navbar-default">
		<div
		class = "container-fluid">
			<div class = "navbar-header">
				<a class = "navbar-brand" >Hotel Online Reservation</a>
			</div>
		</div>
	</nav>	
	<ul id = "menu">
		<li><a href = "index.php">Home</a></li> 		
	</ul>
	<div style = "margin-left:0;" class = "container-re">
		<div class = "panel panel-default-re">
			<div class = "panel-body-re">
				<strong><h3>MAKE A RESERVATION</h3></strong>
				<br />
				<?php 
					require_once 'admin/connect.php';
					$query = $conn->query("SELECT * FROM `room` WHERE `room_id` = '$_REQUEST[room_id]'") or die(mysql_error());
					$fetch = $query->fetch_array();
				?>
				<div style = "height:300px; width:800px;">
					<div style = "float:left;">
						<img src = "photo/<?php echo $fetch['photo']?>" height = "300px" width = "400px">
					</div>
					<div style = "float:left; margin-left:10px;">
						<h4><?php echo $fetch['Hotel_name']?></h4>
						<h4 style = "color:#00ff00;"><?php echo "$ ".$fetch['price']."";?></h4>
					</div>
				</div>
				<br style = "clear:both;" />
				<div panel-body-re >
				<form method="POST" enctype="multipart/form-data">
    <div class="form-row">
        <div class="form-group col-md-4">
            <label class="white-text">Firstname</label>
            <input type="text" class="form-control" name="firstname" required="required" style="width: 200px;"/>
        </div>
        <div class="form-group col-md-4">
            <label class="white-text">Middlename</label>
            <input type="text" class="form-control" name="middlename" required="required"style="width: 200px;" />
        </div>
        <div class="form-group col-md-4">
            <label class="white-text">Lastname</label>
            <input type="text" class="form-control" name="lastname" required="required"style="width: 200px;"  />
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="white-text">Address</label>
            <input type="text" class="form-control" name="address" required="required" />
        </div>
        <div class="form-group col-md-6">
            <label class="white-text">Contact No</label>
            <input type="text" class="form-control" name="contactno" required="required" style="width: 385px;" />
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="white-text">Check in</label>
            <input type="date" class="form-control" name="date" required="required" />
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="white-text">Days</label>
            <input type="number" class="form-control" name="days" required="required" style="width: 385px;" />
        </div>
        <div class="form-group col-md-6">
            <label class="white-text">Extra Beds</label>
            <input type="number" class="form-control" name="extra_beds" required="required" style="width: 385px;" />
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <button class="btn btn-info form-control" name="add_guest"><i class="glyphicon glyphicon-save"></i> Submit</button>
        </div>
    </div>
</form>

				</div>
				<div class = "col-md-4"></div>
				<?php require_once 'add_query_reserve.php'?>
			</div>
		</div>
	</div>
	<br />
	<br />
	<div style = "text-align:right; margin-right:10px;" class = "navbar navbar-default navbar-fixed-bottom">
	
	</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script>
    $(document).ready(function() {
        // Add smooth scrolling to all links
        $("#menu a").on('click', function(event) {
            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {
                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function() {
                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            } // End if
        });
    });
</script>
<script>
    
    function getRandomNumber(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    
    function createStar() {
        const star = document.createElement('div');
        star.className = 'star';
        star.style.left = getRandomNumber(0, 100) + '%';
        star.style.top = getRandomNumber(0, 100) + '%';
        return star;
    }

    
    function setNightMode() {
        const starCount = 15; 
        const container = document.body;

        for (let i = 0; i < starCount; i++) {
            const star = createStar();
            container.appendChild(star);
        }
    }

    
    setNightMode();
    function addStars() {
        const starCount = 15;
        const container = document.body; 

        for (let i = 0; i < starCount; i++) {
            const star = createStar();
            container.appendChild(star);
        }
    }
    setInterval(addStars, 2000);
    
</script>
</html>