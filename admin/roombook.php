<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:login.php");
}
?> 

<?php
		if(!isset($_GET["rid"]))
		{
				
			 header("location:login.php");
		}
		else {
				$curdate=date("Y/m/d");
				include ('db.php');
				$id = $_GET['rid'];
				// echo "<script type='text/javascript'> alert($id)</script>";


				$sql ="Select * from roombook where id = '$id'";
				$re = mysqli_query($con,$sql);
				while($row=mysqli_fetch_array($re))
				{
					$title = $row['Title'];
					$fname = $row['FName'];
					$lname = $row['LName'];
					$email = $row['Email'];
					$country = $row['Country'];
					$Phone = $row['Phone'];
					$troom = $row['TRoom'];
					$nroom = $row['NRoom'];
					$bed = $row['Bed'];
					$non = $row['NRoom'];
					$meal = $row['Meal'];
					$cin = $row['cin'];
					$cout = $row['cout'];
					$sta = $row['stat'];
					$days = $row['nodays'];
					
				
				
				}
		}
		
		
		
			?> 

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrator	</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php"> <?php echo $_SESSION["user"]; ?> </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Đăng xuất</a>
                        </li>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a  href="home.php"><i class="fa fa-dashboard"></i> Trạng thái</a>
                    </li>
                    <li>
                        <a href="messages.php"><i class="fa fa-desktop"></i> Thư tin tức</a>
                    </li>
					<li>
                        <a style="background-color: #225081" class="active-menu" href="roombook.php"><i class="fa fa-bar-chart-o"></i>Phòng đang book</a>
                    </li>
                    <li>
                        <a href="payment.php"><i class="fa fa-qrcode"></i> Thanh toán</a>
                    </li>
					<li>
                        <a  href="profit.php"><i class="fa fa-qrcode"></i> Lợi nhuận</a>
                    </li>
                    
                    <li><a href="home.php"><i class="fa fa-sign-out fa-fw"></i>Home</a></li>
                    


                    
					</ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
		
		
		

        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Đặt phòng<small>	<?php echo  $curdate; ?> </small>
                        </h1>
                    </div>
					
					
					<div class="col-md-8 col-sm-8">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                           Xác nhận đặt phòng
                        </div>
                        <div class="panel-body">
							
							<div class="table-responsive">
                                <table class="table">
                                    <tr>
                                            <th>Mô tả</th>
                                            <th>Thông tin</th>
                                            
                                        </tr>
                                        <tr>
                                            <th>Tên</th>
                                            <th><?php echo $lname. " ".$fname; ?> </th>
                                            
                                        </tr>
										<tr>
                                            <th>Email</th>
                                            <th><?php echo $email; ?> </th>
                                            
                                        </tr>
										
										<tr>
                                            <th>Thành phố</th>
                                            <th><?php echo $country;  ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Số điện thoại </th>
                                            <th><?php echo $Phone; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Loại phòng </th>
                                            <th><?php echo $troom; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Số phòng</th>
                                            <th><?php echo $nroom; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Kế hoạch bữa ăn </th>
                                            <th><?php echo $meal; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Giường </th>
                                            <th><?php echo $bed; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Ngày nhận phòng </th>
                                            <th><?php echo $cin; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Ngày trả phòng</th>
                                            <th><?php echo $cout; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Số ngày</th>
                                            <th><?php echo $days; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Level trạng thái</th>
                                            <th><?php echo $sta; ?></th>
                                            
                                        </tr>
                                   
                                  
                                        
                                        
                                    
                                </table>
                            </div>
                        
					
							
                        </div>
                        <div class="panel-footer">
						<form method="post" id="confirmationForm">
							<input type="submit" name="co" value="Xác nhận" class="btn btn-success">
							<button type="button" class="btn btn-danger" id="rejectButton" data-toggle="modal" data-target="#confirmModal">Hủy</button>
						</form>
                        </div>
                    </div>
					</div>

					<?php
					if (isset($_POST['delete'])) {
						// Hủy đơn đặt phòng từ cơ sở dữ liệu
						$deleteReason = $_POST['deleteReason'];

						$updateSql  = "UPDATE `roombook` SET stat = 'Đã bị hủy', description = '$deleteReason' WHERE id = '$id'";


						if (mysqli_query($con, $updateSql )) {
							echo "<script type='text/javascript'> alert('Đơn đặt phòng đã bị từ chối ')</script>";
							echo "<script type='text/javascript'> window.location='roombook.php'</script>";
						} else {
							echo "<script type='text/javascript'> alert('Đã xảy ra lỗi khi từ chối đơn đặt phòng')</script>";
						}
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
					<!-- check -->



					<div class="col-md-4 col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Chi tiết phòng có sẵn
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
                        <div class="panel-footer">
                            
                        </div>
                    </div>
					</div>
                </div>
                <!-- /. ROW  -->
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
	<!-- jQuery Js -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>


	<!-- Add this modal at the end of your HTML body -->
	<form method="post" action="">
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="confirmModalLabel">Xác nhận</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắc muốn hủy đơn đặt này?
                    <!-- Thêm ô nhập lý do xóa -->
                    <div class="form-group">
                        <label for="deleteReason">Lý do hủy:</label>
                        <input type="text" class="form-control" id="deleteReason" name="deleteReason">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <form method="post" action="">
                        <input type="submit" name="delete" value="Hủy đơn" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>
</form>

</body>
</html>

<?php
$isConfirm = true;
						if(isset($_POST['co']))
						{	
							$st = $_POST['co'];
							
							 
							
							if($st=="Xác nhận")
							{
									$urb = "UPDATE `roombook` SET `stat`='$st' WHERE id = '$id'";
									
								if($f1=="NO" && $troom =="Phòng cao cấp" )
								{
									echo "<script type='text/javascript'> alert('Xin lỗi, không còn phòng cao cấp ')</script>";
									$isConfirm = false;
								}


								if($f2 =="NO" && $troom =="Phòng khách")
									{
										echo "<script type='text/javascript'> alert('Xin lỗi, không còn phòng khách')</script>";
										$isConfirm = false;
									}

							    if ($f3 == "NO"  && $troom =="Phòng đơn")
									{
										echo "<script type='text/javascript'> alert('Xin lỗi, không còn phòng đơn')</script>";
										$isConfirm = false;
									}

								 if($f4=="NO"  && $troom =="Phòng sang trọng")
										{
										echo "<script type='text/javascript'> alert('Xin lỗi, không còn phòng sang trọng')</script>";
										$isConfirm = false;
										}
								
								
								if( mysqli_query($con,$urb) && $isConfirm == true)
											{	
												 $type_of_room = 0;       
														if($troom=="Phòng cao cấp")
														{
															$type_of_room = 3200000;
														
														}
														else if($troom=="Phòng sang trọng")
														{
															$type_of_room = 2200000;
														}
														else if($troom=="Phòng khách")
														{
															$type_of_room = 1800000;
														}
														else if($troom=="Phòng đơn")
														{
															$type_of_room = 1500000;
														}
														
														
														
														
														if($bed=="Đơn")
														{
															$type_of_bed = $type_of_room * 1/100;
														}
														else if($bed=="Đôi")
														{
															$type_of_bed = $type_of_room * 2/100;
														}
														else if($bed=="Ba")
														{
															$type_of_bed = $type_of_room * 3/100;
														}
														else if($bed=="Bốn")
														{
															$type_of_bed = $type_of_room * 4/100;
														}
														else if($bed=="Không")
														{
															$type_of_bed = $type_of_room * 0/100;
														}
														
														
														if($meal=="Cả ngày")
														{
															$type_of_meal=30;
														}
														else if($meal=="Bữa sáng")
														{
															$type_of_meal= 20;
														}else if($meal=="Nửa bữa")
														{
															$type_of_meal=5;
														}else if($meal=="Bữa đầy đủ")
														{
															$type_of_meal= 10;
														}
														
														$ttot = $type_of_room * $days * $nroom;
														$mepr = $type_of_meal * $days;
														$btot = $type_of_bed *$days;
														
														$fintot = $ttot + $mepr + $btot ;
															
															//echo "<script type='text/javascript'> alert('$count_date')</script>";
														$psql = "INSERT INTO `payment`(`id`, `title`, `fname`, `lname`, `troom`, `tbed`, `nroom`, `cin`, `cout`, `ttot`,`meal`, `mepr`, `btot`,`fintot`,`noofdays`) VALUES ('$id','$title','$fname','$lname','$troom','$bed','$nroom','$cin','$cout','$ttot','$meal','$mepr','$btot','$fintot','$days')";
														


														if(mysqli_query($con,$psql))
														{	$notfree="NotFree";
															$rpsql = "UPDATE `room` SET `place`='$notfree',`cusid`='$id' where bedding ='$bed' and type='$troom' and (cusid is null or cusid = 0)";
															if(mysqli_query($con,$rpsql))
															{
															echo "<script type='text/javascript'> alert('Phòng được xác nhận đã đặt')</script>";
															echo "<script type='text/javascript'> window.location='roombook.php'</script>";
															}
														}
												
											}
									
                                        
							}	
					
						}									


						?>




