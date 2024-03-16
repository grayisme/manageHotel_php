<?php
session_start();

include('db.php');
function getUserData($username) {
    global $con;

    $sql = "SELECT user FROM login WHERE usname = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $userData = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    return $userData;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn Đặt Phòng</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Resort Inn Responsive , Smartphone Compatible web template , Samsung, LG, Sony Ericsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen">
<link href="css/easy-responsive-tabs.css" rel='stylesheet' type='text/css'/>
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
<link rel="stylesheet" href="css/jquery-ui.css" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/modernizr-2.6.2.min.js"></script>
<!--fonts-->
<link href="//fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Federo" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<!--//fonts-->
</head>
<body>


<!-- header -->
<div class="banner-top">
			<div class="social-bnr-agileits">
				<ul class="social-icons3">
								<li><a href="https://www.facebook.com/" class="fa fa-facebook icon-border facebook"> </a></li>
								<li><a href="https://twitter.com/" class="fa fa-twitter icon-border twitter"> </a></li>
								<li><a href="https://plus.google.com/u/0/" class="fa fa-google-plus icon-border googleplus"> </a></li> 
							</ul>
			</div>
			<div class="contact-bnr-w3-agile">
				<ul>
					<li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:info@example.com">INFO@Sunrisehotel.COM</a></li>
					<li><i class="fa fa-phone" aria-hidden="true"></i>(+84) 982428142</li>	
					<li class="s-bar">
						<div class="search">
							<input class="search_box" type="checkbox" id="search_box">
							<label class="icon-search" for="search_box"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></label>
							<div class="search_form">
								<form action="#" method="post">
									<input type="search" name="Search" placeholder=" " required=" " />
									<input type="submit" value="Search">
								</form>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="clearfix"></div>
		</div>
	<div class="w3_navigation">
		<div class="container" style="width : 100%;">
			<nav class="navbar navbar-default" style="display: flex;width : 100%; justify-content: space-around; margin-top:10px ">

				<div class="navbar-header navbar-left">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<h1><a class="navbar-brand" href="index.php">Sun<span>Rise</span><p class="logo_w3l_agile_caption">Your Dreamy Resort</p></a></h1>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
					<nav class="menu menu--iris">
						<ul class="nav navbar-nav menu__list">
							<li class="menu__item menu__item--current"><a href="" class="menu__link">Trang chủ</a></li>
							<!-- <li class="menu__item"><a href="#about" class="menu__link scroll">About</a></li> -->
							<!-- <li class="menu__item"><a href="#gallery" class="menu__link scroll">Gallery</a></li> -->
							<li class="menu__item"><a href="#rooms" class="menu__link scroll">Đặt phòng</a></li>
							<li class="menu__item"><a href="#contact" class="menu__link scroll">Liên hệ</a></li>
							<li class="menu__item w-100 text-right"><a href="#">
							<?php
    if (!isset($_SESSION['fullname'])) {
        printf('<li><a href="./admin/logout.php"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a></li>');
    } else {
		// Thêm liên kết đến trang đơn đặt phòng của người dùng
        
        $fullname = $_SESSION['fullname'];
		$email = $_SESSION['email'];
		$userBookingPageLink = './user_booking_page.php?email=' . urlencode($email);
        echo '<li><a class="menu__link" href="' . $userBookingPageLink . '"> Xem đơn đặt phòng</a></li>';
        echo '<li><a class="menu__link scroll"> <b>' . $fullname . '</b> </a></span></li>';
        echo '<li><span></span><a class="menu__link" href="./admin/logout.php">Đăng xuất</a></li>';
        
    }
    ?>
							</a></li>
						</ul>
					</nav>
				</div>
			</nav>

		</div>
	</div>
<!-- //header -->


    <br>
    <div class="container mt-5">
    <h2>Đơn đặt phòng của bạn</h2>

    <?php
    // Lấy thông tin đơn đặt phòng dựa trên email
    $email = mysqli_real_escape_string($con, $_GET['email']);
    $sql = "SELECT * FROM roombook WHERE Email = '$email'";

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Hiển thị thông tin đơn đặt phòng
        echo '<table class="table">
                <thead>
                    <tr>
                        <th scope="col">Số Phòng</th>
                        <th scope="col">Loại Phòng</th>
                        <th scope="col">Loại Giường</th>
                        <th scope="col">Bữa ăn</th>
                        <th scope="col">Ngày Đặt</th>
                        <th scope="col">Ngày Trả</th>
                        <th scope="col">Trạng thái đơn</th>
                        <th scope="col">Thông tin</th>
                    </tr>
                </thead>
                <tbody>';

        // Lấy dữ liệu từ cơ sở dữ liệu và hiển thị
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                    <td>' . $row['NRoom'] . '</td>
                    <td>' . $row['TRoom'] . '</td>
                    <td>' . $row['Bed'] . '</td>
                    <td>' . $row['Meal'] . '</td>
                    <td>' . $row['cin'] . '</td>
                    <td>' . $row['cout'] . '</td>
                    <td>' . $row['stat'] . '</td>';
					//echo
            // Hiển thị cột "Lý do hủy" nếu trạng thái là "Đã bị hủy"
            if ($row['stat'] === 'Đã bị hủy') {
                echo '<td>' . $row['description'] . '</td>';
            } else {
                echo '<td></td>'; // Nếu không phải "Đã bị hủy", hiển thị ô trống
            }

            echo '</tr>';
        }

        echo '</tbody></table>';

        echo '<a href="index.php" class="btn btn-primary">Quay về trang chủ</a>';
    } else {
        echo '<p>Không có đơn đặt phòng nào.</p>';
		echo '<a href="index.php" class="btn btn-primary">Quay về trang chủ</a>';
    }

    // Đóng kết nối
    mysqli_close($con);
    ?>
