<?php

if (!isset($_SESSION['user_id'])) {
  $user_id = null;
  $user_info = null;
  $userRole = null;
} else {
  $user_id = $_SESSION['user_id'];
  $user_info = getUserProfileInfo($user_id);
  $role_name = get_rolename_by_id($user_info['role_id']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>StackOverFlew</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="../index.php" class="logo d-flex align-items-center">
        <img src="../assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">StackOverFlew</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="GET" action="../read/question_lists.php">
        <input type="text" name="search_term" placeholder="Search" title="Enter search keyword" style="width: 800px;">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->




        <?php if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) : ?>
          <a class="btn btn-outline-primary" href="../users/user_registration.php">Register</a>
          <a class="btn btn-primary" href="../users/user_login.php">Login</a>
        <?php endif; ?>

        <li class="nav-item dropdown pe-3">
          <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) : ?>
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <?php
              // Check if the user has a profile image path stored in the database
              if (!empty($user_info['profile_image'])) {
                // Output the user's profile image with the dynamically generated source
                echo '<img src="' . $user_info['profile_image'] . '" alt="Profile" class="rounded-circle">';
              } else {
                // If the user does not have a profile image path, display a default image
                echo '<img src="../assets/img/profile/default_profile_image.jpg" alt="Profile" class="rounded-circle">';
              }
              ?>
              <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $user_info['username']; ?></span>
            </a><!-- End Profile Iamge Icon -->

            <!-- Your HTML code for the dropdown menu -->
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

              <li class="dropdown-header">
                <h6><?php echo $user_info['fullName']; ?></h6>
                <span><?php echo $role_name; ?></span>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center" href="../users/users-profile.php">
                  <i class="bi bi-person"></i>
                  <span>My Profile</span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center" href="../users/users-profile.php">
                  <i class="bi bi-gear"></i>
                  <span>Account Settings</span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center" href="../templates/pages-faq.html.php">
                  <i class="bi bi-question-circle"></i>
                  <span>Need Help?</span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li>
                <!-- Link to trigger the sign-out process -->
                <a class="dropdown-item d-flex align-items-center" href="../users/logout.php">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Sign Out</span>
                </a>
              </li>
            </ul><!-- End Profile Dropdown Items -->
          <?php endif; ?>
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <a class="nav-link collapsed" href="../index.php">
        <i class="bi bi-house"></i>
        <span>Home</span>
      </a>

      <a class="nav-link collapsed" href="../read/question_lists.php">
        <i class="bi bi-list"></i><span>All Questions</span><i class="bi bi-chevron ms-auto"></i>
      </a>
      <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) : ?>
        <a class="nav-link collapsed" href="../users/user_questions.php">
          <i class="bi bi-folder"></i><span>My Questions</span><i class="bi bi-chevron ms-auto"></i>
        </a>
      <?php endif; ?>

      <a class="nav-link collapsed" href="../create/ask_question.php">
        <i class="bi bi-question-square"></i><span>Ask a Question</span><i class="bi bi-chevron ms-auto"></i>
      </a>

      <a class="nav-link collapsed" href="../read/tags.php">
        <i class="bi bi-tags"></i><span>Tags</span><i class="bi bi-chevron ms-auto"></i>
      </a>

      <?php if ($user_info !== null && $user_info['role_id'] === 1) : ?>
        <a class="nav-link collapsed" href="../edit/manage.php">
          <i class="bi bi-people"></i><span>Manage</span><i class="bi bi-chevron ms-auto"></i>
        </a>
      <?php endif; ?>

      <!-- a -->
      <li class="nav-heading">Others</li>
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Pages</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li class="nav-item">
          <a class="nav-link collapsed" href="../templates/pages-faq.html.php">
            <i class="bi bi-circle"></i>
            <span>F.A.Q</span>
          </a>
        </li><!-- End F.A.Q Page Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="../templates/pages-contact.html.php">
            <i class="bi bi-circle"></i>
            <span>Contact</span>
          </a>
        </li><!-- End Contact Page Nav -->
      </ul>
      <!-- End Components Nav -->
      <?php if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) : ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="../users/user_registration.php">
            <i class="bi bi-card-list"></i>
            <span>Register</span>
          </a>
        </li><!-- End Register Page Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="../users/user_login.php">
            <i class="bi bi-box-arrow-in-right"></i>
            <span>Login</span>
          </a>
        </li><!-- End Login Page Nav -->
      <?php endif; ?>

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>
        <?= $title ?>
      </h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Top Questions -->
            <div class="col-12">
              <?php
              if (isset($_SESSION['success_message'])) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . htmlspecialchars($_SESSION['success_message']) . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                unset($_SESSION['success_message']); // Clear the message once displayed
              } elseif (isset($_SESSION['error_message'])) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . htmlspecialchars($_SESSION['error_message']) . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                unset($_SESSION['error_message']); // Clear the message once displayed
              }
              ?>
              <div>
                <?= $output ?>
              </div>
            </div><!-- End Top Selling -->
          </div>
        </div>

        <!-- Right side columns -->
        <div class="col-lg-4">

          <!-- Recent Activity -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Recent Activity <span>| Today</span></h5>

              <div class="activity">
                <?php
                // Sort the questions array
                $questions = sortQuestions($questions);

                // Limit the array to 5 most recent questions
                $recentQuestions = array_slice($questions, 0, 5);

                // Iterate over the limited questions
                foreach ($recentQuestions as $question) : ?>
                  <div class="activity-item d-flex">
                    <div class="activite-label"><?php echo calculateTimeLabel($question['created_at']); ?></div>
                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                    <div class="activity-content">
                      <a class="fw-bold text-dark" href="../read/questions.php?question_id=<?php echo $question['question_id']; ?>"><?php echo $question['title']; ?></a>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div><!-- End Recent Activity -->
        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>StackOverFlew</span></strong>. All Rights Reserved
    </div>
    <div class="credits">

      Designed by SB</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>