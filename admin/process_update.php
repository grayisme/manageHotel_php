<?php
session_start();
if (!isset($_SESSION["user"])) {
	header("location:login.php");
}

include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ form
    $roomId = $_POST['roomId'];
    $newBedding = $_POST['bedding'];
    $newType = $_POST['type'];

    // Thực hiện truy vấn cập nhật
    $updateQuery = "UPDATE room SET bedding='$newBedding', type='$newType' WHERE id='$roomId'";
    $result = mysqli_query($con, $updateQuery);

    if ($result) {
        echo "Cập nhật thông tin phòng thành công!";
    } else {
        echo "Cập nhật thông tin phòng thất bại: " . mysqli_error($con);
    }
}
?>