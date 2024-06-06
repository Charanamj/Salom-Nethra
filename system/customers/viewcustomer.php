<?php include '../menu.php'; ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Customer Details Table</h4>
                    </p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th> Customer Title </th>                               
                                <th> Customer Gender </th>
                                <th> Customer First Name </th>
                                <th> Customer Last Name </th>
                                <th> Customer ID Number </th>
                                <th> Customer Email </th>
                                <th> Customer Mobile Number </th>
                                <th> Customer Image </th>
                                <th> Status </th>
                                <th> Change Status </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_customers";
                            $result = $db->query($sql);
                            ?>
                            <?php
                            if ($result->num_rows > 0) {
                                $i = 1;
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?= $row['customer_title'] ?> </td>
                                        <td><?= $row['customer_gender'] ?> </td>
                                        <td><?= $row['customer_firstname'] ?> </td>
                                        <td><?= $row['customer_lastname'] ?> </td>
                                        <td><?= $row['customer_nic'] ?> </td>
                                        <td><?= $row['customer_email'] ?> </td>
                                        <td><?= $row['customer_mobilenumber'] ?> </td>
                                        <td class="py-1">
                                            <img src="<?= SYSTEM_PATHS ?>assets/img/customers/<?= $row['customer_image'] ?>" alt="image" />
                                        </td>
                                        <td>
                                            <?php
                                            if ($row['customer_status'] == 1) {
                                                echo "<span class='primary' style='color: green;'>Activate</span>";
                                            } else {
                                                echo "<span class='primary' style='color: red;'>Inactivate</span>";
                                            }
                                            ?>

                                        </td>
                                        <td>
                                            <?php
                                            if ($row['customer_status'] == 1) { ?>
                                                <form method="post" action="activatecustomer.php">
                                                    <input type="hidden" name="customer_id" value="<?= $row['customer_id'] ?>">
                                                    <button type="submit" name="action" value="deactivate" class="btn btn-danger">Deactivate</button>
                                                </form>
                                                <?php                                                                                    
                                            } else { ?>
                                                <form method="post" action="deactivatecustomer.php">
                                                    <input type="hidden" name="customer_id" value="<?= $row['customer_id'] ?>">
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
    text: 'Activated Successfully !.',
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