</div>




<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<!-- contact form -->
<script src="js/jqBootstrapValidation.js"></script>

<!-- /contact form -->	
<!-- Calendar -->
		<script src="js/jquery-ui.js"></script>
		<script>
				$(function() {
				$( "#datepicker,#datepicker1,#datepicker2,#datepicker3" ).datepicker();
				});
		</script>
<!-- //Calendar -->
<!-- gallery popup -->
<link rel="stylesheet" href="css/swipebox.css">
				<script src="js/jquery.swipebox.min.js"></script> 
					<script type="text/javascript">
						jQuery(function($) {
							$(".swipebox").swipebox();
						});
					</script>
<!-- //gallery popup -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
<!-- flexSlider -->
				<script defer src="js/jquery.flexslider.js"></script>
				<script type="text/javascript">
				$(window).load(function(){
				  $('.flexslider').flexslider({
					animation: "slide",
					start: function(slider){
					  $('body').removeClass('loading');
					}
				  });
				});
			  </script>
			<!-- //flexSlider -->
<script src="js/responsiveslides.min.js"></script>
			<script>
						// You can also use "$(window).load(function() {"
						$(function () {
						  // Slideshow 4
						  $("#slider4").responsiveSlides({
							auto: true,
							pager:true,
							nav:false,
							speed: 500,
							namespace: "callbacks",
							before: function () {
							  $('.events').append("<li>before event fired.</li>");
							},
							after: function () {
							  $('.events').append("<li>after event fired.</li>");
							}
						  });
					
						});
			</script>
		<!--search-bar-->
		<script src="js/main.js"></script>	
<!--//search-bar-->
<!--tabs-->
<script src="js/easy-responsive-tabs.js"></script>
<script>
$(document).ready(function () {
$('#horizontalTab').easyResponsiveTabs({
type: 'default', //Types: default, vertical, accordion           
width: 'auto', //auto or any width like 600px
fit: true,   // 100% fit in a container
closed: 'accordion', // Start closed if in accordion view
activate: function(event) { // Callback function if tab is switched
var $tab = $(this);
var $info = $('#tabInfo');
var $name = $('span', $info);
$name.text($tab.text());
$info.show();
}
});
$('#verticalTab').easyResponsiveTabs({
type: 'vertical',
width: 'auto',
fit: true
});
});
</script>
<!--//tabs-->
<!-- smooth scrolling -->
	<script type="text/javascript">
		$(document).ready(function() {
		/*
			var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear' 
			};
		*/								
		$().UItoTop({ easingType: 'easeOutQuart' });
		});
	</script>
	
	<div class="arr-w3ls">
	<a href="#home" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	</div>
	
<!-- //smooth scrolling -->
<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
<script>
	

</script>
</body>
</html>
