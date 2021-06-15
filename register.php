<?php 
    require_once "controllers/authController.php";

	if(isset($_SESSION['id'])){
        header("location:index.php");
        exit();
    }
?>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<!DOCTYPE html>
<html>
    
<head>
	<title>Kaydol Sayfası</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" ">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" ">
    <link rel="stylesheet" href="style.css">
</head>

<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				
                <!-- BURASI -->
				<?php if(count($errors)>0): ?>
						<div class="alert alert-danger">
						<?php foreach($errors as $error): ?>
							<li><?php echo $error; ?></li>
						<?php endforeach; ?>
						</div>
				<?php endif; ?>
				<div class="d-flex justify-content-center mt-4">
						
					<form action="register.php" method="POST">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input  type="text" name="userName" class="form-control input_user"  value="<?php echo $userName ?>" placeholder="Ad">
						</div>

						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input  type="text" name="userSurname" class="form-control input_user" value="<?php echo $userSurname ?>" placeholder="Soyad">
						</div>

						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-envelope"></i></span>
							</div>
							<input  type="email" name="userEmail" class="form-control input_user" value="<?php echo $userEmail ?>" placeholder="E-posta">
						</div>

						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-envelope"></i></span>
							</div>
							<input  type="text" name="userTelephone" class="form-control input_user" value="<?php echo $userTelephone ?>" placeholder="0 5XX XXX XX">
						</div>
						


						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input  type="password" name="userPassword" class="form-control input_pass" value="" placeholder="Şifre">
						</div>
						
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="submit" name="register-btn" class="btn btn-danger" style='width:100%'>Kaydol</button>
				   </div>
					</form>
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
					Hesabın var mı? <a href="login.php" class="ml-2">Giriş Yap</a>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</body>
</html>
