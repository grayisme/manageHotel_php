<?php
session_start();
if (!isset($_SESSION["user"])) {
	header("location:login.php");
}

ob_start();

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
<style>
	/* Override hover effect for panel-footer within your section */

	.text-body {
		color: white;
	}

	.t {
		background-color: blue;
	}
</style>

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
				<li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Đăng xuất</a>
				</li>
				</li>
			</ul>
		</nav>
		<!--/. NAV TOP  -->
		<nav class="navbar-default navbar-side" role="navigation">
			<div class="sidebar-collapse">
				<ul class="nav" id="main-menu">

					<!-- <li><a  class="active-menu" href="usersetting.php" ><i class="fa fa-pencil-square-o" autofocus></i>Tài khoản</a></li> -->
					<li>
						<a class="active-menu" href="settings.php" style="background-color: #225081"><i class="fa fa-dashboard"></i>Trạng thái phòng</a>
					</li>
					<li>
						<a href="room.php"><i class="fa fa-plus-circle"></i>Thêm phòng</a>
					</li>
					<li>
						<a href="roomdel.php"><i class="fa fa-pencil-square-o"></i> Xóa phòng</a>
					</li>
					<li><a href="home.php"><i class="fa fa-sign-out fa-fw"></i>Home</a></li>


			</div>

		</nav>
		<!-- /. NAV SIDE  -->

		<div id="page-wrapper">
			<div id="page-inner">
				<div class="row">
					<div class="col-md-12">
						<h1 class="page-header">
							Phòng còn trống <small></small>
						</h1>
					</div>
				</div>


				<?php
				include('db.php');
				$sql = "select * from room where cusid is null or cusid = 0";
				$re = mysqli_query($con, $sql);
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

										<button class='btn btn-primary btn btn-sm text-body t' data-toggle='modal' data-target='#updateModal' 
										onclick='showUpdateRoomModal($roomId)'
										>
															Cập nhật
													</button>
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
				<!-- /. ROW  -->



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
    <?php
    // Lấy tất cả thông tin phòng và lưu trữ nó trong một biến JavaScript
    $allRooms = array();
    $sqlAllRooms = "SELECT * FROM room";
    $resultAllRooms = mysqli_query($con, $sqlAllRooms);
    while ($rowAllRooms = mysqli_fetch_assoc($resultAllRooms)) {
        $allRooms[$rowAllRooms['id']] = $rowAllRooms;
    }
    echo "var allRooms = " . json_encode($allRooms) . ";";
    ?>

    function showUpdateRoomModal(roomId) {
        $('#updateModal').modal('show');

        // Truy xuất thông tin phòng trực tiếp từ biến JavaScript

        var roomInfo = allRooms[roomId];

        // điền các trường ở form modal
        $('#roomIdInput').val(roomInfo.id);
        $('#bedding').val(roomInfo.bedding);
        $('#type').val(roomInfo.type);

        // Show the modal
        $('#updateModal').modal('show');
    }

    function updateRoom() {
        // Submit 
        document.getElementById('updateForm').submit();
    }
</script>
		
<?php
include ('db.php');
$sql = "select * from room";
$re = mysqli_query($con,$sql);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $roomId = $_POST['id'];
        // Perform the deletion in your database
		$type = $_POST['type'];
		$bedding = $_POST['bedding'];

		$upsql = "UPDATE `room` SET `type`='$type',`bedding`='$bedding' WHERE id = '$roomId'";
		if (mysqli_query($con, $upsql)) {
				echo '<script>
					setTimeout(function() {
						window.location.href = "settings.php";
					}, 1000);
					alert("Phòng đã được cập nhật");
				</script>';
		}
    }
}
?>
		<!-- Modal Update -->
		<form id="updateForm" method="post">
		<input type="hidden" name="id" id="roomIdInput">
			<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="updateModalLabel">Cập nhật thông tin phòng</h4>
						</div>
						<div class="modal-body">
							<!-- Form update thông tin phòng -->

							<div class="form-group">
								<label for="bedding">Bedding:</label>
								<select class="form-control" id="bedding" name="bedding" required>
									<option value="Đơn">Đơn</option>
									<option value="Đôi">Đôi</option>
									<option value="Ba">Ba</option>
									<option value="Bốn">Bốn</option>
								</select>
							</div>
							<div class="form-group">
								<label for="type">Loại phòng:</label>
								<select class="form-control" id="type" name="type" required>
									<option value="Phòng cao cấp">Phòng cao cấp</option>
									<option value="Phòng sang trọng">Phòng sang trọng</option>
									<option value="Phòng khách">Phòng khách</option>
									<option value="Phòng đơn">Phòng đơn</option>
								</select>
							</div>
							<button type="button" class="btn btn-danger" onclick="updateRoom()">Cập nhật</button>
						</div>
					</div>
				</div>
			</div>
		</form>

	</div>

</body>

</html>