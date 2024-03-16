<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:login.php");
}
?> 
<?php
		// if(isset($_GET["rid"]))
        // // if(!isset($_GET["rid"]))

		// {
				
		// 	 header("location:login.php");
		// }
		// else {
		// 		$curdate=date("Y/m/d");
		// 		include ('db.php');
		// 		$id = $_GET['rid'];
		// 		// echo "<script type='text/javascript'> alert($id)</script>";


		// 		$sql ="Select * from roombook where id = '$id'";
		// 		$re = mysqli_query($con,$sql);
		// 		while($row=mysqli_fetch_array($re))
		// 		{
		// 			$title = $row['Title'];
		// 			$fname = $row['FName'];
		// 			$lname = $row['LName'];
		// 			$email = $row['Email'];
		// 			$country = $row['Country'];
		// 			$Phone = $row['Phone'];
		// 			$troom = $row['TRoom'];
		// 			$nroom = $row['NRoom'];
		// 			$bed = $row['Bed'];
		// 			$non = $row['NRoom'];
		// 			$meal = $row['Meal'];
		// 			$cin = $row['cin'];
		// 			$cout = $row['cout'];
		// 			$sta = $row['stat'];
		// 			$days = $row['nodays'];
		// 		}
		// }
		
		
		
			?> 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SUNRISE HOTEL</title>
	<!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- Morris Chart Styles-->
   
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
                <a class="navbar-brand" href="home.php"><?php echo $_SESSION["user"]; ?> </a>
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
                        <a class="active-menu" href="home.php"><i class="fa fa-dashboard"></i> <span style="margin-left: 5px;">Trạng thái</span></a>
                    </li>
                    <li>
                        <a href="messages.php"><i class="fa fa-desktop"></i>  <span style="margin-left: 5px;">Thư tin tức</span></a>
                    </li>
					<li>
                        <a href="roombook.php"><i class="fa fa-bar-chart-o"></i> <span style="margin-left: 5px;">Đặt phòng</span> </a>
                    </li>
                    <li>
                        <a href="payment.php" style="background-color: #225081"><i class="fa fa-qrcode"></i> <span style="margin-left: 5px;">Thanh toán</span></a>
                    </li>
                    <li>
                        <a  href="profit.php"><i class="fa fa-qrcode"></i> <span style="margin-left: 5px;">Lợi nhuận</span> </a>
                    </li>
                    

                    <li ><a href="usersetting.php" ><i class="fa fa-user fa-fw"></i> Hồ sơ người dùng</a>
                    </li>
                    <li><a href="settings.php"><i class="fa fa-gear fa-fw"></i> Quản lý phòng</a>
                    </li>

                    

                    
					</ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                           Chi tiết thanh toán<small> </small>
                        </h1>
                    </div>
                </div> 
                 <!-- /. ROW  -->
				 
				 
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Tên</th>
											<th>Loại phòng</th>
                                            <th>Loại giường</th>
                                            <th>Ngày vào</th>
											<th>Ngày ra</th>
											<th>Số phòng</th>
											<th>Loại bữa ăn</th>
											
                                            <th>Giá phòng</th>
											<th>Giá bữa</th>
											<th>Giá giường</th>
                                            <th>Đã cọc</th>
											<th>Nhận</th>
											<th>In</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
									<?php
										include ('db.php');
										$sql="select * from payment";
										$re = mysqli_query($con,$sql);
										while($row = mysqli_fetch_array($re))
										{
										
											$id = $row['id'];

                                            $roomType = $row['troom'];
                                            //30% cọc 
                                            $depositPercentage = 0.3;

                                            if ($roomType == 'Phòng cao cấp') {
                                                $deposit = $depositPercentage * 2200000;
                                            } elseif ($roomType == 'Phòng sang trọng') {
                                                $deposit = $depositPercentage * 3200000;
                                            } elseif ($roomType == 'Phòng khách') {
                                                $deposit = $depositPercentage * 1800000;
                                            } elseif ($roomType == 'Phòng đơn') {
                                                $deposit = $depositPercentage * 1500000;
                                            } else {
                                                // Handle other room types if needed
                                                $deposit = 0;
                                            }

                                            // Calculate remaining amount after subtracting the deposit
                                            $remainingAmount = $row['fintot'] - $deposit;
											if($id % 2 ==1 )
											{
												echo"<tr class='gradeC'>
                                                <td>".$row['lname']." ".$row['fname']." </td>
													<td>".$row['troom']."</td>
													<td>".$row['tbed']."</td>
													<td>".$row['cin']."</td>
													<td>".$row['cout']."</td>
													<td>".$row['nroom']."</td>
													<td>".$row['meal']."</td>
													
													<td>".$row['ttot']."</td>
													<td>".$row['mepr']."</td>
													<td>".$row['btot']."</td>
                                                    <td>".$deposit."</td>
													<td>".$remainingAmount."</td>
													<td><a href=print.php?pid=".$id ." <button class='btn btn-primary'> <i class='fa fa-print' ></i> Print</button></td>
													</tr>";
											}
											else
											{
												echo"<tr class='gradeU'>
													<td> ".$row['lname']." ".$row['fname']." </td>
													<td>".$row['troom']."</td>
													<td>".$row['tbed']."</td>
													<td>".$row['cin']."</td>
													<td>".$row['cout']."</td>
													<td>".$row['nroom']."</td>
													<td>".$row['meal']."</td>
													
													<td>".$row['ttot']."</td>
													<td>".$row['mepr']."</td>
													<td>".$row['btot']."</td>
													<td>".$deposit."</td>
													<td>".$remainingAmount."</td>
													<td><a href=print.php?pid=".$id ." <button class='btn btn-primary'> <i class='fa fa-print' ></i> Print</button></td>
													</tr>";
											
											}
										
										}
										
									?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
            
                </div>
               
            </div>
        
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    
   
</body>
</html>
