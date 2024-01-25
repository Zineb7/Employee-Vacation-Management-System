<?php
    session_start();
    error_reporting(0);
    include('../includes/dbconn.php');
    if(strlen($_SESSION['alogin'])==0){   
        header('location:index.php');
    } else {

		//Inactive  Employee    
		if(isset($_GET['inid']))
		{
		$id=$_GET['inid'];
		$status=0;
		$sql = "UPDATE tblemployees set Status=:status  WHERE id=:id";
		$query = $dbh->prepare($sql);
		$query -> bindParam(':id',$id, PDO::PARAM_STR);
		$query -> bindParam(':status',$status, PDO::PARAM_STR);
		$query -> execute();
		header('location:employees.php');
		}
	
		//Activated Employee
		if(isset($_GET['id'])){
		$id=$_GET['id'];
		$status=1;
		$sql = "UPDATE tblemployees set Status=:status  WHERE id=:id";
		$query = $dbh->prepare($sql);
		$query -> bindParam(':id',$id, PDO::PARAM_STR);
		$query -> bindParam(':status',$status, PDO::PARAM_STR);
		$query -> execute();
		header('location:employees.php');
		}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OUMDIN Print - Admin </title>
		
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
						<!-- Page Header -->
						<br>
								
						<div class="page-header">
						<div class="row align-items-center">
							<div class="col-auto float-right ml-auto">
								<div class="btn-group ">
									
								<button onclick="window.print();" class="btn btn-white"><i class="fa fa-print fa-lg"></i> Print</button>
								</div>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
<div class="row">
		<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<h4 class="payslip-title">Les employés 2022</h4>
									<div class="row">
										<div class="col-sm-12">
                                        <div class="table-responsive">
									<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
											<thead>
												<tr>
												<th>#</th>
                                                <th>Nom Complet</th>
                                                <th>Employé ID</th>
                                                <th>Department</th>
                                                <th>Date d'Adhésion</th>
												</tr>
											</thead>
											<tbody>
											<?php 
											$sql = "SELECT EmpId,FirstName,LastName,Department,Status,RegDate,id from  tblemployees";
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
                                            
                                            <td><?php echo htmlentities($result->FirstName);?>&nbsp;<?php echo htmlentities($result->LastName);?></td>

                                            <td><?php echo htmlentities($result->EmpId);?></td>
                                            
                                            <td><?php echo htmlentities($result->Department);?></td>
    
                                             <td><?php echo htmlentities($result->RegDate);?></td>
													</tr>
													<?php $cnt++;} }?>
											</tbody>
										</table>
									</div>
										</div>

					
									</div>
								</div>
							</div>
		</div>
</div>				
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