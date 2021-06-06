<?php

require_once('../../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

  $result = delete_post($id);
  $_SESSION['message'] = 'The page was deleted successfully.';
  redirect_to(url_for('/index.php'));

} else {
    $post = find_post_by_id($id);
}

?>

<?php $post_title = 'Delete Post'; ?>
<?php include(SHARED_PATH . '/blog_header.php'); ?>

<div id="content">

  <a id="back" class="back-link" href="<?php echo url_for('/blog/posts/index.php'); ?>">&laquo; Back to Post List</a>

  <div class="post delete">
    <h1>Delete Post</h1>
    <p>Are you sure you want to delete this post?</p>
    <p class="item"><?php echo h($post['topic']); ?></p>

    <form action="<?php echo url_for('/blog/posts/delete.php?id=' . h(u($post['id']))); ?>" method="post">
      <div id="operations">
        <input id="submit" type="submit" name="commit" value="Delete Post" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/blog_footer.php'); ?>
