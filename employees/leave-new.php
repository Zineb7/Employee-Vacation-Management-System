<?php
    session_start();
    error_reporting(0);
    include('../includes/dbconn.php');
    if(strlen($_SESSION['emplogin'])==0)
        {   
    header('location:../index.php');
    }   else    {
        if(isset($_POST['apply']))
        {

        $empid=$_SESSION['eid'];
        $leavetype=$_POST['leavetype'];
        $fromdate=$_POST['fromdate'];  
        $todate=$_POST['todate'];
        $description=$_POST['description'];  
        $status=0;
        $isread=0;
		$current_date = date('Y-m-d');

        if($fromdate > $todate ){
            $error=" Veuillez entrer les détails corrects : La date de fin doit être antérieure à la date de début pour être valide! ";
            }
		else if ($fromdate < $current_date) {
			$error= "La date de début de congé ne peut pas être inférieure à la date d'aujourd'hui.";}

        $sql="INSERT INTO tblleaves(LeaveType,ToDate,FromDate,Description,Status,IsRead,empid) VALUES(:leavetype,:todate,:fromdate,:description,:status,:isread,:empid)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':leavetype',$leavetype,PDO::PARAM_STR);
        $query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
        $query->bindParam(':todate',$todate,PDO::PARAM_STR);
        $query->bindParam(':description',$description,PDO::PARAM_STR);
        $query->bindParam(':status',$status,PDO::PARAM_STR);
        $query->bindParam(':isread',$isread,PDO::PARAM_STR);
        $query->bindParam(':empid',$empid,PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();

        if($lastInsertId)
        {
             $msg="Votre demande de congé a été appliquée, Merci.";
        }   else    {
            $error="Désolé, il n'a pas pu être traité cette fois. Veuillez réessayer plus tard.";
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
        <title>OUMDIN New Leave</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="../assets/css/line-awesome.min.css">
		
		<!-- Chart CSS -->
		<link rel="stylesheet" href="../assets/plugins/morris/morris.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="../assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
	
    <body>
		 <!-- preloader area start -->
		 <div id="preloader">
        	<div class="loader"></div>
    	</div>
    <!-- preloader area end -->
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
            <div class="header">
			
				<!-- Logo -->
                <div class="header-left">
                    <a href="leave.php" class="logo">
						<img src="../assets/img/logo.png" width="40" height="40" alt="">
					</a>
                </div>
				<!-- /Logo -->
				
				<a id="toggle_btn" href="javascript:void(0);">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</a>
				
				<!-- Header Title -->
                <div class="page-title-box">
					<h3>OUMDIN Espace Employé </h3>
                </div>
				<!-- /Header Title -->
				
				<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
				<?php include '../includes/employee-profile-section.php'?>
				<!-- Mobile Menu -->
				<div class="dropdown mobile-user-menu">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
					<span><?php include 'logged.php' ?> </span>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="my-profile.php">Mon Profil</a>
						<a class="dropdown-item" href="change-password-employee.php">Mot De Passe</a>
						<a class="dropdown-item" href="logout.php">Déconnecter</a>
					</div>
				</div>
				<!-- /Mobile Menu -->
				
            </div>
			<!-- /Header -->
			
			<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title"> 
								<span>Principal</span>
							</li>
							<li>
								<a href="leave.php"><i class="la la-dashboard"></i> <span> Mon historique de congés</span></a>
							</li>
							<li>
								<a href="leave-new.php" class="noti-dot"><i class="la la-edit"></i> <span> Demande de congé </span> </span></a>
							</li>
							<li class="menu-title"> 
								<span>Profil</span>
							</li>
							<li>
								<a href="my-profile.php"><i class="la la-user"></i> <span>Mon Profil</span></span></a>
								<a href="change-password-employee.php"><i class="la la-key"></i> <span> Mot De Passe </span></span></a>
							</li>
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
                <div class="content container-fluid">
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Demande de jours de congé</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="leave.php">Mon historique de congés</a></li>
									<li class="breadcrumb-item active">Demande de jours de congé</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-lg-12">
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
							<div class="card">
								<div class="card-header">
									<h4 class="card-title mb-0">Formulaire de congé de l'employé</h4>
									<p class="text-muted font-14 mb-4">Veuillez remplir le formulaire ci-dessous.</p>
									
								</div>
								<div class="card-body">
									<form name="addemp" method="POST">
										<div class="form-group row">
											<label class="col-form-label col-md-2">Date de début</label>
											<div class="col-md-10">
											<input class="form-control" type="date" value="2023-01-05" data-inputmask="'alias': 'date'" required id="example-date-input" name="fromdate">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-2">Date de fin</label>
											<div class="col-md-10">
											<input class="form-control" type="date" value="2023-01-15" data-inputmask="'alias': 'date'" required id="example-date-input" name="todate">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-2">Sélection par défaut</label>
											<div class="col-md-10">
												<select value="" class="form-control"  name="leavetype" autocomplete="off">
												<?php $sql = "SELECT LeaveType from tblleavetype";
                                                    $query = $dbh -> prepare($sql);
                                                    $query->execute();
                                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                    $cnt=1;
                                                    if($query->rowCount() > 0) {
                                                        foreach($results as $result)
                                                {   ?> 
                                                <option value="<?php echo htmlentities($result->LeaveType);?>"><?php echo htmlentities($result->LeaveType);?></option>
                                                <?php }
                                            } ?>
												</select>
											</div>
											
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-2">Décrivez vos conditions</label>
											<div class="col-md-10">
												<textarea name="description" type="text" name="description" length="400" id="example-text-input" rows="5" cols="5" class="form-control" placeholder="Votrer vos conditions.."></textarea>
											</div>
										</div>
										<div class="form-group mb-0 row">
											<label class="col-form-label col-md-2"></label>
											<div class="col-md-10">
													<div class="input-group-append">
														<button class="btn btn-primary" type="submit" name="apply" id="apply">DEMANDER</button>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				
				</div>			
			</div>
			<!-- /Main Wrapper -->

        </div>
		<!-- /Main Wrapper -->

		<!-- jQuery -->
        <script src="../assets/js/jquery-3.2.1.min.js"></script>

		<!-- Bootstrap Core JS -->
        <script src="../assets/js/popper.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>

		<!-- Slimscroll JS -->
		<script src="../assets/js/jquery.slimscroll.min.js"></script>
		
		<!-- Select2 JS -->
		<script src="../assets/js/select2.min.js"></script>
		
		<!-- Datatable JS -->
		<script src="../assets/js/jquery.dataTables.min.js"></script>
		<script src="../assets/js/dataTables.bootstrap4.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="../assets/js/moment.min.js"></script>
		<script src="../assets/js/bootstrap-datetimepicker.min.js"></script>

		<!-- Custom JS -->
		<script src="../assets/js/app.js"></script>
		
    </body>
</html>
<?php } ?> 