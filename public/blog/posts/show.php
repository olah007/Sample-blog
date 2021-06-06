<?php require_once('../../../private/initialize.php'); ?>

<?php 
require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/index.php'));
}
$id = $_GET['id'];

$post = find_post_by_id($id);
$category = find_category_by_id($post['cat_id']);

?>

<?php $post_title = 'Show Post'; ?>
<?php include(SHARED_PATH . '/blog_header.php'); ?>

<div id="content">

  <a id="back" class="back-link" href="<?php echo url_for('/index.php'); ?>">&laquo; Back to Post List</a>

  <?php echo display_session_message(); ?>

  <div class="post show">
  
  <h1>Post: <?php echo ucwords(h($post['topic'])); ?></h1>

  <div class="attributes " id="show">  
    <dl>
      <dt>Category</dt>
      <dd><?php echo ucwords(h($category['name'])); ?></dd>
    </dl>
    <dl>
      <dt>Post's Title</dt>
      <dd><?php echo ucwords(h($post['topic'])); ?></dd>
    </dl> 
    <dl>
      <dt>Date Created</dt>
      <dd><?php echo date('l jS \of F Y', strtotime((h($post['date_created'])))); ?></dd>
    </dl>
    <dl>
      <dt>Body</dt>
      <dd><?php echo ucfirst(h($post['body'])); ?></dd>
    </dl>
  </div>

  </div>

</div>

<?php include(SHARED_PATH . '/blog_footer.php'); ?>