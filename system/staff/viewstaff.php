<?php include '../menu.php'; ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Staff Member Details Table</h4>
                    </p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th> Staff Title </th>
                                <th> Staff Designation </th>
                                <th> First Name </th>
                                <th> Last Name </th>
                                <th> Staff ID Number </th>
                                <th> Staff Email </th>
                                <th> Staff Image </th>
                                <th> Status </th>
                                <th> Change Status </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_staff";
                            $result = $db->query($sql);
                            ?>
                            <?php
                            if ($result->num_rows > 0) {
                                $i = 1;
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?= $row['staff_title'] ?> </td>
                                        <td><?= $row['staff_designation'] ?> </td>
                                        <td><?= $row['staff_firstname'] ?> </td>
                                        <td><?= $row['staff_lastname'] ?> </td>
                                        <td><?= $row['staff_idnum'] ?> </td>
                                        <td><?= $row['staff_email'] ?> </td>
                                        <td class="py-1">
                                            <img src="../assets/images/staff/<?= $row['staff_image'] ?>" alt="image" />
                                        </td>
                                        <td>
                                            <?php
                                            if ($row['staff_status'] == 1) {
                                                echo "<span class='primary' style='color: green;'>Activate</span>";
                                            } else {
                                                echo "<span class='primary' style='color: red;'>Inactivate</span>";
                                            }
                                            ?>

                                        </td>
                                        <td>
                                            <?php
                                            if ($row['staff_status'] == 1) { ?>
                                                <form method="post" action="activatestaff.php">
                                                    <input type="hidden" name="staff_id" value="<?= $row['staff_id'] ?>">
                                                    <button type="submit" name="action" value="deactivate" class="btn btn-danger">Deactivate</button>
                                                </form>
                                                <?php                                                                                    
                                            } else { ?>
                                                <form method="post" action="deactivatestaff.php">
                                                    <input type="hidden" name="staff_id" value="<?= $row['staff_id'] ?>">
                                                    <button type="submit" name="action" value="activate" class="btn btn-primary">Activate</button>
                                                </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                    extract($_GET);
                    if (isset($status) && @$status == 'deactivate') {


                        echo "<script>
Swal.fire({
    title: 'Activated!',
    text: 'activated Successfully !.',
    icon: 'success',
    confirmButtonText: 'OK'
});
</script>";
                    }
                    if (isset($status) && @$status == 'activate') {


                        echo "<script>
    Swal.fire({
        title: 'Deactivated!',
        text: 'Deactivated Successfully !.',
        icon: 'success',
        confirmButtonText: 'OK'
    });
    </script>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>







<?php include '../footer.php'; ?>