<?php
include '../includes/db_connect.php';
include '../includes/functions.php';
session_start();

$title = 'Contact';
ob_start();
?>

<section class="section contact">

  <div class="row gy-4">

    <div class="col-xl-6">

      <div class="row">
        <div class="col-lg-6">
          <div class="info-box card">
            <i class="bi bi-geo-alt"></i>
            <h3>Address</h3>
            <p>A108 Adam Street,<br>New York, NY 535022</p>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="info-box card">
            <i class="bi bi-telephone"></i>
            <h3>Call Us</h3>
            <p>+1 5589 55488 55<br>+1 6678 254445 41</p>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="info-box card">
            <i class="bi bi-envelope"></i>
            <h3>Email Us</h3>
            <p>sonbim1999@gmail.com</p>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="info-box card">
            <i class="bi bi-clock"></i>
            <h3>Open Hours</h3>
            <p>Monday - Friday<br>9:00AM - 05:00PM</p>
          </div>
        </div>
      </div>

    </div>

    <div class="col-xl-6">
      <div class="card p-4">
        <h3 class="text-center">Send an email to us</h3>
        <form action="../mail/phpmailer.php" method="post" class="php-email-form">
          <div class="row gy-4">

            <div class="col-md-6">
              <input type="text" name="name" class="form-control" placeholder="Your Name" required>
            </div>

            <div class="col-md-6 ">
              <input type="email" class="form-control" name="email" placeholder="Your Email" required>
            </div>

            <div class="col-md-12">
              <input type="title" class="form-control" name="subject" placeholder="Subject" required>
            </div>

            <div class="col-md-12">
              <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
            </div>

            <div class="col-md-12 text-center">
              <div class="loading">Loading</div>
              

              <button type="submit">Send Message</button>
            </div>

          </div>
        </form>
      </div>

    </div>

  </div>

</section>

<?php

$output = ob_get_clean();
include '../index.html.php';
?>