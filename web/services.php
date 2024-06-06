<?php
include 'header.php';
?>  
<main id="main">
    <!-- ======= Our Services Section ======= -->
    <section id="services-list" class="services-list">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Our Services</h2>

        </div>

        <div class="row gy-5">

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
        <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="icon flex-shrink-0"><img style="height: 4rem; width: 4rem; " src="<?= SYSTEM_PATH ?>assets/images/services/<?= $row['service_image'] ?>"></div>
            <div>
              <h4 class="title"><a href="#" class="stretched-link"><?= $row['service_name'] ?></a></h4>
              <p class="description"><?= $row['service_description'] ?></p>
            </div>
          </div>
          <?php 
                        }
                      }
          ?>
          <!-- End Service Item -->                                  
        </div>

      </div>
    </section><!-- End Our Services Section -->
</main>
<?php
include 'footer.php';
?> 
