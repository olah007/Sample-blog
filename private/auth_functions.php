<?php

  // Performs all actions necessary to log in an admin
  function log_in_admin($admin) {
  // Regenarating the ID protects the admin from session fixation.
    session_regenerate_id();
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['last_login'] = time();
    $_SESSION['email'] = $admin['email'];

    return true;
  }

  // Performs all actions necessary to log out an admin
  function log_out_admin() {
    unset($_SESSION['admin_id']);
    unset($_SESSION['last_login']);
    unset($_SESSION['email']);
    return true;
  }

  // is_logged_in() contains all the logic for determining if a
  // request should be considered a "logged in" request or not.
  function is_logged_in() {
    return isset($_SESSION['admin_id']);
  }

  // Call require_login() at the top of any page which needs to
  // require a valid login before granting acccess to the page.
  function require_login() {
    if(!is_logged_in()) {
      redirect_to(url_for('/blog/login.php'));
    } else {
      // Do nothing, let the rest of the page proceed
    }
  }

?>
