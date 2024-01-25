<?php
    session_start();
    error_reporting(0);
    include('includes/dbconn.php');
    
    if(isset($_POST['change']))
        {
    $newpassword=md5($_POST['newpassword']);
    $empid=$_SESSION['empid'];

    $con="UPDATE tblemployees set Password=:newpassword where id=:empid";
    $chngpwd1 = $dbh->prepare($con);
    $chngpwd1-> bindParam(':empid', $empid, PDO::PARAM_STR);
    $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
    $chngpwd1->execute();
    $msg="Votre mot de passe a été récupéré. Entrez les nouvelles informations d'identification pour continuer!";
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
        <title>OUMDIN Mot De Passe Oublié - Espace Employé</title>
		
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
        <div id="preloader">
            <div class="loader"></div>
        </div>
		<!-- Main Wrapper -->
        <div class="main-wrapper">

			<div class="account-content">
				<div class="container">
                <?php if($error){?><div class="alert alert-danger alert-dismissible fade show"><strong>Info: </strong><?php echo htmlentities($error); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                            
                </div><?php } 
                else if($msg){?><div class="alert alert-success alert-dismissible fade show"><strong>Info: </strong><?php echo htmlentities($msg); ?> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
             </div><?php }?>
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="index.html"><img src="assets/img/logo2.png" alt="Dreamguy's Technologies"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">RÉCUPÉRER VOTRE <br>MOT DE PASSE</h3>
							<p class="account-subtitle">Veuillez fournir les coordonnées de votre employé pour la récupération.</p>
							
							<!-- Account Form -->
							<form method="POST" name="signin">
								<div class="form-group">
									<label for="exampleInputEmail1">Email adresse</label>
									<input class="form-control" type="email" id="exampleInputEmail1" name="emailid" autocomplete="off">
                                    <i class="ti-email"></i>
                                    <div class="text-danger"></div>
								</div>
                                <div class="form-group">
									<label for="exampleInputPassword1">Employé ID</label>
									<input class="form-control" type="text" id="exampleInputPassword1" name="empid" autocomplete="off">
                                    <i class="ti-id-badge"></i>
                                    <div class="text-danger"></div>
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" id="form_submit" name="submit" type="submit">PROCÉDER À LA RÉCUPÉRATION <i class="ti-arrow-right"></i></button>
								</div>
								<div class="account-footer">
                                <p class="text-muted">Vous avez un compte? <a href="index.php">Connectez-vous maintenant</a></p>
								</div>
							</form>
							<!-- /Account Form -->
                            <?php if(isset($_POST['submit']))
                            {
                            $empid=$_POST['empid'];
                            $email=$_POST['emailid'];
                            $sql ="SELECT id FROM tblemployees WHERE EmailId=:email and EmpId=:empid";
                            $query= $dbh -> prepare($sql);
                            $query-> bindParam(':email', $email, PDO::PARAM_STR);
                            $query-> bindParam(':empid', $empid, PDO::PARAM_STR);
                            $query-> execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            if($query->rowCount() > 0){
                            foreach ($results as $result) {
                                $_SESSION['empid']=$result->id;
                            } 
                                ?>
                            
                            <div class="account-box">
                            <form method="POST" name="updatepwd">
								<div class="form-group">
                                <label for="exampleInputEmail1">Entrez le nouveau mot de passe</label>
									<input class="form-control" type="password" id="exampleInputEmail1" name="newpassword" required autocomplete="off">
                                    <i class="ti-key"></i>
                                    <div class="text-danger"></div>
								</div>
                                <div class="form-group">
									<label for="exampleInputPassword1">Confirmer le mot de passe</label>
									<input class="form-control" type="password" id="exampleInputPassword1" name="confirmpassword" required autocomplete="off">
                                    <i class="ti-id-badge"></i>
                                    <div class="text-danger"></div>
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" id="form_submit" name="change" type="submit">TERMINÉ <i class="ti-arrow-right"></i></button>
								</div>
                                </form>
								<?php } else{ ?>
                            <?php echo "<script>alert('Désolé, Informations Invalid.');</script>"; } } ?>
							
                            </div>

                            
							
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