<?php 
include '../menu.php'; 
include '../assets/phpmail/mail.php';
?>


<?php
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  extract($_POST);
  $staff_title = dataClean($staff_title);
  $staff_gender = dataClean($staff_gender);
  $staff_designation = dataClean($staff_designation);
  $staff_firstname = dataClean($staff_firstname);
  $staff_lastname = dataClean($staff_lastname);
  $staff_idnum = dataClean($staff_idnum);
  $staff_addressline1 = dataClean($staff_addressline1);
  $staff_addressline2 = dataClean($staff_addressline2);
  $staff_email = dataClean($staff_email);
  $staff_telno = dataClean($staff_telno);
  $staff_description = dataClean($staff_description);
  $staff_image = $_FILES['staff_image'];
  $staff_username = dataClean($staff_username);
  $staff_password = dataClean($staff_password);
  $staff_cpassword = dataClean($staff_cpassword);

  $messages = array();

  if (empty($staff_title)) {
    $messages['staff_title'] = "The staff title should be select..!";
  }
  if (empty($staff_gender)) {
    $messages['staff_gender'] = "The gender should be select..!";
  }
  if (empty($staff_designation)) {
    $messages['staff_designation'] = "The designation should be select..!";
  }
  if (empty($staff_firstname)) {
    $messages['staff_firstname'] = "The staff first name should not be empty..!";
  }
  if (empty($staff_lastname)) {
    $messages['staff_lastname'] = "The staff last name should not be empty..!";
  }
  if (empty($staff_idnum)) {
    $messages['staff_idnum'] = "The ID Number should not be empty..!";
  }
  if (empty($staff_addressline1)) {
    $messages['staff_addressline1'] = "The address line 1 should not be empty..!";
  }
  if (empty($staff_addressline2)) {
    $messages['staff_addressline2'] = "The address line 2 should not be empty..!";
  }
  if (empty($staff_email)) {
    $messages['staff_email'] = "The email should not be empty..!";
  }
  if (empty($staff_telno)) {
    $messages['staff_telno'] = "The telephone number should not be empty..!";
  }
  if (empty($staff_description)) {
    $messages['staff_description'] = "The description should not be empty..!";
  }

  if (empty($staff_username)) {
    $messages['staff_username'] = "The username should not be empty..!";
  }

  if (!empty($staff_idnum)) {

    $niclength = strlen($staff_idnum);
    if ($niclength == 10 || $niclength == 12) {

    } else {
      $messages['staff_idnum'] = "The NIC  length should 10 or 12!";
    }
  }

  if (!empty($staff_idnum)) {
    $db = dbConn();
    $sql = "SELECT * FROM  tbl_staff WHERE staff_idnum='$staff_idnum'";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
      $messages['staff_idnum'] = "This ID number is already in the database";
    }
  }

  if (!empty($staff_username)) {
    $db = dbConn();
    $sql = "SELECT * FROM  tbl_staff WHERE staff_username='$staff_username'";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
      $messages['staff_username'] = "This username is already in the database";
    }
  }
  
  if (!empty($staff_email)) {
    $db = dbConn();
    $sql = "SELECT * FROM  tbl_staff WHERE staff_email='$staff_email'";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
      $messages['staff_email'] = "This email is already in the database";
    }
  }
  if (!empty($staff_email)) {
    if (!filter_var($staff_email, FILTER_VALIDATE_EMAIL)) {
      $messages['staff_email'] = "The email is not well formatted..!";
    }
  }
  if ($_FILES['staff_image']['name'] != "") {
    $staff_image = $_FILES['staff_image'];
    $filename = $staff_image['name'];
    $filetmpname = $staff_image['tmp_name'];
    $filesize = $staff_image['size'];
    $fileerror = $staff_image['error'];
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
          $file_name_new = uniqid('', true) . $staff_username . '.' . $file_ext;
          //directing file destination
          $file_path = "../assets/images/staff/" . $file_name_new;
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
  if (empty($staff_password)) {
    $messages['staff_password'] = "The password should not be empty..!";
  }
  if (empty($staff_cpassword)) {
    $messages['staff_cpassword'] = "The confirm password should not be empty..!";
  }
  if (!empty($staff_password)) {
    $uppercase = preg_match('@[A-Z]@', $staff_password);
    $lowercase = preg_match('@[a-z]@', $staff_password);
    $number = preg_match('@[0-9]@', $staff_password);
    $specialChars = preg_match('@[^\w]@', $staff_password);
    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($staff_password) < 8) {
      $messages['staff_password'] = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character";
    }
    if ((!empty($staff_password)) && (!empty($staff_cpassword))) {
      if ($staff_password != $staff_cpassword) {
        $messages['staff_password'] = " Passwords are not match";
      }
    }


    if (empty($messages)) {
      $db = dbConn();
      $AddDate = date('y-m-d');
      $status = 1;
      $staff_verification = rand(100000, 999999);
      $_SESSION['SNO'] = $staff_verification;
      $newpsw = sha1($staff_password);
      $sql = "INSERT INTO tbl_staff (staff_title, staff_gender, staff_designation, staff_firstname, 
      staff_lastname, staff_idnum, staff_addressline1, staff_addressline2, staff_email, staff_telno, staff_description,
       staff_image, staff_username, staff_password, staff_verification) VALUES ('$staff_title','$staff_gender','$staff_designation',
       '$staff_firstname','$staff_lastname','$staff_idnum','$staff_addressline1','$staff_addressline2','$staff_email',
       '$staff_telno','$staff_description','$file_name_new','$staff_username','$newpsw','$staff_verification')";

      $db->query($sql);
      $regstaff_id = $db->insert_id;             
      $_SESSION['regstaff_id'] = $regstaff_id;

      $to = $staff_email;
      $toname = $staff_firstname . $staff_lastname;
      $subject = 'Verification of the User';
      $body = "<h1>Welcome to the Salon Nethra</h1> <p>Your Account has been successfully created</p> <p>Verification Code is:</p> <h1>" . $staff_verification . "</h1> <a href='http://localhost/SMS/system/staff/registersuccess_staff.php'>Click here to verify your account</a>";
      $alt = 'User Registration';
      send_email($to, $toname, $subject, $body, $alt);
    }
  }
}
?>

