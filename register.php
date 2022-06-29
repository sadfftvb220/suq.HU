<?php
$dsn = 'mysql:dbname=university;host=127.0.0.1;port=3306;';
$user = 'root';
$password = '123456';
$db = new PDO($dsn, $user, $password);
@$error = json_decode($_GET['error']);
@$old = json_decode($_GET['?old']);
session_start();
if (isset($_POST['submit'])) {
    $error=[];
$old=[];
$file_name =$_FILES['file']['name'];
$file_tmp =$_FILES['file']['tmp_name'];
$ext=explode('.',$_FILES['file']['name']);
$file_ext=strtolower(end($ext));
$ext= pathinfo($file_name)["extension"];
$extensions= array("jpeg","jpg","png","PNG","JPG","JPEG");
    if((in_array($file_ext,$extensions)== false && $file_name!=="" ) ||strlen($file_name)>50 ){
        $error["pic"]=true;
        }

        if($_REQUEST["name"] =="" || strlen($_REQUEST["name"])>20){
            $error["name"]=true;
           }
           else
           { $old["name"]=$_REQUEST["name"];
           }

        
           if($_REQUEST["phone"] =="" || !is_numeric($_REQUEST["phone"])){
            $error["phone"]=true;
           }
           else
           { $old["phone"]=$_REQUEST["phone"];
           }

   $stmtmal = "SELECT * FROM `user` WHERE `email` =:email ";
   $stmtmal = $db->prepare($stmtmal);
   $stmtmal->bindParam(":email",$_REQUEST["email"]);
   $stmtmal->execute();
   $rowmal = $stmtmal->fetch(PDO::FETCH_ASSOC);
    
   if($rowmal || $_REQUEST["email"] ==""){
            $error["email"]=true;
           }
           else
           { $old["email"]=$_REQUEST["email"];
           }
           if($_REQUEST["password"] =="" ||strlen($_REQUEST["password"])>100){
            $error["password"]=true;
           }
           else
           { $old["password"]=$_REQUEST["password"];
           }

           if(count($error)>0){
            $er=json_encode($error);
            $url="?error={$er}";
            if(count($old)>0){
                $oldval=json_encode($old);
                $url.="&?old={$oldval}";
            }
            header("location:register.php{$url}");
            
        }
         else{
            if($file_name!==""){
            move_uploaded_file($file_tmp, "images/" . $file_name);
            $filename=$file_name;
            }else
            {
                $filename="77.jpg";
            }
            
if($db){
    $ins_query="insert into user(UserName,email,Pasword,roles,photo,phone) values (?,?,?,?,?,?);";
       $stmt=$db->prepare($ins_query);
       $name=$_REQUEST["name"];
       $email=$_REQUEST["email"];
      
       $password=$_REQUEST["password"];

       $rol=$_REQUEST["selct"];
      $phone=$_REQUEST["phone"];
       @$res =$stmt->execute([$name,$email,$password,$rol,$filename,$phone]);
    
     }
        header("location:login.php");

         }



        }
    

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>regiter V13</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="register.css">

</head>

<body style="background-color: #999999">
    <div class="limiter">
    <div class="container-login100">
            <div class="login100-more" style="background-image: url('images/289658661_1846829172459578_4991767606446974304_n.jpg');background-size: contain;"></div>
            <div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
                <form action="" method="post" enctype="multipart/form-data">
                    <span class="login100-form-title p-b-59"> Sign Up </span>
                    <div class="wrap-input100 validate-input"  >
                        <span class="label-input100">Full Name</span>
                        <input class="input100" type="text"  name="name"    placeholder="Name..." / value="<?php if (isset($old->name)) {
                                                                                            echo $old->name;
                                                                                        } else {
                                                                                            echo "";
                                                                                        } ?>"> <?php if (isset($error->name)) echo "<div  style='color:red'> please enter your name and must be less than 20 letter</div>" ?>
                      
                    </div>

                    <div class="wrap-input100 validate-input"  >
                        <span class="label-input100">Email</span>
                        <input class="input100" type="email" placeholder="Email addess..."  name="email" value="<?php if (isset($old->email)) {
                                                                                            echo $old->email;
                                                                                        } else {
                                                                                            echo "";
                                                                                        } ?>"> <?php if (isset($error->email)) echo "<div  style='color:red'> please enter new email </div>" ?>
                      
                        <span class="focus-input100"></span>
                       
                    </div>

                 
                    <div class="wrap-input100 validate-input"  >
                        <span class="label-input100">Phone </span>
                        <input class="input100" type="text"  name="phone"    placeholder="Whatsapp phone Number..." / value="<?php if (isset($old->phone)) {
                                                                                            echo $old->phone;
                                                                                        } else {
                                                                                            echo "";
                                                                                        } ?>"> <?php if (isset($error->phone)) echo "<div  style='color:red'> please enter your Phone number</div>" ?>
                      
                    </div>

                    <div class="wrap-input100 validate-input"  >
                        <span class="label-input100">Password</span>
                        <input class="input100"  name="password"     placeholder="*************" value="<?php if (isset($old->password)) {
                                                                                            echo $old->password;
                                                                                        } else {
                                                                                            echo "";
                                                                                        } ?>"> <?php if (isset($error->password)) echo "<div  style='color:red'> please enter  correct password </div>" ?>
                      
 
                    </div> 
                    <select name="selct" class="input100">
                <?php

                echo "<option>بائع</option> <option>مشترى</option>";


                ?>
            </select>
                    <div    >
                    <br><br><br>
                    <input type="file" name="file" class="box">
                    <br><br><br>
 
                    </div>


               
                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button   type="submit"  class="login100-form-btn btn-success"  name="submit"   >Sign Up</button>
                        </div>
                        <a routerLink="login.php" routerLinkActive="active" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">Sign in<i class="fa fa-long-arrow-right m-l-5"></i></a>
                    </div>
                </form>

            </div>
        </div>
    </div>


</body>

</html>