<?php include('conn.php');
	session_start();
	//print_r($_SESSION);
?>
<!doctype html>
<html lang="en">
  <head>
  	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('headers.php'); ?>
  	<title>Login</title>
	 <link rel="stylesheet" href="css/style.css">
	<style>
		body{
			background-image: url('images/home.jpg');
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;
		}
	</style>

	</head>
	<body>
	<?php
		$errorMessage = "";
		if(isset($_POST['login'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$myQuery = mysqli_query($con,"SELECT * FROM admins WHERE username ='$username' AND password = '$password'");
			if( $row = mysqli_fetch_array($myQuery)){
				$_SESSION['userInfo'] = $row;
				header("location:index.php");// to go to another page named index.php
			} else {
				$errorMessage = "*Invalid Username / Password";
			}
		}
	?>
		<div class="container">
			<br> <br>
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(images/bg-1.jpg);">
			      		</div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Cake Orders Management</h3>
			      		</div>
			      	</div>
					<form method = "POST" class="signin-form">
			      		<div class="form-group mb-3">
			      			<label class="label" for="username">Username</label>
			      			<input id ="username" name="username" type="text" class="form-control" placeholder="Username" required>
			      		</div>
						<div class="form-group mb-3">
							<label class="label" for="password">Password</label>
						<input id ="password" name="password" type="password" class="form-control" placeholder="Password" required>
						</div>
						<div class="form-group">
							<button name="login" type="submit" class="form-control btn btn-primary rounded submit px-3">Log In</button>
						</div>
		          </form>
				  <label class = "text-danger"><?php echo($errorMessage); ?></label>
		        </div>
		      </div>
				</div>
			</div>
		</div>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

