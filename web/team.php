<?php
include 'header.php';
?>
<section id="recent-posts" class="recent-posts">
    <div class="container" data-aos="fade-up">

        <div class="section-header">
            <h2>Our Team</h2>
        </div>

        <div class="row gy-5">
            <?php
            $db = dbConn();
            $sql = "SELECT * FROM `tbl_staff` INNER JOIN designation ON tbl_staff.staff_designation = designation.designation_id";
            $result = $db->query($sql);
            ?>
            <?php
            if ($result->num_rows > 0) {
                $i = 1;
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="post-box">
                            <div class="post-img"><img src="<?= SYSTEM_PATH ?>assets/images/staff/<?= $row['staff_image'] ?>">
                            </div>
                            <div class="meta">
                            <span class="post-date"><?= $row['staff_title'] ?></span>                          
                                <span class="post-date"><?= $row['staff_username'] ?></span>
                            </div>
                            <h3 class="post-title"><?= $row['designation_name'] ?></h3>
                            <p><?= $row['staff_description']?></p>
                            <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                        <?php
                }
            }
            ?>
            </div>
        </div>
    </div>
</section>
<?php
include 'footer.php';
?>