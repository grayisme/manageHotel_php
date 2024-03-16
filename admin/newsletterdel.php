<?php

include ('db.php');

$id=$_GET['eid'];
if($id=="")
{
echo '<script>alert("Xin lỗi ! Bạn đã nhập sai") </script>' ;
		header("Location: messages.php");


}

else{
$view="DELETE FROM `contact` WHERE id ='$id' ";

	if($re = mysqli_query($con,$view))
	{
		echo '<script>alert("Người đăng ký nhận thư đã bị xóa") </script>' ;
		header("Location: messages.php");
	}


}







?>