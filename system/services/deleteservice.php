<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
<?php include '../function.php'; ?>
<?php include '../config.php'; ?>
<?php
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'delete') {
    $db = dbConn();
    echo $sql = "DELETE FROM tbl_services WHERE service_id='$service_id'";

    $db->query($sql);
    header ("Location:editservices.php?status=delete");
}
?>