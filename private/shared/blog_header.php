<?php
    if(!isset($post_title)) { $post_title = 'BLOG';}
?>

<!doctype html>

<html lang="en">
  <head>
    <title>ENVIVO - <?php echo h($post_title); ?></title>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheet/blog.css'); ?>">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheet/blog_index.css'); ?>">
  </head>

  <body>
    <div class="style">

    </div>

    <header>
      <h1>Sample Blog</h1>
    </header>

    <navigation>
        <ul>
            <li>User's email: <?php echo $_SESSION['email'] ?? ''; ?></li>
            <li><a href="<?php echo url_for('/blog/posts/index.php'); ?>">Menu</a></li>
            <li><a href="<?php echo url_for('/blog/logout.php'); ?>">Logout</a></li>
        </ul>
    </navigation>

    