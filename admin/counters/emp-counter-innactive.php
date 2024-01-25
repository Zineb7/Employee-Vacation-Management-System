<?php
    include '../../includes/dbconn.php';

    $sql = "SELECT COUNT(*) FROM `tblemployees` 
    WHERE id IN (SELECT empid FROM `tblleaves` WHERE status=1 AND ToDATE > now()) ";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $empcount=$query->rowCount();

    echo htmlentities($empcount);
?>