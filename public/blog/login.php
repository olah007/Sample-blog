<?php
require_once('../../private/initialize.php');

$errors = [];
$email = '';
$password = '';

if(is_post_request()) {

  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';

  // Validations
  if(is_blank($email)) {
    $errors[] = "Email cannot be blank.";
  }

  if(is_blank($password)) {
    $errors[] = "Password cannot be blank.";
  }

  // If there were no errors, try to login
  if(empty($errors)) {
    // Using one variable ensures that msg is the same
    $login_failure_msg = "Login was unsuccessful.";
    
    $admin = find_admin_by_email($email);

    if($admin) {
      
      if($password === $admin['password']) {
        // Password matches
        log_in_admin($admin);
        redirect_to(url_for('/index.php'));
      } else {
        // Username found, but password does not match
        $errors[] = $login_failure_msg;
      }

    } else {
      // no username found
      $errors[] = $login_failure_msg;
    }

  }
}

?>

<?php $post_title = 'Log in'; ?>
<?php include(SHARED_PATH . '/blog_header.php'); ?>

<div id="content">

  <div class="login">
    <h1>Log in</h1>

    <?php echo display_errors($errors); ?>

    <form action="login.php" method="post">
      User's email:<br />
      <input type="text" name="email" value="<?php echo h($email); ?>" /><br />
      Password:<br />
      <input type="password" name="password" value="" /><br />
      <input id="submit" type="submit" name="submit" value="Submit"  />
    </form>
    
  </div>
  

</div>

<?php include(SHARED_PATH . '/blog_footer.php'); ?>
