<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:login.php");
}
ob_start();
include ('db.php');
$sql = "select * from room";
$re = mysqli_query($con,$sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $roomId = $_POST['id'];
        
        // Perform the deletion in your database
        $deleteSql = "DELETE FROM `room` WHERE id = '$roomId' AND (cusid IS NULL OR cusid = '0')";
        
        mysqli_query($con, $deleteSql);

        // Check the number of affected rows
        $affectedRows = mysqli_affected_rows($con);

        if ($affectedRows > 0) {
            echo "<script type='text/javascript'>      
            alert('Phòng đã được xóa');
            </script>";
        } else {
            // Check if cusid is not NULL and not equal to '0'
            $checkOccupiedSql = "SELECT * FROM `room` WHERE id = '$roomId' AND cusid IS NOT NULL AND cusid <> '0'";
            $result = mysqli_query($con, $checkOccupiedSql);
            
            if (mysqli_num_rows($result) > 0) {
                echo "<script type='text/javascript'> alert('Phòng đang có người đặt')</script>";
            } else {
                echo "<script type='text/javascript'> alert('Lỗi khi xóa phòng')</script>";
            }
        }
    }
}
?> 

<?php
include('db.php');
$rsql ="select id from room";
$rre=mysqli_query($con,$rsql);

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
   <style>
    /* Override hover effect for panel-footer within your section */
    .row .panel-footer:hover {
        background-color: inherit; /* or any other desired background color */
    }
	.text-body {
		color: white;
	}
    .t {
        background-color: #ea003a;
    } 
</style>
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
                <a class="navbar-brand" href="home.php">Menu chính </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
			
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="usersetting.php"><i class="fa fa-user fa-fw"></i> Hồ sơ</a>
                        </li>
                        <li><a href="settings.php"><i class="fa fa-gear fa-fw"></i> Quản lý phòng</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Đăng xuất</a>
                        </li>
                    </ul>
					
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
                        <a  href="settings.php"><i class="fa fa-dashboard"></i>Trạng thái phòng</a>
                    </li>
					<li>
                        <a   href="room.php"><i class="fa fa-plus-circle"></i>Thêm phòng</a>
                    </li>
                    <li>
                        <a  class="active-menu" href="roomdel.php" style="background-color: #225081"><i class="fa fa-pencil-square-o"></i> Xóa phòng</a>
                    </li>
					<li><a href="home.php"><i class="fa fa-sign-out fa-fw"></i>Home</a></li>

                    
            </div>

        </nav>
        <!-- /. NAV SIDE  -->
       
        
       
        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                           Xóa phòng <small></small>
                        </h1>
                    </div>
                </div> 
                 
                                 
            <div class="row">
                
                <div class="col-md-12 col-sm-12">
                        <!-- <div class="panel-heading">
						Xóa phòng
                        </div> -->
						<div>
                        <form name="form" method="post">
                            <!-- <div class="form-group">
                                            <label>Chọn phòng theo ID *</label>
                                            <select name="id"  class="form-control" required>
												<option value selected ></option>
												<?php
												while($rrow=mysqli_fetch_array($rre))
												{
												$value = $rrow['id'];
												 echo '<option value="'.$value.'">'.$value.'</option>';
												
												}
												?>
                                                
                                            </select>
                              </div> -->
							  
								
							  <!-- <input type="submit" name="del" value="Delete Room" class="btn btn-primary" onclick="showDeleteRoomModal()"> -->
							</form>
                        
                        
                    </div>
                </div>
                
                  
           <?php
						include ('db.php');
						$sql = "select * from room";
						$re = mysqli_query($con,$sql)
				?>
                <div class="row">
    <?php
    while ($row = mysqli_fetch_array($re)) {
        $roomId = $row['id'];
        $roomType = $row['type'];
        $buttonColorClass = getButtonColorClass($roomType);

        // ... your existing code to display the room ...

        echo "<div class='col-md-3 col-sm-12 col-xs-12'>
                <div class='panel panel-primary text-center no-boder '>
                    <div class='panel-body $buttonColorClass'>
                        <i class='fa fa-users fa-5x'></i>
                        <h3>" . $row['bedding'] . "</h3>
                    </div>
						<div class='panel-footer '>
							" . $roomType . "
							<button class='btn btn-sm text-body t' onclick='showDeleteRoomModal($roomId)'>Xóa phòng</button>
						</div>
                </div>
            </div>";
    }

    // Function to get button color class based on room type
    function getButtonColorClass($roomType)
    {
        switch ($roomType) {
            case "Phòng cao cấp":
                return "btn-danger"; // Red button
            case "Phòng sang trọng":
                return "btn-success"; // Green button
            case "Phòng khách":
                return "btn-warning"; // Yellow button
            case "Phòng đơn":
                return "btn-primary"; // Blue button
            default:
                return "btn-secondary"; // Default color
        }
    }
    ?>
</div>
				
            <?php
			
			ob_end_flush();
			?>
                    
            
				
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
            function showDeleteRoomModal(roomId) {
                $('#deleteRoomModal').modal('show');
                // Set the roomId in a hidden input field
                $('#roomIdInput').val(roomId);
            }

            function deleteRoom() {
                // Submit the form
                document.getElementById('deleteRoomForm').submit();

            }
			
        </script>

        <!-- Thêm modal xác nhận xóa -->
        <form method="post" id="deleteRoomForm">
            <input type="hidden" name="id" id="roomIdInput">
            <div class="modal fade" id="deleteRoomModal" tabindex="-1" role="dialog" aria-labelledby="deleteRoomModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteRoomModalLabel">Xác nhận xóa phòng</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Bạn có chắc chắn muốn xóa phòng này không?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-danger" onclick="deleteRoom()">Xóa</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>

</body>
</html>
