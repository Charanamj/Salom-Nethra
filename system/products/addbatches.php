<?php include '../menu.php'; ?>


<?php
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    extract($_POST);
    $batch_name = dataClean($batch_name);

    $messages = array();

    if (empty($batch_name)) {
        $messages['batch_name'] = "The batch name should not be empty..!";
    }
    if (!empty($batch_name)) {
        $db = dbConn();
        $lower= strtolower($batch_name);
        $sql = "SELECT * FROM  tbl_batches WHERE batch_name='$batch_name'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
          $messages['batch_name'] = "This batch name is already in the database";
        }
      }
    if (empty($messages)) {
        $db = dbConn();
        $AddUser = $_SESSION['LogId'];
        $lower= strtolower($batch_name);
        $AddDate = date('y-m-d');
        $status = 1;
        $sql = "INSERT INTO tbl_batches (batch_name,batchadd_date,batchadd_user) VALUES ('$lower','$AddDate','$AddUser')";

        $db->query($sql);
        echo "<script>
        Swal.fire({
            title: 'Added!',
            text: 'Added Successfully !.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'http://localhost/SMS/system/products/addbatches.php'; // Redirect to success page
        });
</script>";
    }
}
?>
<style>
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 20px;
    }

    .card-title {
        margin-bottom: 20px;
        font-size: 24px;
        font-weight: bold;
    }

    .card-description {
        margin-bottom: 20px;
        font-size: 16px;
        color: #666;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        border-radius: 5px;
        border: 1px solid #ccc;
        padding: 10px;
        width: 100%;
        box-sizing: border-box;
    }

    .text-danger {
        color: #dc3545;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-gradient-primary {
        background: linear-gradient(45deg, #2196F3, #04befe);
        color: white;
        border: none;
    }

    .btn-light {
        background-color: #f1f1f1;
        color: #333;
        border: 1px solid #ccc;
    }
</style>

<!-- Your PHP and HTML code here -->

<div class="col-1 grid-margin stretch-card"></div>
<div class="col-8 grid-margin stretch-card" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add Batches to products</h4>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="form-group">
                    <label for="exampleInputName1">Batch Name</label>
                    <input type="text" class="form-control" id="exampleInputName1" name="batch_name"
                        value="<?= @$batch_name ?>" placeholder="Enter the batch name">
                    <span class="text-danger"><?= @$messages['batch_name'] ?></span>
                </div>
                <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</div>
<div class="col-1 grid-margin stretch-card"></div>
<?php include '../footer.php'; ?>