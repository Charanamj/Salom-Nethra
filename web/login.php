<?php
include 'header.php';
?>
<main id="main">
   <!-- ======= Contact Us Section ======= -->
   <section>
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Log in</h2>
          <p>Log in From Here</p>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
            <div class="form-group mt-3">
                            <label for="name">User Name</label>
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name">Password</label>
                            <input type="password" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                        </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Us Section -->
</main>

<?php
include 'footer.php';
?>