<?php
    session_start();
    error_reporting(0);
    include('../includes/dbconn.php');
    if(strlen($_SESSION['alogin'])==0){   
    header('location:index.php');
    } else { 
    if(isset($_GET['del']))
    {
    $id=$_GET['del'];
    $sql = "DELETE from  admin  WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':id',$id, PDO::PARAM_STR);
    $query -> execute();
    $msg="Le compte ADMIN sélectionné a été bien supprimé!";

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
        <title>OUMDIN Admin Manage - Admin </title>
		
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
                    <a href="dashboard.php" class="logo">
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
					<h3>PANNEAU D'ADMINISTRATION OUMDIN</h3>
					
                </div>
				<!-- Header Menu -->
				<ul class="nav user-menu">
				<?php 
					include 'dbconn.php';
					$isread=0;
					$sql = "SELECT id from tblleaves where IsRead=:isread";
					$query = $dbh -> prepare($sql);
					$query->bindParam(':isread',$isread,PDO::PARAM_STR);
					$query->execute();
					$results=$query->fetchAll(PDO::FETCH_OBJ);
					$unreadcount=$query->rowCount();

				?>
				<!-- Notifications -->
				<li class="nav-item dropdown">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<i class="fa fa-bell-o"></i> <span class="badge badge-pill"><?php echo htmlentities($unreadcount);?></span>
					</a>
					<div class="dropdown-menu notifications">
						<div class="topnav-dropdown-header">
							<span class="notification-title">Vous avez <?php echo htmlentities($unreadcount);?> <b>non lu</b> notifications!</span>
						</div>
						<div class="noti-content">
						<?php 
							$isread=0;
							$sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblleaves.PostingDate from tblleaves join tblemployees on tblleaves.empid=tblemployees.id where tblleaves.IsRead=:isread";
							$query = $dbh -> prepare($sql);
							$query->bindParam(':isread',$isread,PDO::PARAM_STR);
							$query->execute();
							$results=$query->fetchAll(PDO::FETCH_OBJ);
							if($query->rowCount() > 0)
							{
							foreach($results as $result)
							{              
						?>  
							<ul class="notification-list">
								<li class="notification-message">
									<a href="employeeLeave-details.php?leaveid=<?php echo htmlentities($result->lid);?>">
										<div class="media">
											<div class="media-body">
												<p class="noti-details"><span class="noti-title"><?php echo htmlentities($result->FirstName." ".$result->LastName);?></span> <br />(<?php echo htmlentities($result->EmpId);?>)</b> has recently applied for a leave.</p></p>
												<p class="noti-time"><span class="notification-time">at <?php echo htmlentities($result->PostingDate);?></span></p>
											</div>
										</div>
									</a>
								</li>
							</ul>
							<?php }} ?> 
						</div>
						
						
					</div>
				</li>
				<!-- /Notifications -->
				


				<li class="nav-item dropdown has-arrow main-drop">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<span class="user-img"><img src="../assets/img/profiles/avatar-21.jpg" alt="">
							<span class="status online"></span></span>
							<span>Admin</span>
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="logout.php">Déconnexion</a>
						</div>
					</li>
				</ul>
				<!-- /Header Menu -->
				
				<!-- Mobile Menu -->
				<div class="dropdown mobile-user-menu">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="logout.php">Déconnexion</a>
					</div>
				</div>
				<!-- /Mobile Menu -->
				
            </div>
			<!-- /Header -->
			
			<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul class="metismenu" id="menu">
							<li class="menu-title"> 
								<span>Main</span>
							</li>
							<li class="<?php if($page=='dashboard') {echo 'active';} ?>">
							<a href="dashboard.php"><i class="la la-dashboard"></i> <span> Tableau de bord</span></a>
							</li>
							<li>
							<a href="employees.php"  class="noti-dot"><i class="la la-users"></i> <span> Section Employés </span></a>
							</li>
							<li>
							<a href="department.php"><i class="la la-th-large"></i> <span> Section Département</span></a>
							</li>
							<li>
							<a href="leave-section.php"><i class="la la-sign-out "></i> <span>Types Congé</span></a>
							</li>
							<li class="submenu">
								<a href="javascript:void(0)"><i class="la la-briefcase"></i> <span> Gérer les congés </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
								<li ><a href="pending-history.php"><i class="la la-spinner"></i> En attente</a></li>
								<li ><a href="approved-history.php"><i class="la la-check"></i> Approuvé</a></li>
								<li ><a href="declined-history.php"><i class="la la-times-circle"></i> Refusé</a></li>
								<li ><a href="leave-history.php"><i class="la la-history"></i> Historique des congés</a></li>
								</ul>
							</li>
							<li>
							<a href="manage-admin.php"><i class="la la-lock"></i> <span> Gérer l'administration</span></a>
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
								<h3 class="page-title">Section ADMIN</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashboard.php">Accueil</a></li>
									<li class="breadcrumb-item active">Géstion d'Administration</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
								<a href="add-admin.php" class="btn add-btn"><i class="fa fa-plus"></i>Ajouter Administrateur</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					<!-- TABLE EMPLOYEE -->
					<div class="row">
						<div class="col-md-12 d-flex">
							<div class="card card-table flex-fill">
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

								<div class="card-header">
									<h3 class="card-title mb-0">Liste des ADMIN</h3>
								</div>
								<div class="card-body">
									<div class="table-responsive">
									<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
											<thead>
												<tr>
												<th>#</th>
                                                <th>Nom Complet</th>
                                                <th>Usermame</th>
                                                <th>Email ID</th>
                                                <th>Date d'Adhésion	</th>
												<th class="text-center">Action</th>
												</tr>
											</thead>
											<tbody>
											<?php $sql = "SELECT * from admin";
											$query = $dbh -> prepare($sql);
											$query->execute();
											$results=$query->fetchAll(PDO::FETCH_OBJ);
											$cnt=1;
											if($query->rowCount() > 0)
											{
											foreach($results as $result)
											{               ?>  
												<tr>
													<td> <?php echo htmlentities($cnt);?></td>
													<td><?php echo htmlentities($result->fullname);?></td>
													<td><?php echo htmlentities($result->UserName);?></td>
													<td><?php echo htmlentities($result->email);?></td>
													<td><?php echo htmlentities($result->updationDate);?></td>
													<td class="text-center"><a href="manage-admin.php?del=<?php echo htmlentities($result->id);?>" onclick="return confirm('Voulez-vous vraiment supprimer?');"> <i class="fa fa-trash" style="color:red"></i></a></td>
												</tr>
											<?php $cnt++;} }?>
											</tbody>
										</table>
									</div>
								</div>
								
							</div>
						</div>

					</div>
					<!-- TABLE EMPLOYEE -->
					
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