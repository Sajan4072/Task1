<?php 

session_start();


$mysqli=new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));
$id=0;
$update=false;
$name='';
$location='';


if (isset($_POST['submit'])){
   $name=$_POST['name'];
   $location=$_POST['location'];

    $mysqli->query("INSERT INTO data(name,location) VALUES('$name','$location')") or  die(mysqli_error($mysqli));



   $_SESSION['message']="record saved";
   $_SESSION['msg_type']="success";

   header("location:index.php");


}
if(isset($_GET['delete'])){
	$id=$_GET['delete'];
	$mysqli->query("DELETE FROM data where id=$id") or die($mysqli->error());

   $_SESSION['message']="record deleted";
   $_SESSION['msg_type']="danger";
   
   header("location:index.php");
}

if(isset($_GET['edit'])){
	$id=$_GET['edit'];
	$update=true;
	$fetchedresult= $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());

	if(count($fetchedresult)==1){
		$row=$fetchedresult->fetch_array();
		$name=$row['name'];
		$location=$row['location'];
	}
}
if(isset($_POST['update'])){
	$id=$_POST['id'];
	$name=$_POST['name'];
	$location=$_POST['location'];
	
	$mysqli->query("UPDATE data SET name='$name',location='$location' WHERE id=$id") or die($mysqli->error);
	$_SESSION['message']="record updated";
	$_SESSION['msg_type']="warning";
	header('location:index.php');
}
?>

