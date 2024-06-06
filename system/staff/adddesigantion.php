<?php include '../menu.php'; ?>

<?php
extract($_POST);
//name action value add designation wena ekakin awama witharai meka wenne
if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'adddesignation') {
  extract($_POST);
  $designation = dataClean($designation);

  $messages = array();

if (empty($designation)) {
    $messages['designation'] = "The Designation name should not be empty..!";
}

if (empty($messages)) {
    $db = dbConn();
    // $AddUser = $_SESSION['UserId'];
    $AddDate = date('y-m-d');
    $status = 1;
    $sql = "INSERT INTO `designation`(designation_name) VALUES ('$designation')";

    $db->query($sql);
}
}

?>
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Adding Salon Staff Designation</h4>
      <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="form-group">
          <label for="exampleInputName1">Designation Name</label>
          <input type="text" class="form-control" id="exampleInputName1" name="designation"
            value="<?= @$designation ?>" placeholder="Enter the Designation Name">
          <span class="text-danger"><?= @$messages['designation'] ?></span>
        </div>
        <button type="submit" name="action" value="adddesignation" class="btn btn-gradient-primary me-2">Submit</button>
        <!-- <button class="btn btn-light">Cancel</button> -->
    </form>
</div>
</div>
</div>
<?php include '../footer.php'; ?>


        