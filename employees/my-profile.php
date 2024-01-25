<?php
    session_start();
    error_reporting(0);
    include('../includes/dbconn.php');
    if(strlen($_SESSION['emplogin'])==0){   
        header('location:../index.php');
    } else {
    $eid=$_SESSION['emplogin'];
    if(isset($_POST['update'])){

    $fname=$_POST['firstName'];
    $lname=$_POST['lastName'];   
    $gender=$_POST['gender']; 
    $dob=$_POST['dob']; 
    $department=$_POST['department']; 
    $address=$_POST['address']; 
    $city=$_POST['city']; 
    $country=$_POST['country']; 
    $mobileno=$_POST['mobileno']; 
    $sql="update tblemployees set FirstName=:fname,LastName=:lname,Gender=:gender,Dob=:dob,Department=:department,Address=:address,City=:city,Country=:country,Phonenumber=:mobileno where EmailId=:eid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':fname',$fname,PDO::PARAM_STR);
    $query->bindParam(':lname',$lname,PDO::PARAM_STR);
    $query->bindParam(':gender',$gender,PDO::PARAM_STR);
    $query->bindParam(':dob',$dob,PDO::PARAM_STR);
    $query->bindParam(':department',$department,PDO::PARAM_STR);
    $query->bindParam(':address',$address,PDO::PARAM_STR);
    $query->bindParam(':city',$city,PDO::PARAM_STR);
    $query->bindParam(':country',$country,PDO::PARAM_STR);
    $query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
    $query->bindParam(':eid',$eid,PDO::PARAM_STR);
    $query->execute();
    $msg="Votre dossier a été mis à jour avec succès!";
    } ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>OUMDIN - Employee Profile</title>
		
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
								<h3 class="page-title">Mon Profil</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="leave.php">Mon historique de congés</a></li>
									<li class="breadcrumb-item active">Mon Profil</li>
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
									<h4 class="card-title mb-0">Mettre à jour mon profil</h4>
									<p class="text-muted font-14 mb-4">Veuillez effectuer des changements dans le formulaire ci-dessous afin de mettre à jour votre profil.</p>
                                    <?php 
                                            $eid=$_SESSION['emplogin'];
                                            $sql = "SELECT * from  tblemployees where EmailId=:eid";
                                            $query = $dbh -> prepare($sql);
                                            $query -> bindParam(':eid',$eid, PDO::PARAM_STR);
                                            $query->execute();
                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt=1;
                                            if($query->rowCount() > 0){
                                                foreach($results as $result)
                                            { 
                                        ?> 
								</div>
								<div class="card-body">
									<form name="addemp" method="POST">
										<div class="form-group row">
											<label class="col-form-label col-md-2">Prénom</label>
											<div class="col-md-10">
												<input type="text" class="form-control" name="firstName" value="<?php echo htmlentities($result->FirstName);?>"  type="text" required id="example-text-input">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-2">Nom</label>
											<div class="col-md-10">
												<input type="text" class="form-control" name="lastName" value="<?php echo htmlentities($result->LastName);?>" type="text" autocomplete="off" required id="example-text-input">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-2">Email</label>
											<div class="col-md-10">
												<input type="text" class="form-control" name="email" type="email"  value="<?php echo htmlentities($result->EmailId);?>" readonly autocomplete="off" required id="example-email-input">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-2">Genre</label>
											<div class="col-md-10">
												<select class="form-control" name="gender" autocomplete="off">
                                                <option value="<?php echo htmlentities($result->Gender);?>"><?php echo htmlentities($result->Gender);?></option>
                                                <option value="Male">Homme</option>
                                                <option value="Female">Femme</option>
                                                <option value="Other">Autre</option>
												</select>
											</div>
										</div>
                                        <div class="form-group row">
											<label class="col-form-label col-md-2">Date de naissance</label>
											<div class="col-md-10">
											<input class="form-control" type="date" name="dob" id="birthdate" value="<?php echo htmlentities($result->Dob);?>">
											</div>
										</div>
                                        <div class="form-group row">
											<label class="col-form-label col-md-2">Numéro de contact</label>
											<div class="col-md-10">
												<input  class="form-control" name="mobileno" type="tel" value="<?php echo htmlentities($result->Phonenumber);?>" maxlength="10" autocomplete="off" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-2">Employé ID</label>
											<div class="col-md-10">
                                            <input class="form-control" name="empcode" type="text" autocomplete="off" readonly required value="<?php echo htmlentities($result->EmpId);?>" id="example-text-input">
											</div>
										</div>
                                        <div class="form-group row">
											<label class="col-form-label col-md-2">Pays</label>
											<div class="col-md-10">
												<input type="text" class="form-control" name="country"  value="<?php echo htmlentities($result->Country);?>" autocomplete="off" required id="example-text-input">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-2">Adresse</label>
											<div class="col-md-10">
												<input  class="form-control" name="address" type="text"  value="<?php echo htmlentities($result->Address);?>" autocomplete="off" required>
											</div>
										</div>
                                        <div class="form-group row">
											<label class="col-form-label col-md-2">Ville</label>
											<div class="col-md-10">
												<input type="text" class="form-control" name="city" type="text"  value="<?php echo htmlentities($result->City);?>" autocomplete="off" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-2">Département sélectionné</label>
											<div class="col-md-10">
												<select class="form-control" name="department" autocomplete="off">
                                                <option value="<?php echo htmlentities($result->Department);?>"><?php echo htmlentities($result->Department);?></option>

                                                <?php $sql = "SELECT DepartmentName from tbldepartments";
                                                    $query = $dbh -> prepare($sql);
                                                    $query->execute();
                                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                    $cnt=1;
                                                    if($query->rowCount() > 0){
                                                    foreach($results as $resultt)
                                                    {   
                                                ?>  
                                                    <option value="<?php echo htmlentities($resultt->DepartmentName);?>"><?php echo htmlentities($resultt->DepartmentName);?></option>
                                                <?php }} ?>

												</select>
											</div>
										</div>
                                        <?php }
                                        }?>
										<div class="form-group mb-0 row">
											<label class="col-form-label col-md-2"></label>
											<div class="col-md-10">
													<div class="input-group-append">
														<button class="btn btn-primary" name="update" id="update" type="submit">APPLIQUER HANGEMENTS</button>
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