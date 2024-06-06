<?php include '../menu.php'; ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Salon Products Details Table</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th> Product Category Name </th>
                                <th> Product Name </th>
                                <th> Product Description </th>
                                <th> Product Iamge </th>
                                <th> Product Price </th>
                                <th> Add User Name </th>
                                <th> Add Date </th>
                                <th> Expire Date </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_products";
                            $result = $db->query($sql);
                            ?>
                            <?php
                            if ($result->num_rows > 0) {
                                $i = 1;
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <?php
                                        $db = dbConn();
                                        $productcategoryname = $row['product_category_id'];
                                        $sql3 = "SELECT * FROM  tbl_products_category WHERE product_category_id='$productcategoryname'";
                                        $result3 = $db->query($sql3);
                                        $row3 = $result3->fetch_assoc()
                                            ?>
                                        <td><?= $row3['product_category_name'] ?> </td>
                                        <td><?= $row['product_name'] ?> </td>
                                        <td><?= $row['product_description'] ?> </td>
                                        <td class="py-1">
                                            <img src="../assets/images/products/<?= $row['product_image'] ?>" alt="image" />
                                        </td>
                                        <td><?= $row['product_price'] ?> </td>
                                        <?php
                                        $db = dbConn();
                                        $productadduser = $_SESSION['LogId'];
                                        $sql2 = "SELECT * FROM  tbl_staff WHERE staff_id='$productadduser'";
                                        $result2 = $db->query($sql2);
                                        $row2 = $result2->fetch_assoc()
                                            ?>
                                        <td><?= $row2['staff_firstname'] . ' ' . $row2['staff_lastname'] ?> </td>
                                        <td><?= $row['productadd_date'] ?> </td>
                                        <td><?= $row['productexpire_date'] ?> </td>
                                    </tr>
                                    <?php

                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../footer.php'; ?>