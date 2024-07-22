<?php
include "db_conn.php";

$error_message = '';

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // تحديد الحد الأدنى للطول
    $min_length = 8;

    // التحقق من تطابق كلمتي المرور
    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    }

    // التحقق من الطول الأدنى
    elseif (strlen($password) < $min_length) {
        $error_message = "Password must be at least $min_length characters long.";
    }

    // التحقق من وجود أحرف كبيرة وصغيرة وأرقام ورموز خاصة
    elseif (!preg_match('/[A-Z]/', $password)) {
        $error_message = "Password must contain at least one uppercase letter.";
    }

    elseif (!preg_match('/[a-z]/', $password)) {
        $error_message = "Password must contain at least one lowercase letter.";
    }

    elseif (!preg_match('/[0-9]/', $password)) {
        $error_message = "Password must contain at least one number.";
    }

    elseif (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
        $error_message = "Password must contain at least one special character.";
    }

    if (empty($error_message)) {
        // تشفير كلمة المرور
        $hashed_password = md5($password);

        $stmt = $conn->prepare("INSERT INTO `users` (`name`, `email`, `password`, `confirm_password`) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $hashed_password, $hashed_password);

        if ($stmt->execute()) {
            header("Location: index.php?msg=new user created successfully");
        } else {
            $error_message = "Failed: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();

    // ---------------------------#[ email]#----------------------------------------------------
    // إزالة أي مسافات زائدة في البداية والنهاية
    $email = trim($email);
    $pattern = "/^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/";

    // التحقق من تنسيق البريد الإلكتروني
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match($pattern, $email)) {
    } else {
        $error_message = "Invalid email format. Ensure:<br>
            - Valid characters before '@'.<br>
            - A valid domain name.<br>
            - A valid top-level domain (e.g., .com, .net).";
    }
}

if (isset($_POST["login"])) {
    $email = $_POST['email'];
    $password = $_POST['pswd'];

    // تشفير كلمة المرور
    $hashed_password = md5($password);

    // التحقق من وجود البريد الإلكتروني وكلمة المرور في قاعدة البيانات
    $stmt = $conn->prepare("SELECT * FROM `users` WHERE `email` = ? AND `password` = ?");
    $stmt->bind_param("ss", $email, $hashed_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: index.php");
    } else {
        $error_message = "Invalid email or password.";
    }

    $stmt->close();
}

$conn->close();
?>










<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

<style>
    body{
	margin: 0;
	padding: 0;
	display: flex;
	justify-content: center;
	align-items: center;
	min-height: 100vh;
	font-family: 'Jost', sans-serif;
	background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
}

.alert-custom {
    position: fixed;
    top: 20px;
    right: 20px;
    width: auto;
    max-width: 300px;
    z-index: 9999;
}

@media (max-width: 768px) {
    .alert-custom {
        width: 90%;
        top: 10px;
        right: 5%;
    }
}

button {
    height: 40px;
    margin-top: 20px;
}

.gender {
    display: flex;
    justify-content: space-around;
    align-items: center;
    color: #fff;
}

.gender label {
    display: flex;
    align-items: center;
    cursor: pointer;
}

.gender input[type="radio"] {
    margin-right: 5px;
    cursor: pointer;
}

.main{
	width: 350px;
    height: 518px; /* Increase the height to fit all fields */
	background: red;
	overflow: hidden;
	background: url("https://doc-08-2c-docs.googleusercontent.com/docs/securesc/68c90smiglihng9534mvqmq1946dmis5/fo0picsp1nhiucmc0l25s29respgpr4j/1631524275000/03522360960922298374/03522360960922298374/1Sx0jhdpEpnNIydS4rnN4kHSJtU1EyWka?e=view&authuser=0&nonce=gcrocepgbb17m&user=03522360960922298374&hash=tfhgbs86ka6divo3llbvp93mg4csvb38") no-repeat center/ cover;
	border-radius: 10px;
	box-shadow: 5px 20px 50px #000;
}
#chk{
	display: none;
}
.signup{
	position: relative;
	width:100%;
	height: 100%;
}
label{
	color: #fff;
	font-size: 2.3em;
	justify-content: center;
	display: flex;
	margin: 50px;
	font-weight: bold;
	cursor: pointer;
	transition: .5s ease-in-out;
    margin: 30px 0 10px; /* Adjust the margin to give enough space */

}
input{
	width: 80%;
	height: 10px;
	background: #e0dede;
	justify-content: center;
	display: flex;
	margin: 20px auto;
	padding: 12px;
	border: none;
	outline: none;
	border-radius: 5px;
    margin: 10px auto;

}
button{
	width: 80%;
	height: 40px;
    margin: 10px auto;

	margin: 10px auto;
	justify-content: center;
	display: block;
	color: #fff;
	background: #573b8a;
	font-size: 1em;
	font-weight: bold;
	margin-top: 30px;
	outline: none;
	border: none;
	border-radius: 5px;
	transition: .2s ease-in;
	cursor: pointer;
}
button:hover{
	background: #6d44b8;
}
.login{
	height: 460px;
	background: #eee;
	border-radius: 60% / 10%;
	transform: translateY(-180px);
	transition: .8s ease-in-out;
}
.login label{
	color: #573b8a;
	transform: scale(.6);
}

#chk:checked ~ .login{
	transform: translateY(-500px);
}
#chk:checked ~ .login label{
	transform: scale(1);	
}
#chk:checked ~ .signup label{
	transform: scale(.6);
}

</style>
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">
<!-- ------------------------------------------# [   alert msg     ] #------------------------------------------------------------------------------------------------- -->
<?php if (!empty($error_message)): ?>
    <div id="alert" class="alert alert-danger alert-dismissible fade show alert-custom" role="alert">
        <?php echo $error_message; ?>
        
    </div>
<?php endif; ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const alertBox = document.getElementById("alert");
        if (alertBox) {
            setTimeout(() => {
                $(alertBox).alert('close');
            }, 3000);
        }
    });
</script>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------- -->

			<div class="signup">
				<form action="" method="post" >
					<label for="chk" aria-hidden="true">Sign up</label>
										
                    <input type="text" name="name" placeholder="name" required="" >

                    <input type="email" name="email" placeholder="Email" required="" >

                    <input type="password" name="password" placeholder="password" required="" >

                    <input type="password" name="confirm_password" placeholder="confirm password" required="" >


                    <button type="submit" name="submit">Sign up</button>
				</form>
			</div>
<!--------------------------#[ login ]#--------------------------------------------------------------------------- -->
			<div class="login">
				
				<form action="" method="post">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="pswd" placeholder="Password" required="">
					<button type="submit" name="login">Login</button>
				</form>
			</div>
</div>
		
</body>
</html>