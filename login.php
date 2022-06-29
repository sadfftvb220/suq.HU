<?php
$dsn = 'mysql:dbname=university;host=127.0.0.1;port=3306;';
$user = 'root';
$password = '123456';
$db = new PDO($dsn, $user, $password);
@$error = json_decode($_GET['error']);
 
session_start();
if (isset($_POST['submit'])) {
    $error=[];
   $email =  $_POST['email'];
   $password = $_POST['password']; 

   $stmt = "SELECT * FROM `user` WHERE `email` =:email AND `Pasword` = :password ";
   $stmt = $db->prepare($stmt);
   $stmt->bindParam(":email", $email);
   $stmt->bindParam(":password", $password);
   $stmt->execute();
   $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
   if($row){
   switch ($row) {
      case $row["roles"] =="مشترى";
         $_SESSION['user'] = $row;
       
         header("location:userhome.php");
         break;
      case $row["roles"] =="بائع";
               $_SESSION['user'] = $row;
        
         header("location:product.php");
         break;
      default:
      break;
   }
}else{
    $error["password"]=true;
    $er=json_encode($error);
    $url="?error={$er}";
      header("location:login.php{$url}");
   }
   /////////////////////////////////////


}





?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="login.css">
    <!--===============================================================================================-->
    

</head>

<body>



    <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
        <form action="" method="post">
       
        
                <span class="login100-form-title p-b-37"  >
					Sign In
				</span>

                <div class="wrap-input100 validate-input m-b-20"  >
                    <input type="email" name="email"   class="input100 " aria-describedby="emailHelp"   placeholder="username or email">
                 
                     
                </div>

                <div class="wrap-input100 validate-input m-b-25"  >
                    <input type="password" name="password"  aria-describedby="emailHelp"  class="input100" placeholder="password">
               
                      
                </div>
                <?php if (isset($error->password)) echo "<div  style='color:red'> Incorrect Email Or Password <br><br></div>" ?>
                <div class="container-login100-form-btn">
                <button type="submit" class="login100-form-btn" name="submit">
						Sign In
					</button>   </div>
                </form>
                <div class="text-center p-t-57 p-b-20">
                    <span class="txt1">
						Or login with
					</span>
                </div>

                <div class="flex-c p-b-112">
                    <a href="#" class="login100-social-item">
                   
                    <img src="images/facebook-icon-small.png" alt="GOOGLE">
                    </a>

                    <a href="#" class="login100-social-item">
                        <img src="images/icon-google.png" alt="GOOGLE">
                    </a>
                </div>

                <div      class="text-center">
                    <a    href="register.php"   class="txt2 hov1">
						Sign Up
					</a>
                </div>
          


        </div>
    </div>



    <div id="dropDownSelect1"></div>



</body>

</html>