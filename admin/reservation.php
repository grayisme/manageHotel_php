<?php
session_start();
include('db.php');
if(!isset($_SESSION["user"]))
{
 header("location:login.php");
}
?>
<?php
						$rsql ="SELECT * FROM room";
						$rre= mysqli_query($con,$rsql);
						$r =0 ;
						$sc =0;
						$gh = 0;
						$sr = 0;
						$dr = 0;
						while($rrow=mysqli_fetch_array($rre))
						{
							$r = $r + 1;
							
							$s = $rrow['type'];
							$p = $rrow['place'];
							if($s=="Phòng cao cấp" )
							{
								$sc = $sc+ 1;
							}
							
							if($s=="Phòng khách")
							{
								$gh = $gh + 1;
							}
							if($s=="Phòng đơn" )
							{
								$sr = $sr + 1;
							}
							if($s=="Phòng sang trọng" )
							{
								$dr = $dr + 1;
							}
							
						
						}	
							?>
							
						<?php
						$csql ="SELECT * FROM room WHERE place = 'NotFree' ";
						$cre= mysqli_query($con,$csql);
						$cr =0 ;
						$csc =0; 
						$cgh = 0;
						$csr = 0;
						$cdr = 0;
						while($crow=mysqli_fetch_array($cre))
						{
							$cr = $cr + 1;
							$cs = $crow['type'];
							
							if($cs=="Phòng cao cấp"  )
							{
								$csc = $csc + 1;
							}
							
							if($cs=="Phòng khách" )
							{
								$cgh += 1;
							}
							if($cs=="Phòng đơn" )
							{
								$csr = $csr + 1;
							}

							if($cs=="Phòng sang trọng" )
							{
								$cdr = $cdr + 1;
							}
							
						}
				
					?>

					
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a  href="../index.php"><i class="fa fa-home"></i> Homepage</a>
                    </li>
                    
					</ul>

            </div>

        </nav>
       
        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Đặt phòng <small></small>
                        </h1>
                    </div>
                </div> 
                 
                                 
            <div class="row">
                
                <div class="col-md-4 col-sm-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Thông tin người dùng
                        </div>
                        <div class="panel-body">
						<form name="form" method="post">
                            
						<div class="form-group">
							<label>Họ</label>
							<?php
							$fullName = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : '';
							$nameParts = explode(' ', $fullName);
							if (is_array($nameParts) && count($nameParts) > 1) {
								array_pop($nameParts); 
								$ho = implode(' ', $nameParts);
							} else {
								$ho = ''; 
							}
							?>
							<input name="lname" class="form-control" required value="<?php echo $ho; ?>">
						</div>

						<div class="form-group">
							<label>Tên</label>
							<?php
							// Assign the result of explode to a variable before passing it to end
							$explodeResult = explode(' ', $fullName);
							$ten = end($explodeResult);
							?>
							<input name="fname" class="form-control" required value="<?php echo $ten; ?>">
						</div>

						
							   <div class="form-group">
                                            <label>Email</label>
                                            <input name="email" type="email" class="form-control" required value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">
                                            
                               </div>
							   <div class="form-group">
                                            <label>Thành phố</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="nation"  value="VietNam" checked="">Viet Nam
                                            </label>
                         
                                </div>
								<?php

								$countries = array("Hà Nội", "Hải Phòng", "Thành phố Hồ Chí Minh", "Đà Nẵng", "Đà Lạt", "Nam Định", "Huế", "Việt Trì", "Thái Nguyên", "Vinh", "Mỹ Tho", "Cần Thơ", "Biên Hòa", "Nha Trang", "Vũng Tàu", "Cẩm Phả", "Uông Bí", "Móng Cái", "Quy Nhơn", "Thủ Dầu Một", "Dĩ An", "Thuận An", "Tân Uyên", "Cần Thơ", "Bắc Ninh", "Vĩnh Yên", "Phúc Yên", "Bắc Giang", "Lạng Sơn", "Quảng Ninh", "Hạ Long", "Cẩm Phả", "Uông Bí", "Móng Cái", "Đông Triều", "TP. Móng Cái", "Hải Dương", "Chi Linh", "Hải Dương", "TP. Hải Dương", "Ninh Bình", "Tam Điệp", "Ninh Bình", "TP. Ninh Bình", "Thanh Hóa", "Sầm Sơn", "Thanh Hóa", "TP. Thanh Hóa", "Quảng Bình", "Đồng Hới", "Quảng Bình", "TP. Đồng Hới", "Quảng Trị", "Đà Nẵng", "Quảng Trị", "TP. Đông Hà", "Thừa Thiên Huế", "Huế", "TP. Huế", "Quảng Nam", "Tam Kỳ", "Quảng Nam", "TP. Tam Kỳ", "Hội An", "Quảng Nam", "Hội An", "TP. Hội An", "Quảng Ngãi", "Quảng Ngãi", "TP. Quảng Ngãi", "Bình Định", "Quy Nhơn", "Bình Định", "TP. Quy Nhơn", "Phú Yên", "Tuy Hòa", "Phú Yên", "TP. Tuy Hòa", "Khánh Hòa", "Nha Trang", "Khánh Hòa", "TP. Nha Trang", "Cam Ranh", "Khánh Hòa", "Cam Ranh", "TP. Cam Ranh", "Đắk Lắk", "Buôn Ma Thuột", "Đắk Lắk", "TP. Buôn Ma Thuột", "Đắk Nông", "Gia Nghĩa", "Đắk Nông", "TP. Gia Nghĩa", "Lâm Đồng", "Đà Lạt", "Lâm Đồng", "TP. Đà Lạt", "Bình Phước", "Đồng Xoài", "Bình Phước", "TP. Đồng Xoài", "Tây Ninh", "Tây Ninh", "TP. Tây Ninh", "Bình Dương", "Thủ Dầu Một", "Bình Dương", "TP. Thủ Dầu Một", "Dĩ An", "Bình Dương", "TP. Dĩ An", "Thuận An", "Bình Dương", "TP. Thuận An", "Tân Uyên", "Bình Dương", "TP. Tân Uyên", "Long An", "Tân An", "Long An", "TP. Tân An", "Tiền Giang", "Mỹ Tho", "Tiền Giang", "TP. Mỹ Tho", "An Giang", "Long Xuyên", "An Giang", "TP. Long Xuyên", "Châu Đốc", "An Giang", "TP. Châu Đốc", "Bến Tre", "Bến Tre", "TP. Bến Tre", "Vĩnh Long", "Vĩnh Long", "TP. Vĩnh Long", "Trà Vinh", "Trà Vinh", "TP. Trà Vinh", "Hậu Giang", "Vị Thanh", "Hậu Giang", "TP. Vị Thanh", "Kiên Giang", "Rạch Giá", "Kiên Giang", "TP. Rạch Giá", "Phú Quốc", "Kiên Giang", "Phú Quốc", "TP. Phú Quốc", "Sóc Trăng", "Sóc Trăng", "TP. Sóc Trăng", "Bạc Liêu", "Bạc Liêu", "TP. Bạc Liêu", "Cà Mau", "Cà Mau", "TP. Cà Mau", "TP. Bà Rịa", "TP. Vũng Tàu");

								?>
								<div class="form-group">
                                            <label>Thành phố*</label>
                                            <select name="country" class="form-control" required>
												<option value selected ></option>
                                                <?php
												foreach($countries as $key => $value):
												echo '<option value="'.$value.'">'.$value.'</option>'; //close your tags!!
												endforeach;
												?>
                                            </select>
								</div>
								<div class="form-group">
                                            <label>Số điện thoại</label>
                                            <input name="phone" type ="text" class="form-control" required>
                                            
                               </div>
							   
                        </div>
                        
                    </div>
                </div>
                
                  
            <div class="row">
                <div class="col-md-5 col-sm-5">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Thông tin đặt phòng
                        </div>
                        <div class="panel-body">
								<div class="form-group">
                                            <label>Kiểu phòng*</label>
                                            <select name="troom"  class="form-control" required onchange="updateDeposit()">
                                                <option value="Phòng cao cấp">Phòng cao cấp</option>
                                                <option value="Phòng sang trọng">Phòng sang trọng</option>
												<option value="Phòng khách">Phòng khách</option>
												<option value="Phòng đơn">Phòng đơn</option>
                                            </select>
                              </div>
							  <div class="form-group">
                                            <label>Loại giường</label>
                                            <select name="bed" class="form-control" required>
                                                <option value="Đơn">Đơn</option>
                                                <option value="Đôi">Đôi</option>
												<option value="Ba">Ba</option>
                                                <option value="Bốn">Bốn</option>                                                
                                             
                                            </select>
                              </div>
							  <div class="form-group">
                                            <label>Số phòng*</label>
                                            <select name="nroom" class="form-control" required>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                              </div>
							 
							 
							  <div class="form-group">
                                            <label>Bữa ăn</label>
                                            <select name="meal" class="form-control"required>
                                                <option value="Cả ngày">Cả ngày</option>
                                                <option value="Bữa sáng">Bữa sáng</option>
												<option value="Nửa bữa">Nửa bữa</option>
												<option value="Bữa đầy đủ">Bữa đầy đủ</option>
												
                                                
                                             
                                            </select>
                              </div>
							  <div class="form-group">
                                            <label>Ngày vào</label>
                                            <input name="cin" type ="date" class="form-control">
                                            
                               </div>
							   <div class="form-group">
                                            <label>Ngày ra</label>
                                            <input name="cout" type ="date" class="form-control">
                                            
                               </div>
                       </div>
                        
                    </div>
                </div>
				<div class="row">
                <div class="col-md-3 col-sm-3">

                <div class="panel panel-default">
                        <div class="panel-heading">
                           Số phòng có sẵn
                        </div>
                        <div class="panel-body">
						<table width="200px">
							<tr>
								<td><b>Phòng cao cấp	 </b></td>
								<td><button type="button" class="btn btn-primary btn-circle"><?php  
									$f1 =$sc - $csc;
									if($f1 <=0 )
									{	$f1 = "NO";
										echo $f1;
									}
									else{
											echo $f1;
									}
								?> </button></td> 
							</tr>
							<tr>
								<td><b>Phòng khách</b>	 </td>
								<td><button type="button" class="btn btn-primary btn-circle"><?php 
								$f2 =  $gh -$cgh;
								if($f2 <=0 )
									{	$f2 = "NO";
										echo $f2;
									}
									else{
											echo $f2;
									}

								?> </button></td> 
							</tr>
							<tr>
								<td><b>Phòng đơn	 </b></td>
								<td><button type="button" class="btn btn-primary btn-circle"><?php
								$f3 =$sr - $csr;
								if($f3 <=0 )
									{	$f3 = "NO";
										echo $f3;
									}
									else{
											echo $f3;
									}

								?> </button></td> 
							</tr>
							<tr>
								<td><b>Phòng sang trọng</b>	 </td>
								<td><button type="button" class="btn btn-primary btn-circle"><?php 
								
								$f4 =$dr - $cdr; 
								if($f4 <=0 )
									{	$f4 = "NO";
										echo $f4;
									}
									else{
											echo $f4;
									}
								?> </button></td> 
							</tr>
							<tr>
								<td><b>Tổng số phòng </b> </td>
								<td> <button type="button" class="btn btn-danger btn-circle"><?php 
								
								$f5 =$r-$cr; 
								if($f5 <=0 )
									{	$f5 = "NO";
										echo $f5;
									}
									else{
											echo $f5;
									}
								 ?> </button></td> 
							</tr>
						</table>
						</div>
                       
                    </div>


					<div class="form-group">
						<label>Đặt cọc (30% giá phòng)</label>
						<input name="deposit" id="deposit" type="text" class="form-control" placeholder="Nhập số tiền đặt cọc">
					</div>
                    </div>
                </div>
				
                <div class="col-md-12 col-sm-12">
                    <div class="well">
                        <h4>Xác thực </h4>
                        <p>Code bên cạnh :  <?php $Random_code=rand(); echo$Random_code; ?> </p><br />
						<p>Mã ngẫu nhiên<br /></p>
							<input  type="text" name="code1" title="random code" />
							<input type="hidden" name="code" value="<?php echo $Random_code; ?>" />
						<input type="submit" name="submit" class="btn btn-primary">
						<?php
							if(isset($_POST['submit']))
							{
							$code1=$_POST['code1'];
							$code=$_POST['code']; 
							if($code1!="$code")
							{
							$msg="Invalide code"; 
							}
							else
							{
							
									$con=mysqli_connect("localhost","root","","hotel");
									$check="SELECT * FROM roombook WHERE email = '$_POST[email]'";
									$rs = mysqli_query($con,$check);
									$data = mysqli_fetch_array($rs, MYSQLI_NUM);


			// kiểm tra người dùng đã tồn tại
									// if($data[0] > 1) {
									// 	echo "<script type='text/javascript'> alert('Người dùng đã tồn tại')</script>";
									// }

									// else
									// {
										$new ="Chưa xác nhận";
										$newUser="INSERT INTO `roombook`(`Title`, `FName`, `LName`, `Email`, `Country`, `Phone`, `TRoom`, `Bed`, `NRoom`, `Meal`, `cin`, `cout`,`stat`,`nodays`) VALUES ('Đặt phòng','$_POST[fname]','$_POST[lname]','$_POST[email]','$_POST[country]','$_POST[phone]','$_POST[troom]','$_POST[bed]','$_POST[nroom]','$_POST[meal]','$_POST[cin]','$_POST[cout]','$new',datediff('$_POST[cout]','$_POST[cin]'))";
										if (mysqli_query($con,$newUser))
										{
											echo "<script type='text/javascript'> alert('Đơn đặt phòng của bạn đã được gửi')</script>";
											
										}
										else
										{
											echo "<script type='text/javascript'> alert('Lỗi khi gửi đơn')</script>";
											
										}
									}

							$msg="Code của bạn là đúng";
							}
							// }
							?>
						</form>
							
                    </div>
                </div>
                <!-- check -->

                <!-- <div class="col-md-12 col-sm-12">
    <div class="well">
        <h4>Xác thực</h4>
        <p>Code bên cạnh : <?php $Random_code = rand();
        echo $Random_code; ?> </p><br />
        <p>Mã ngẫu nhiên<br /></p>
        <form method="post" action="">
            <input type="text" name="code1" title="random code" />
            <input type="hidden" name="code" value="<?php echo $Random_code; ?>" />
            <input type="submit" name="submit" class="btn btn-primary">
        </form>


        
    </div> -->
</div>



            </div>
           
                
                </div>
                    
            
				
					</div>
			 <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    <script>
	function updateDeposit() {
        var roomType = document.getElementsByName("troom")[0].value;
        var depositInput = document.getElementById("deposit");

        // You can define the room prices based on the room type
        var roomPrices = {
            'Phòng cao cấp': 2200000,
            'Phòng sang trọng': 3200000,
            'Phòng khách': 1800000,
            'Phòng đơn': 1500000
        };

        // Calculate the deposit based on the selected room type
        var depositPercentage = 30;
        var roomPrice = roomPrices[roomType];
        var calculatedDeposit = (depositPercentage / 100) * roomPrice;

        // Set the deposit input field value
        depositInput.value = calculatedDeposit + " VNĐ";
    }
	</script>
   
</body>
</html>
