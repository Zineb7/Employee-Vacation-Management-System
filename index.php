<?php
    session_start();
    error_reporting(0);
    include('includes/dbconn.php');
    if(isset($_POST['signin']))
    {
        $uname=$_POST['username'];
        $password=md5($_POST['password']);
        $sql ="SELECT EmailId,Password,Status,id FROM tblemployees WHERE EmailId=:uname and Password=:password";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':uname', $uname, PDO::PARAM_STR);
        $query-> bindParam(':password', $password, PDO::PARAM_STR);
        $query-> execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);

        if($query->rowCount() > 0)
        {
            foreach ($results as $result) {
                $status=$result->Status;
                $_SESSION['eid']=$result->id;
        }
            if($status==0)
        {
            $msg="Compte inactif. Veuillez contacter votre administrateur!";
        } else  {
            $_SESSION['emplogin']=$_POST['username'];
            echo "<script type='text/javascript'> document.location = 'employees/leave.php'; </script>";
        }
            }   else  {
                echo "<script>alert('Désolé, INFORMATIONS INVALID.');</script>";
                }

    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>OUMDIN Login - Espaace Employé</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body class="account-page">
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				
				<div class="container">
				
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="index.html"><img src="assets/img/logo2.png" alt="Dreamguy's Technologies"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Connexion Des Employés</h3>
							<p class="account-subtitle">Bienvenue dans votre espace</p>
                            <?php if($msg){?><div class="errorWrap"><strong>Erreur</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
							
							<!-- Account Form -->
							<form method="POST" name="signin">
								<div class="form-group">
									<label for="exampleInputEmail1">Adresse Email</label>
									<input class="form-control" type="email" id="username" name="username" autocomplete="off" required>
                                    <i class="ti-email"></i>
                                    <div class="text-danger"></div>
                                </div>
								<div class="form-group">
									<div class="row">
										<div class="col">
											<label for="exampleInputPassword1">Mot De Passe</label>
										</div>
										<div class="col-auto">
											<a class="text-muted" href="password-recovery.php">
												Mot De Passe Oublié?
											</a>
										</div>
									</div>
									<input class="form-control" type="password" id="password" name="password" autocomplete="off" required>
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" id="form_submit" type="submit" name="signin">Connexion</button>
								</div>
								<div class="account-footer">
									<p> <a href="admin/index.php">Allez dans le panneau d'administration</a></p>
								</div>
							</form>
							<!-- /Account Form -->
							
						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="assets/js/jquery-3.2.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>
		
    </body>
</html>