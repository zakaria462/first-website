<?php
session_start();
include("rtz.php");

if (isset($_SESSION['user_id'])) {
    if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin') {
        header("Location: dachbord.php");
    } else {
        header("Location: profile.php");
    }
    exit;
}
if (isset($_SESSION['user_id'])) {
    if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin') {
        $accountLink = "<li><a href='dachbord.php'>Account</a></li>";
    } else {
        $accountLink = "<li><a href='profile.php'>Account</a></li>";
    }
} else {
    $accountLink = "<li><a href='#Account'>Account</a></li>";
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['signin_btn'])) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['mdpass']);

        $query = "SELECT * FROM form WHERE email = '$email' AND mdpass = '$password' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $user_data['id'];
            $_SESSION['user_type'] = $user_data['type'];
            if ($user_data['type'] == 'admin') {
                header("Location: dachbord.php");
            } else {
                header("Location: index.html");
            }
            
            exit;
        } else {
            echo "<script type='text/javascript'> alert('Wrong email or password') </script>";
        }
    } elseif (isset($_POST['signup_btn_2'])) {
        $username = mysqli_real_escape_string($con, $_POST['flname']);
        $num = mysqli_real_escape_string($con, $_POST['num']);
        $adress = mysqli_real_escape_string($con, $_POST['adress']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['mdpass']);

        if (!empty($username) && !empty($num) && !empty($adress) && !empty($email) && !empty($password)) {
            $query = "INSERT INTO form (flname, num, adress, email, mdpass) VALUES ('$username','$num','$adress','$email','$password')";
            $result = mysqli_query($con, $query);

            if ($result) {
                echo "<script type='text/javascript'> alert('Successfully registered. You can now sign in.') </script>";
            } else {
                echo "<script type='text/javascript'> alert('Registration failed') </script>";
            }
        } else {
            echo "<script type='text/javascript'> alert('Please fill in all fields') </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="login.css">
<link rel="stylesheet" href="e-site.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="header">
    <div class="stiky">
        <div>
            <a href="index.html"><img src="pictures/logo.png" class="logo"></a>
        </div>
        <div class="top-nav">
            <nav class="navbar">
                <ul>
                    <li><a href="index.html" >Home</a></li>
                    <li><a href="index.html">Products</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="<?php echo $accountLink; ?>" class="active1">Account</a></li>
                </ul>
            </nav>  
            <div class="top-icons">
                <i class="fa fa-search" onclick="showbar()"></i>
                <a href="login.html"><i class="fa fa-user"></i></a>
                <i class="fa fa-cart-plus"></i>
            </div>
        </div>
    </div>
</div>

<div class="main_container">
    <div class="login_form" id="move_form_right">
        <div class="display_block" id="test1">
            <h1 id="sign_in">Sign in</h1>
            <form action="" class="form" method="POST">
                <input id="check_login_email" type="text" name="email" placeholder="Email">
                <input id="check_login_password" type="password" name="mdpass" placeholder="Enter your Password">
                <a href="#" id="forget">Forgot your Password?</a>
                <button id="signin_btn" name="signin_btn">SIGN IN</button>
            </form>
        </div>
        <div class="display_none" id="test2">
            <h1 id="create_account">Create Account</h1>
            <form action="" class="form" method="POST">
                <input type="text" id="check_login_name" name="flname" placeholder="Name" required>
                <input id="check_login_email" type="email" name="email" placeholder="Email" required>
                <input id="check_login_phone" type="tel" name="num" placeholder="Phone Number" required>
                <input id="check_login_address" type="text" name="adress" placeholder="Address" required>
                <input id="check_login_password" type="password" name="mdpass" placeholder="Password" required>
                <input id="check_login_confirm_password" type="password" name="mdpass" placeholder="Confirm Password" required>
                <button id="signup_btn_2" name="signup_btn_2">SIGN UP</button>
            </form>
        </div>
    </div>

    <div class="login_message" id="move_div_left">
        <div class="display_block" id="test3">
            <h1 id="welcome_title">Hi User!</h1>
            <span id="welcome_text">Enter Some Personal Details and get Ready to <span id="text_split">Start your Journey with Us!</span></span>
            <button id="signup_btn" onclick="return showSignUp()">SIGN UP</button>
        </div>
        <div class="display_none" id="test4">
            <h1 id="welcome_back_title">Welcome Back</h1>
            <span id="welcome_text_2">To Keep Connected With Us Please Login<span id="text_split_2">with Your Personal Info</span></span>
            <button id="signin_btn" onclick="return showSignIn()">SIGN IN</button>
        </div>
    </div>

    <div class="welcome_back" id="move_div_right">
        <div class="" id="test4">
            <h1 id="welcome_back_title">Welcome Back</h1>
            <span id="welcome_text_2">To Keep Connected With Us Please Login <span id="text_split_2">with Your Personal Info</span></span>
            <button id="signin_btn" onclick="return showSignIn()">SIGN IN</button>
        </div>
    </div>
</div>

<script src="login.js"></script>
</body>
</html>
