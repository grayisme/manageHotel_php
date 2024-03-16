<?php

include ('db.php');
$eid = $_GET['eid'];
$approval ="Cho phép";
$napproval="Không cho phép";

$view="select * from contact where id = '$eid' ";
$re = mysqli_query($con,$view);
while ($row=mysqli_fetch_array($re))
{
	$id =$row['approval'];

}

if($id=="Không cho phép")
{
	$sql ="UPDATE `contact` SET `approval`= '$approval' WHERE id = '$eid' ";
	if(mysqli_query($con,$sql))
	{
		echo '<script>alert("Đã thay đổi trạng thái"); window.location.href = "messages.php";</script>';
	}
}
else {
$sql ="UPDATE `contact` SET `approval`= '$napproval' WHERE id = '$eid' ";
	if(mysqli_query($con,$sql))
	{
		echo '<script>alert("Đã thay đổi trạng thái"); window.location.href = "messages.php";</script>';		
	}
}
?>