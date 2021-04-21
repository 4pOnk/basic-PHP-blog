<?php
    require 'components/header.php';
    $post_id = $_GET['post'];
    $post = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM `posts` WHERE `id` = $post_id "));
    $comments = mysqli_fetch_array(mysqli_query($connection,"SELECT COUNT(`id`) FROM `comments` WHERE `post_id` = $post_id"));
    $date_str = strtotime($post['pub_time']);
    $pub_time = date('d F Y', $date_str);
    $post_author_id = $post['author_id'];
    $post_author = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM `users` WHERE `id` = $post_author_id"));
?>
				<!-- Main -->
					<div id="main">

						<!-- Post -->
							<article class="post">
								<header>
									<div class="title">
										<h2><a href="#"><?= $post['name'] ?></a></h2>
										<p><?= $post['subtitle'] ?></p>
									</div>
									<div class="meta">
										<time class="published" datetime="2015-11-01"><?= $pub_time ?></time>
										<a href="#" class="author"><span class="name"><?= $post_author['name'] ?></span><img src="<?= $post_author['image'] ?>" alt="" /></a>
									</div>
								</header>
								<span class="image featured"><img src="<?= $post['image'] ?>" alt="" /></span>
                                <p><?= $post['content'] ?></p>
								<footer>
									<ul class="stats">

                                        <?php if($_SESSION['user'] == $post_author_id || $_SESSION['user'] == 1):?>
										<li><a href="/update.php?post=<?= $post_id ?>">Edit</a></li>
                                        <?php endif; ?>
                                        <?php if($_SESSION['user'] == 1): ?>
										<li><a href="include/delete_post.php?post=<?= $post_id ?>" class="red">Delete</a></li>
										<li><a href="include/block_user.php?id=<?= $post_author_id ?>&post=<?= $post_id ?>" class="red">Blocked</a></li>
                                        <?php endif; ?>
										<li><a href="like.php?post=<?= $post_id ?>" class="<?php if ($_COOKIE['like_' . $_SESSION['user'] . '_' . $post_id]) echo 'liked'?> icon fa-heart"><?= $post['likes'] ?></a></li>
										<li><a href="#" class="icon fa-comment"><?= $comments[0] ?></a></li>
									</ul>
								</footer>
							</article>

						<!-- Comments -->
							<div class="post">
                                <?php if($_SESSION['user']): ?>
								<section class="comments">
									<h3>Comments</h3>
                                    <h3 style="color: darkred"><?php echo $_SESSION['comm_msg']; unset($_SESSION['comm_msg'])?></h3>
									<form action="include/add_comment.php?post=<?= $post['id'] ?>" method="post">
										<textarea name="text"></textarea><br>
										<input type="submit" class="button big fit" value="Add Comment">
									</form>
								</section>
                                <?php
                                    $comments_req = mysqli_query($connection,"SELECT * FROM `comments` WHERE `post_id` = $post_id");
                                    while($comment = mysqli_fetch_assoc($comments_req)){
                                        $comment_author_id = $comment['author_id'];
                                        $comment_author = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM `users` WHERE `id` = $comment_author_id"))
                                ?>
								<article class="comment">
									<div class="comment-autor">
										<a href="user.php?id=<?= $comment_author_id ?>"><img src="<?= $comment_author['image'] ?>"></a>
										<a href="user.php?id=<?= $comment_author_id ?>"><?= $comment_author['login'] ?></a>
									</div>
									<p><?= $comment['text'] ?></p>
								</article>
                                <?php } ?>
                                <?php endif; ?>
							</div>

					</div>

				<!-- Footer -->
					<section id="footer">
						<p class="copyright">&copy; Untitled. Design: <a href="http://html5up.net">HTML5 UP</a>.</p>
					</section>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>