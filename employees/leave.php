<?php
    
    session_start();
    error_reporting(0);
    include('includes/dbconn.php');

    if(strlen($_SESSION['emplogin'])==0){   
    header('location:../index.php');
    }   else    {

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
        <title>OUMDIN - Historique des congés des employés</title>
		
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
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Mon historique de congés</h3>
								
							</div>
							
						</div>
					</div>
					<?php 
                                        $eid=$_SESSION['eid'];
										$sql2 = "SELECT COUNT(*) as c from tblleaves
										JOIN tblleavetype ON tblleavetype.leaveType = tblleaves.leaveType
										WHERE tblleaves.empid = :eid AND tblleaves.status = 1";										
										$sql3 = "SELECT COUNT(*) as c from tblleaves where empid=:eid and leaveType='Medical Leave'";  
										$sql4 = "SELECT COUNT(*) as c from tblleaves where empid=:eid and leaveType != 'Medical Leave'";                                      $query = $dbh -> prepare($sql2);
										$sql5 = "SELECT YEAR(FromDate) as year, SUM(DATEDIFF(ToDate, FromDate) + 1) as daysTaken 
										FROM tblleaves
										JOIN tblleavetype ON tblleavetype.leaveType = tblleaves.leaveType
										WHERE tblleaves.empid = :eid AND tblleaves.status = 1 
										GROUP BY YEAR(FromDate), tblleaves.empid";
                                        
										$query = $dbh -> prepare($sql2);
                                        $query->bindParam(':eid',$eid,PDO::PARAM_STR);
                                        $query->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt=1;
                                        if($query->rowCount() > 0){
                                        foreach($results as $result)
                                        {  ?> 
	
                                       
					<!-- Leave Statistics -->
					<div class="row">
						<div class="col-md-3">
							<div class="stats-info">
								<h6>Congés annuels</h6>
								<h4><?php echo htmlentities($result->c);?></h4>
							</div>
						</div>
						<div class="col-md-3">
							<div class="stats-info">
							<h6>Congés médicaux</h6>
							<?php 
								// Préparer la requête pour compter les congés médicaux
								$query = $dbh -> prepare($sql3);
								$query->bindParam(':eid',$eid,PDO::PARAM_STR);
								$query->execute();
								$results=$query->fetchAll(PDO::FETCH_OBJ);
								if($query->rowCount() > 0){
									foreach($results as $result)
									{ 
							?> 
							<h4><?php echo htmlentities($result->c);?></h4>
							<?php } }?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="stats-info">
								<h6>Autre congé</h6>
								<?php 
								// Préparer la requête pour compter les congés médicaux
								$query = $dbh -> prepare($sql4);
								$query->bindParam(':eid',$eid,PDO::PARAM_STR);
								$query->execute();
								$results=$query->fetchAll(PDO::FETCH_OBJ);
								if($query->rowCount() > 0){
									foreach($results as $result)
									{ 
							?> 
							<h4><?php echo htmlentities($result->c);?></h4>
							<?php } }?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="stats-info">
								<h6>Totale Jours</h6>
								<?php 
								// Préparer la requête pour compter les congés médicaux
								$query = $dbh -> prepare($sql5);
								$query->bindParam(':eid',$eid,PDO::PARAM_STR);
								$query->execute();
								$results=$query->fetchAll(PDO::FETCH_OBJ);
								if($query->rowCount() > 0){
									foreach($results as $result)
									{ 
							?> 
							<h4><?php  echo $result->daysTaken . "<br>";?></h4>
							<?php } }?>
							</div>
						</div>
						<?php $cnt++;} }?>
					</div>
				<!-- /Leave Statistics -->

					<div class="row">
						<div class="col-md-12">
						<h4 class="header-title">Tableau De L'Historique Des Congés</h4>
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0 ">
									<thead>
										<tr>
											<th>#</th>
											<th>Type Congés</th>
											<th>Conditions</th>
                                            <th>A partir de</th>
                                            <th>Vers</th>
                                            <th >Marque de l'administrateur</th>
											<th >Appliqué Le</th>
											<th class="text-center">Statut</th>
										</tr>
									</thead>
									<tbody>
									<?php 
                                        $eid=$_SESSION['eid'];
                                        $sql = "SELECT LeaveType,ToDate,FromDate,Description,PostingDate,AdminRemarkDate,AdminRemark,Status from tblleaves where empid=:eid";
                                        $query = $dbh -> prepare($sql);
                                        $query->bindParam(':eid',$eid,PDO::PARAM_STR);
                                        $query->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt=1;
                                        if($query->rowCount() > 0){
                                        foreach($results as $result)
                                        {  ?> 
										<tr>
                                            <td> <?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->LeaveType);?></td>
                                            <td><?php echo htmlentities($result->Description);?></td>
                                            <td><?php echo htmlentities($result->FromDate);?></td>
                                            <td><?php echo htmlentities($result->ToDate);?></td>
                                            <td><?php echo htmlentities($result->PostingDate);?></td>
											<td><?php if($result->AdminRemark=="")
                                            {
                                            echo htmlentities('Pending');
                                            } else {

                                            echo htmlentities(($result->AdminRemark)." "."a"." ".$result->AdminRemarkDate);
                                            }

                                            ?>
                                            </td>
											<td> 
												<?php $stats=$result->Status;
                                                	if($stats==1){
                                             	?>												
											 	<div class="action-label">
											 		<a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
												 		<i class="fa fa-dot-circle-o text-success"></i> Apprové
											 		</a>
												</div>
                                                <?php } if($stats==2)  { ?>

												<div class="action-label">
													<a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
														<i class="fa fa-dot-circle-o text-danger"></i> Refusé
													</a>
												</div>
                                                 <?php } if($stats==0)  { ?>

												<div class="action-label">
													<a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
														<i class="fa fa-dot-circle-o text-purple"></i> Nouveau
													</a>
												</div>
                                                <?php } ?>

                                             </td>
                                    
											
										</tr>
										<?php $cnt++;} }?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->

				
            </div>
			<!-- /Page Wrapper -->

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