<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Salon Staff</h4>
      <p class="card-description"> Add Salon Staff </p>
      <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="exampleInputName1">Staff Member Title</label>
          <select type="text" class="form-control" id="exampleInputName1" name="staff_title"
            value="<?= @$staff_title ?>">
            <option value="">- -</option>
            <option value="Mr" <?php
            if (@$Title == "Mr") {
              echo "selected";
            }
            ?>>Mr.</option>
            <option value="Mrs" <?php
            if (@$Title == "Mrs") {
              echo "selected";
            }
            ?>>Mrs.</option>
            <option value="Miss" <?php
            if (@$Title == "Miss") {
              echo "selected";
            }
            ?>>Miss.</option>
          </select>
          <span class="text-danger"><?= @$messages['staff_title'] ?></span>
        </div>
        <div class="form-group">
          <label for="exampleInputName1">Gender</label>
          <select type="text" class="form-control" id="exampleInputName1" name="staff_gender"
            value="<?= @$staff_gender ?>">
            <option value="">- -</option>
            <option value="Male" <?php
            if (@$Title == "Male") {
              echo "selected";
            }
            ?>>Male</option>
            <option value="Female" <?php
            if (@$Title == "Female") {
              echo "selected";
            }
            ?>>Female</option>
          </select>
          <span class="text-danger"><?= @$messages['staff_gender'] ?></span>
        </div>

        <div class="form-group">
          <?php
          $db = dbConn();
          $sql = "SELECT * FROM  designation";
          $result = $db->query($sql);
          ?>
          <label for="exampleInputName1">Staff Member Designation</label>
          <select type="text" class="form-control" id="exampleInputName1" name="staff_designation">
            <option value="">--</option>
            <?php
            while ($row = $result->fetch_assoc()) {
              ?>
              <option value="<?= $row['designation_id'] ?>" <?= @$designation == $row['designation_id'] ? 'selected' : '' ?>>
                <?= $row['designation_id'] . " " . $row['designation_name'] ?>
              </option>
              <?php
            }
            ?>
          </select>
          <span class="text-danger"><?= @$messages['staff_designation'] ?></span>
        </div>

        <div class="form-group">
          <label for="exampleInputName1">First Name</label>
          <input type="text" class="form-control" id="exampleInputName1" name="staff_firstname"
            value="<?= @$staff_firstname ?>" placeholder="Enter the First Name">
          <span class="text-danger"><?= @$messages['staff_firstname'] ?></span>
        </div>

        <div class="form-group">
          <label for="exampleInputName1">Last Name</label>
          <input type="text" class="form-control" id="exampleInputName1" name="staff_lastname"
            value="<?= @$staff_lastname ?>" placeholder="Enter the Last Name">
          <span class="text-danger"><?= @$messages['staff_lastname'] ?></span>
        </div>

        <div class="form-group">
          <label for="exampleInputName1">ID Number</label>
          <input type="text" class="form-control" id="exampleInputName1" name="staff_idnum" value="<?= @$staff_idnum ?>"
            placeholder="Enter the ID Number">
          <span class="text-danger"><?= @$messages['staff_idnum'] ?></span>
          <span class="text-danger"><?= @$messages['staff_idnums'] ?></span>
        </div>

        <div class="form-group">
          <label for="exampleInputName1">Address Line 1</label>
          <input type="text" class="form-control" id="exampleInputName1" name="staff_addressline1"
            value="<?= @$staff_addressline1 ?>" placeholder="Enter the Address Line 1">
          <span class="text-danger"><?= @$messages['staff_addressline1'] ?></span>
        </div>

        <div class="form-group">
          <label for="exampleInputName1">Address Line 2</label>
          <input type="text" class="form-control" id="exampleInputName1" name="staff_addressline2"
            value="<?= @$staff_addressline2 ?>" placeholder="Enter the Address Line 2">
          <span class="text-danger"><?= @$messages['staff_addressline2'] ?></span>
        </div>

        <div class="form-group">
          <label for="exampleInputName1">Email Address</label>
          <input type="text" class="form-control" id="exampleInputName1" name="staff_email" value="<?= @$staff_email ?>"
            placeholder="Enter the email address">
          <span class="text-danger"><?= @$messages['staff_email'] ?></span>
        </div>

        <div class="form-group">
          <label for="exampleInputName1">Mobile Number</label>
          <input type="text" class="form-control" id="exampleInputName1" name="staff_telno" value="<?= @$staff_telno ?>"
            placeholder="Enter the telephone Number">
          <span class="text-danger"><?= @$messages['staff_telno'] ?></span>
        </div>

        <div class="form-group">
          <label for="exampleInputName1">Enter the desription</label>
          <input type="text" class="form-control" id="exampleInputName1" name="staff_description"
            value="<?= @$staff_description ?>" placeholder="Enter a description about the member">
          <span class="text-danger"><?= @$messages['staff_description'] ?></span>
        </div>

        <div class="form-group">
          <label for="exampleInputName1">Enter a User Name</label>
          <input type="text" class="form-control" id="exampleInputName1" name="staff_username"
            value="<?= @$staff_username ?>" placeholder="Enter a user name ">
          <span class="text-danger"><?= @$messages['staff_username'] ?></span>
        </div>

        <div class="form-group">
          <label for="exampleInputName1">Enter a Password</label>
          <input type="password" class="form-control" id="exampleInputName1" name="staff_password"
            value="<?= @$staff_password ?>" placeholder="Enter a password ">
          <span class="text-danger"><?= @$messages['staff_password'] ?></span>
        </div>

        <div class="form-group">
          <label for="exampleInputName1">Confirm Password</label>
          <input type="password" class="form-control" id="exampleInputName1" name="staff_cpassword"
            value="<?= @$staff_cpassword ?>" placeholder="reenter the password ">
          <span class="text-danger"><?= @$messages['staff_cpassword'] ?></span>
        </div>

        <div class="form-group">
          <label>Staff Member Image</label><br>
          <input type="file" name="staff_image" value="<?= @$file_name_new ?>">
          <span class="text-danger"><?= @$messages['staff_image'] ?></span>
        </div>

        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
        <button class="btn btn-light">Cancel</button>
      </form>
    </div>
  </div>
</div>
<?php include '../footer.php'; ?>