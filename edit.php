<?php
include "db_conn.php";


if(isset($_POST['submit'])){

    $first_name= $_POST['first_name'];
    $last_name= $_POST['last_name'];
    $email= $_POST['email'];
    $gender= $_POST['gender'];
    $address= $_POST['Address'];
    $salary= $_POST['Salary'];
    $age= $_POST['age'];
	$id=$_GET['id'];

	$sql = "UPDATE `crud` SET `first_name`='$first_name', `last_name`='$last_name', `email`='$email', `gender`='$gender', `age`='$age', `address`='$address', `salary`='$salary' WHERE id=$id";
	
    $result=mysqli_query($conn,$sql);

    if($result){
        header("Location: index.php?msg= user updated successfuly ");
    }else{
    echo "failed: ".mysqli_error($conn);
    }



	

}



?>






<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
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
    height: 600px; /* Increase the height to fit all fields */
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
	<?php
	
	$id=$_GET['id'];
	$sql = "SELECT * FROM `crud` WHERE id = $id LIMIT 1";
	$result=mysqli_query($conn,$sql);
	$row= mysqli_fetch_assoc($result);
	
	?>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">
		
			<div class="signup">
				<form action="" method="post" >
					<label for="chk" aria-hidden="true">Edit user information</label>
					
                    
                    <input type="text" name="first_name" placeholder="first_name" required="" value="<?php echo $row['first_name']; ?>">
					
                    <input type="text" name="last_name" placeholder="last_name" required="" value="<?php echo $row['last_name']; ?>">

                    <input type="email" name="email" placeholder="Email" required="" value="<?php echo $row['email']; ?>">

                    <input type="number" name="Salary" placeholder="Salary" required="" value="<?php echo $row['salary']; ?>">

                    <input type="text" name="Address" placeholder="Address" required="" value="<?php echo $row['address']; ?>">
                    					
                    <input type="number" name="age" placeholder="age" required="" value="<?php echo $row['age']; ?>">
					
                    <div class="gender">
                        <label style="font-size: 15px;"><input type="radio" name="gender" id="male" value="male" <?php echo ($row['gender']=="male")?"checked":""; ?> required> Male</label>
                        <label style="font-size: 15px;"><input type="radio" name="gender" id="fmale" value="fmale" <?php echo ($row['gender']=="fmale")?"checked":""; ?> required> Female</label>
                    </div>

                    <button type="submit" name="submit">update</button>
				</form>
			</div>

		
</body>
</html>