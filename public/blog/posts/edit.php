<?php

require_once('../../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
    redirect_to(url_for('/index.php'));
}

$id = $_GET['id'];

if(is_post_request()) {

  $post = [];
  $post['id'] = $id;
  $post['cat_id'] = $_POST['cat_id'] ?? ''; 
  $post['topic'] = $_POST['topic'] ?? '';
  $post['body'] = $_POST['body'] ?? '';

  $result = update_post($post);

  if($result === true) {
    $_SESSION['message'] = 'The post was updated successfully.';
    redirect_to(url_for('/blog/posts/show.php?id=' . $id));
  } else {
    $errors = $result;
  }

} else {  
    $post = find_post_by_id($id);
}

?>

<?php $post_title = 'Edit Post'; ?>
<?php include(SHARED_PATH . '/blog_header.php'); ?>

<div id="content">

  <a id="back" class="back-link" href="<?php echo url_for('/index.php'); ?>">&laquo; Back to Post List</a>

  <div class="post edit">
    <h1>Edit Post</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/blog/posts/edit.php?id=' . h(u($id))); ?>" method="post">
    <dl>
      <dt>Category</dt>
      <dd>
        <select name="cat_id">
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
      <input id="submit" type="submit" value="Edit Post" />
    </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/blog_footer.php'); ?>
