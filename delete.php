<?php
$dbv = 'mysql:dbname=university;host=127.0.0.1;port=3306;';
$user = 'root';
$password = '123456';
$db = new PDO($dbv, $user, $password);
if($db){
$id=$_GET["id"];
//var_dump($id);
 $ins_query="delete from product where id=?";
  $stmt=$db->prepare($ins_query);
   $res=$stmt->execute([$id]);
   
   header("location:product.php");
	
}