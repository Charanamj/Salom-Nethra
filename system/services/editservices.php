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
                                <th> Service Category ID </th>
                                <th> Service Name </th>
                                <th> Service Description </th>
                                <th> Service Price </th>
                                <th> Service Image </th>
                                <th> Status </th>
                                <th> Change Status </th>
                                <th> Delete </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_services";
                            $result = $db->query($sql);
                            ?>
                            <?php
                            if ($result->num_rows > 0) {
                                $i = 1;
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?= $row['service_category_id'] ?> </td>
                                        <td><?= $row['service_name'] ?> </td>
                                        <td><?= $row['service_description'] ?> </td>
                                        <td><?= $row['service_price'] ?> </td>
                                        <td class="py-1">
                                            <img src="../assets/images/services/<?= $row['service_image'] ?>" alt="image" />
                                        </td>
                                        <td>
                                            <?php
                                            if ($row['service_status'] == 1) {
                                                echo "<span class='primary' style='color: green;'>Activate</span>";
                                            } else {
                                                echo "<span class='primary' style='color: red;'>Inactivate</span>";
                                            }
                                            ?>

                                        </td>
                                        <td>
                                            <?php
                                            if ($row['service_status'] == 1) { ?>
                                                <form method="post" action="activateservice.php">
                                                    <input type="hidden" name="service_category_id"
                                                        value="<?= $row['service_category_id'] ?>">
                                                    <button type="submit" name="action" value="deactivate"
                                                        class="btn btn-danger">Deactivate</button>
                                                </form>
                                            <?php
                                            } else { ?>
                                                <form method="post" action="deactivateservice.php">
                                                    <input type="hidden" name="service_category_id"
                                                        value="<?= $row['service_category_id'] ?>">
                                                    <button type="submit" name="action" value="activate"
                                                        class="btn btn-primary">Activate</button>
                                                </form>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td>                                                                                    
                                           <form method="post" action="deleteservice.php">
                                                <input type="hidden" name="service_id"
                                                value="<?= $row['service_id'] ?>">
                                                <button type="submit" name="action" value="delete"
                                                class="btn btn-danger">Delete</button>
                                            </form>                                    
                                        </td>
                                    </tr>
                                  <?php
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
                    <?php
                    extract($_GET);
                    if (isset($status) && @$status == 'delete') {


                        echo "<script>
Swal.fire({
    title: 'Deleted!',
    text: 'Deleted Successfully !.',
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