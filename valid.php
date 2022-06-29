<?php
session_start();
$dsn = 'mysql:dbname=university;host=127.0.0.1;port=3306;';
$user = 'root';
$password = '123456';
$db = new PDO($dsn, $user, $password);

$error=[];
$old=[];
$file_name = $_FILES['file']['name'];
$file_tmp =$_FILES['file']['tmp_name'];
$ext=explode('.',$_FILES['file']['name']);
$file_ext=strtolower(end($ext));
$ext= pathinfo($file_name)["extension"];
$extensions= array("jpeg","jpg","png");
if(in_array($file_ext,$extensions)== false){
$error["pic"]=true;
}

if($_REQUEST["name"] ==""){
    $error["name"]=true;
   }
   else
   { $old["name"]=$_REQUEST["name"];
   }
   if($_REQUEST["price"] ==""){
    $error["price"]=true;
   }
   else
   { $old["price"]=$_REQUEST["price"];
   }
   if($_REQUEST["description"] ==""){
    $error["description"]=true;
   }
   else
   { $old["description"]=$_REQUEST["description"];
   }
 if(count($error)>0){
	$er=json_encode($error);
	$url="?error={$er}";
	if(count($old)>0){
		$oldval=json_encode($old);
		$url.="&?old={$oldval}";
	}
	header("location:addproduct.php{$url}");
	
}
 else{
	 
   /******************************/
   
 move_uploaded_file($file_tmp, "images/" . $file_name);
 
if($db){
$ins_query="insert into product(productName,price,description,photo,category,userid) values (?,?,?,?,?,?);";
   $stmt=$db->prepare($ins_query);
   $name=$_REQUEST["name"];
   $price=$_REQUEST["price"];
   $description=$_REQUEST["description"];
   $selct=$_REQUEST["selct"];
   $filename=$file_name;
  
   @$res =$stmt->execute([$name,$price,$description,$filename,$selct,$_SESSION['user']['Id']]);

 }
	header("location:product.php{$url}");

 }
 