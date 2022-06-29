<?php

session_start();

if (!(isset($_SESSION['user']))) {
    header('location:login.php');
}

@$error = json_decode($_GET['error']);

@$old = json_decode($_GET['?old']);

if (isset($_REQUEST['logout'])) {
	unset($_SESSION['user']);
	session_destroy();
	header('location:suq.html');
}

?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <link rel="icon" href="images/o.jpg" type="image/gif" />
    <meta name="keywords" content="متجر اكتروني" />
    <meta name="description" content="متجر اكتروني" />
    <meta name="author" content="" />

    <title>سوق الجامعة الهاشميه</title>

    <link rel="stylesheet" href="style.css">
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <style>
        p {
            color: red !important;
        }

        .have {
            color: blue !important;
        }
    </style>
    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- range slider -->

    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />

</head>

<body class="sub_page">

    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
            <div class="header_top">
                <div class="container-fluid">
                    <div class="top_nav_container">
                        <div class="contact_nav">
                            <a href="">
                                
                            </a>
                            <a href="">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span>
                                    Email : ahmadalgazo92@gmail.com
                                </span>
                            </a>
                        </div>

                        <div class="user_option_box">
                            <a href="" class="account-link">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>
                                <?php echo $_SESSION['user']['UserName']?>
                                </span>

                            </a>
                        
                            <a href="" class="cart-link">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>

                                <span>
                                <a href="addproduct.php?logout='true'">Logout</a>
                                </span>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="header_bottom">
                <div class="container-fluid">
                    <nav class="navbar navbar-expand-lg custom_nav-container ">
                        <a class="navbar-brand" href="suq.html">
                            <span>
                                سوق الجامعة الهاشمية
                            </span>
                        </a>

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class=""> </span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ">
                                <li class="nav-item active">
                                    <a class="nav-link" href="suq.html">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="about.html"> About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="product.php">Products</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="why.html">Why Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="testimonial.html">Testimonial</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>
        <!-- end header section -->
    </div>



    <div class="form-container" style="background-image: url('images/123.jpg');background-size:contain; ">

        <form action="valid.php" method="post" enctype="multipart/form-data">
            <h3> add product </h3>
            <input type="text" name="name" placeholder="enter name" class="box" value="<?php if (isset($old->name)) {
                                                                                            echo $old->name;
                                                                                        } else {
                                                                                            echo "";
                                                                                        } ?>"> <?php if (isset($error->name)) echo "<div class='message'> please enter product name</div>" ?>

            <input type="number" name="price" placeholder="enter price" class="box" value="<?php if (isset($old->price)) {
                                                                                                echo $old->price;
                                                                                            } else {
                                                                                                echo "";
                                                                                            } ?>"> <?php if (isset($error->price)) echo "<div class='message'> please enter price</div>" ?>

            <input type="text" name="description" placeholder="small description" class="box" value="<?php if (isset($old->description)) {
                                                                                                            echo $old->description;
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        } ?>"> <?php if (isset($error->description)) echo "<div class='message'> please enter description</div>" ?>



            <select name="selct" class="box">
                <?php

                echo "<option>خدمات</option> <option>سلع</option>";


                ?>
            </select>



            <input type="file" name="file" class="box">
            <input type="submit" name="submit" value="Save" class="btn btn-primary">
        </form>

    </div>

</body>

</html>