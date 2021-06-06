<?php require_once('../private/initialize.php'); ?>

<?php 
require_login();

$post_set = find_all_posts();

?>

<?php $post_title = 'Show Posts'; ?>
<?php include(SHARED_PATH . '/blog_header.php'); ?>

<div id="content">
    <div class="posts" id="listing">
        <h1>Posts</h1>

        <div class="actions">
            <a class="action" href="<?php echo url_for('/blog/posts/new.php'); ?>">Create New Post</a>
        </div>

        <?php echo display_session_message(); ?>

            <div class="single_post">
                <?php while($post = mysqli_fetch_assoc($post_set)) { ?>
                    <div id="post_card">
                        <h1><?php echo ucwords(h($post['topic'])); ?></h1>
                        <p>Date created: <?php echo date('d-m-Y', strtotime((h($post['date_created'])))); ?></p>
                        <div id="card_info">
                            <span><a class="action" href="<?php echo url_for('/blog/posts/show.php?id=' . h(u($post['id']))); ?>">View</a></span>
                            <span><a class="action" href="<?php echo url_for('/blog/posts/edit.php?id=' . h(u($post['id']))); ?>">Edit</a></span>
                            <span><a class="action" href="<?php echo url_for('/blog/posts/delete.php?id=' . h(u($post['id']))); ?>">Delete</a></span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <?php 
            mysqli_free_result($post_set);
        ?>
    </div>

</div>

<?php include(SHARED_PATH . '/blog_footer.php'); ?>