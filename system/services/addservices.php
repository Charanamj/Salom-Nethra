<?php include '../menu.php'; ?>
<?php
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    extract($_POST);
    $service_category= dataClean($service_category);
    $service_name = dataClean($service_name);
    $service_description = dataClean($service_description);
    $service_price = dataClean($service_price);
    $service_image = $_FILES['service_image'];

    $messages = array();

    if (empty($service_category)) {
        $messages['service_category'] = "The service category should be select..!";
    }
    if (empty($service_name)) {
        $messages['service_name'] = "The service name should not be empty..!";
    }
    if (empty($service_description)) {
        $messages['service_description'] = "The service description should not be empty..!";
    }
    if (empty($service_price)) {
        $messages['service_price'] = "The service price should not be empty..!";
    }
    if ($_FILES['service_image']['name'] != "") {
        $service_image = $_FILES['service_image'];
        $filename = $service_image['name'];
        $filetmpname = $service_image['tmp_name'];
        $filesize = $service_image['size'];
        $fileerror = $service_image['error'];
        //take file extension
        $file_ext = explode(".", $filename);
        $file_ext = strtolower(end($file_ext));
        //select allowed file type
        $allowed = array("jpg", "jpeg", "png", "gif");
        //check wether the file type is allowed
        if (in_array($file_ext, $allowed)) {
            if ($fileerror === 0) {
                //file size gives in bytes
                if ($filesize <= 40000000) {
                    //giving appropriate file name. Can be duplicate have to validate using function
                    $file_name_new = uniqid('', true) . $service_name . '.' . $file_ext;
                    //directing file destination
                    $file_path = "../assets/images/services/" . $file_name_new;
                    //moving binary data into given destination
                    if (move_uploaded_file($filetmpname, $file_path)) {
                        "The file is uploaded successfully";
                    } else {
                        $messages['file_error'] = "File is not uploaded";
                    }
                } else {
                    $messages['file_error'] = "File size is invalid";
                }
            } else {
                $messages['file_error'] = "File has an error";
            }
        } else {
            $messages['file_error'] = "Invalid File type";
        }
    }

    if (empty($messages)) {
        $db = dbConn();
        $AddUser = $_SESSION['LogId'];
        $AddDate = date('y-m-d');
        $status = 1;
        $sql = "INSERT INTO `tbl_services`(service_category_id,service_name,service_status,serviceadd_date,serviceadd_user,service_description,service_price,service_image) VALUES ('$service_category','$service_name','$status','$AddDate','$AddUser','$service_description','$service_price','$file_name_new')";

        $db->query($sql);
        echo "<script>
        Swal.fire({
            title: 'Added!',
            text: 'Added Successfully !.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'http://localhost/SMS/system/services/addservices.php'; // Redirect to success page
        });
</script>";
    }
}

?>

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Salon Services</h4>
            <p class="card-description"> Add Salon Service </p>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
            <?php
          $db = dbConn();
          $sql2 = "SELECT * FROM  tbl_services_category";
          $result2 = $db->query($sql2);
          ?>
                    <label for="exampleInputName1">Select Service Category</label>
                    <select type="text" class="form-control" id="exampleInputName1" name="service_category">
                    <option value="">--</option>
                    <?php
            while ($row = $result2->fetch_assoc()) {
              ?>
              <option value="<?= $row['service_category_id'] ?>" <?= @$tbl_services_category == $row['service_category_id'] ? 'selected' : '' ?>>
                <?= $row['service_category_name'] ?>
              </option>
              <?php
            }
            ?>
          </select>
                    <span class="text-danger"><?= @$messages['service_category'] ?></span>
                </div>
            <div class="form-group">
                    <label for="exampleInputName1">Service Name</label>
                    <input type="text" class="form-control" id="exampleInputName1" name="service_name"
                        value="<?= @$service_name ?>" placeholder="Enter the service name">
                    <span class="text-danger"><?= @$messages['service_name'] ?></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Service Description</label>
                    <input type="text" class="form-control" id="exampleInputName1" name="service_description"
                        value="<?= @$service_description ?>" placeholder="Enter the service description">
                    <span class="text-danger"><?= @$messages['service_description'] ?></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Service Price</label>
                    <input type="text" class="form-control" id="exampleInputName1" name="service_price"
                        value="<?= @$service_price ?>" placeholder="Enter the service description">
                    <span class="text-danger"><?= @$messages['service_price'] ?></span>
                </div>
                <div class="form-group">
                    <label>Service Image</label><br>
                    <input type="file" name="service_image">
                </div>
                <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</div>
<?php include '../footer.php'; ?>