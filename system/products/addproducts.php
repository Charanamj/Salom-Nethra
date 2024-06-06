<?php include '../menu.php'; ?>


<?php
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    extract($_POST);
    $product_category = dataClean($product_category);
    $batch_name = dataClean($batch_name);
    $product_name = dataClean($product_name);
    $product_serialnumber = dataClean($product_serialnumber);
    $product_description = dataClean($product_description);
    $product_price = dataClean($product_price);
    $product_image = $_FILES['product_image'];
    $productexpire_date = dataClean($productexpire_date);

    $messages = array();

    if (empty($product_category)) {
        $messages['product_category'] = "The product category should be select..!";
    }
    if (empty($batch_name)) {
        $messages['batch_name'] = "The product bacth id should be select..!";
    }
    if (empty($product_name)) {
        $messages['product_name'] = "The product name should not be empty..!";
    }
    if (empty($product_serialnumber)) {
        $messages['product_serialnumber'] = "The product serial number should not be empty..!";
    }
    if (!empty($product_serialnumber)) {

        $serialnumberlength = strlen($product_serialnumber);
        if ($serialnumberlength == 10 || $serialnumberlength == 12) {

        } else {
            $message['product_serialnumber'] = "The serial number length should 10 or 12!";
        }
    }
    if (empty($product_description)) {
        $messages['product_description'] = "The product description should not be empty..!";
    }
    if (empty($product_price)) {
        $messages['product_price'] = "The product price should not be empty..!";
    }
    if (empty($productexpire_date)) {
        $messages['productexpire_date'] = "The product expire date should be select..!";
    }
    if (!empty($product_name)) {
        $db = dbConn();
        $lower = strtolower($product_name);
        $sql = "SELECT * FROM  tbl_products WHERE product_name='$product_name'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $messages['product_name'] = "This product name is already in the database";
        }
    }
    if (!empty($product_serialnumber)) {
        $db = dbConn();
        $sql = "SELECT * FROM  tbl_products_serial_number WHERE product_serialnumber='$product_serialnumber'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $messages['product_serialnumber'] = "This product serial number is already in the database";
        }
    }
    if ($_FILES['product_image']['name'] != "") {
        $product_image = $_FILES['product_image'];
        $filename = $product_image['name'];
        $filetmpname = $product_image['tmp_name'];
        $filesize = $product_image['size'];
        $fileerror = $product_image['error'];
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
                    $file_name_new = uniqid('', true) . $product_name . '.' . $file_ext;
                    //directing file destination
                    $file_path = "../assets/images/products/" . $file_name_new;
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
        $lower = strtolower($product_name);
        $AddDate = date('y-m-d');
        $status = 1;
        $sql = "INSERT INTO tbl_products (batch_id,product_category_id,product_name,product_description,
        product_price, productadd_user, product_image, productadd_date, productexpire_date) VALUES ('$batch_name','$product_category','$lower','$product_description',
        '$product_price','$AddUser','$file_name_new','$AddDate','$productexpire_date')";

        $db->query($sql);

        $product_id = $db->insert_id;
        $sql1 = "INSERT INTO tbl_products_serial_number (product_id,product_category_id,batch_id,
        product_serialnumber) VALUES ('$product_id','$product_category','$batch_name','$product_serialnumber')";

        $db->query($sql1);
        echo "<script>
        Swal.fire({
            title: 'Added!',
            text: 'Added Successfully !.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'http://localhost/SMS/system/products/addproducts.php'; // Redirect to success page
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
            <h4 class="card-title">Products of the Salon</h4>
            <p class="card-description"> Add Salon Products </p>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <?php
                    $db = dbConn();
                    $sql2 = "SELECT * FROM  tbl_products_category";
                    $result2 = $db->query($sql2);
                    ?>
                    <label for="exampleInputName1">Select Product Category</label>
                    <select type="text" class="form-control" id="exampleInputName1" name="product_category">
                        <option value="">--</option>
                        <?php
                        while ($row = $result2->fetch_assoc()) {
                            ?>
                            <option value="<?= $row['product_category_id'] ?>"
                                <?= @$tbl_products_category == $row['product_category_id'] ? 'selected' : '' ?>>
                                <?= $row['product_category_name'] ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                    <span class="text-danger"><?= @$messages['product_category'] ?></span>
                </div>
                <div class="form-group">
                    <?php
                    $db = dbConn();
                    $sql3 = "SELECT * FROM  tbl_batches";
                    $result3 = $db->query($sql3);
                    ?>
                    <label for="exampleInputName1">Select Batch Category</label>
                    <select type="text" class="form-control" id="exampleInputName1" name="batch_name">
                        <option value="">--</option>
                        <?php
                        while ($row = $result3->fetch_assoc()) {
                            ?>
                            <option value="<?= $row['batch_id'] ?>" <?= @$tbl_batches == $row['batch_id'] ? 'selected' : '' ?>>
                                <?= $row['batch_name'] ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                    <span class="text-danger"><?= @$messages['batch_name'] ?></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Product Serial Number</label>
                    <input type="text" class="form-control" id="exampleInputName1" name="product_serialnumber"
                        value="<?= @$product_serialnumber ?>" placeholder="Enter the product serial number">
                    <span class="text-danger"><?= @$messages['product_serialnumber'] ?></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Product Name</label>
                    <input type="text" class="form-control" id="exampleInputName1" name="product_name"
                        value="<?= @$product_name ?>" placeholder="Enter the product name">
                    <span class="text-danger"><?= @$messages['product_name'] ?></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Product Description</label>
                    <input type="text" class="form-control" id="exampleInputName1" name="product_description"
                        value="<?= @$product_description ?>" placeholder="Enter the product description">
                    <span class="text-danger"><?= @$messages['product_description'] ?></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Product Price</label>
                    <input type="text" class="form-control" id="exampleInputName1" name="product_price"
                        value="<?= @$product_price ?>" placeholder="Enter the product price">
                    <span class="text-danger"><?= @$messages['product_price'] ?></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Product Expire Day</label>
                    <input type="date" class="form-control" id="exampleInputName1" name="productexpire_date"
                        value="<?= @$productexpire_date ?>" placeholder="Select the product expire date">
                    <span class="text-danger"><?= @$messages['productexpire_date'] ?></span>
                </div>
                <div class="form-group">
                    <label>Product Image</label><br>
                    <input type="file" name="product_image">
                </div>
                <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</div>
<div class="col-1 grid-margin stretch-card"></div>
<?php include '../footer.php'; ?>