<?php

require_once('../../../private/initialize.php');

require_login();

if(is_post_request()) {

  $post = [];
  $post['cat_id'] = $_POST['cat_id'] ?? ''; 
  $post['topic'] = $_POST['topic'] ?? '';
  $post['body'] = $_POST['body'] ?? '';

  $result = insert_post($post);

  if($result === true) {
    $new_id = mysqli_insert_id($db);
    $_SESSION['message'] = 'The post was created successfully.';
    redirect_to(url_for('/blog/posts/show.php?id=' . $new_id));    
  } else {
      $errors = $result;  
  }

} else {
    $post = [];
    $post['cat_id'] = $_GET['cat_id'] ?? '1'; 
    $post['topic'] = '';
    $post['body'] = '';
}

?>

<?php $post_title = 'Create post'; ?>
<?php include(SHARED_PATH . '/blog_header.php'); ?>

<div id="content">

  <a id="back" class="back-link" href="<?php echo url_for('/index.php'); ?>">&laquo; Back to Post List</a>

  <div class="post new">
    <h1>Create post</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/blog/posts/new.php') ?>" method="post">
    <dl>
      <dt>Category</dt>
      <dd>
        <select name="cat_id" >
          <?php 
            $category_set = find_all_categories();
            while($category = mysqli_fetch_assoc($category_set)) {
              echo "<option value=\"" . h($category['id']) . "\"";
              if($post["cat_id"] == $category['id']) {
                echo " selected";
              }
              echo ">" . h($category['name']) . "</option>";
            }
            mysqli_free_result($category_set);
          ?>
        </select>
      </dd>
    </dl>
    <dl>
      <dt>Topic</dt>
      <dd><input type="text" name="topic" value="<?php echo ucwords(h($post['topic'])) ; ?>" /></dd>
    </dl>
    <dl>
      <dt>Body</dt>
      <dd>
        <textarea name="body" cols="60" rows="10"><?php echo ucfirst(h($post['body'])) ; ?></textarea>
      </dd>
    </dl>
    <div id="operations">
      <input id="submit" type="submit" value="Create post" />
    </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/blog_footer.php'); ?>
