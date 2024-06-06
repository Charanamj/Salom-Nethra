<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
<?php include '../function.php'; ?>
<?php include '../config.php'; ?>
<?php
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'deactivate') {
    $db = dbConn();
    $sql = "UPDATE tbl_staff SET staff_status= '2' WHERE staff_id='$staff_id'";

    $db->query($sql);
    header ("Location:viewstaff.php?status=activate");
}
?>