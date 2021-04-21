<?php
    include './components/header.php'
?>
				<!-- Main -->
					<div id="main">

						<!-- Post -->
                        <?php
                        $pagination = $settings['pagination'];
                        $page = $_GET['page'];
                        if($page == ''){
                            $page = 0;
                        }
                        $offset = $page * $pagination;

                        $post_req = mysqli_query($connection, "SELECT * FROM `posts` ORDER BY `id` DESC LIMIT $pagination OFFSET $offset");
                        $total_posts = mysqli_num_rows($post_req);
                            while($post = mysqli_fetch_assoc($post_req)){
                                $post_id = $post['id'];
                                $comments = mysqli_fetch_array(mysqli_query($connection,"SELECT COUNT(`id`) FROM `comments` WHERE `post_id` = $post_id"));
                                $date_str = strtotime($post['pub_time']);
                                $pub_time = date('d F Y', $date_str);
                                $post_author_id = $post['author_id'];
                                $post_author = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM `users` WHERE `id` = $post_author_id"));
                                ?>
							<article class="post">
								<header>
									<div class="title">
										<h2><a href="/single.php?post=<?= $post_id ?>"><?= $post['name'] ?></a></h2>
										<p><?= $post['subtitle'] ?></p>
									</div>
									<div class="meta">
										<time class="published" datetime="2015-11-01"><?= $pub_time ?></time>
										<a href="/user.php?id=<?= $post_id ?>" class="author"><span class="name"><?= $post_author['name'] ?></span><img src="<?= $post_author['image'] ?>" alt="" /></a>
									</div>
								</header>
								<a href="/single.php?post=<?= $post_id ?>" class="image featured"><img src="<?= $post['image'] ?>" alt="" /></a>
                                <p><?= $post['anons'] ?></p>
								<footer>
									<ul class="actions">
										<li><a href="/single.php?post=<?= $post_id ?>" class="button big">Continue Reading</a></li>
									</ul>
									<ul class="stats">
										<li><a href="like.php?post=<?= $post_id ?>&page=<?= $page ?>" class="<?php if ($_COOKIE['like_' . $_SESSION['user'] . '_' . $post_id]) echo 'liked'?> icon fa-heart"><?= $post['likes'] ?></a></li>
										<li><a href="/single.php?post=<?= $post_id ?>" class="icon fa-comment"><?= $comments[0] ?></a></li>
									</ul>
								</footer>
							</article>
                        <?php } ?>
						<!-- Pagination -->
							<ul class="actions pagination">
								<li><a href="/index.php?page=<?= $page - 1 ?>" class="<?php if($page == 0)echo "disabled"?> button big previous">Previous Page</a></li>
								<li><a href="/index.php?page=<?= $page + 1 ?>" class="<?php if($page > floor($total_posts / $pagination))echo "disabled"?> button big next">Next Page</a></li>
							</ul>

					</div>

				<!-- Sidebar -->
					<section id="sidebar">

						<!-- Intro -->
							<section id="intro">
								<a href="/" class="logo"><img src="<?= $settings['logo'] ?>" alt="" /></a>
								<header>
									<h2><?= $settings['name'] ?></h2>
									<p>Be popular with us</p>
								</header>
							</section>

						<!-- Mini Posts -->
							<section>
								<h3>Popular posts</h3>
								<div class="mini-posts">

									<!-- Mini Post -->
                                    <?php
                                        $pop_posts_req = mysqli_query($connection,"SELECT * FROM `posts` ORDER BY `likes` DESC LIMIT 4");

                                        while ($pop_post = mysqli_fetch_assoc($pop_posts_req)){
                                            $date_str = strtotime($pop_post['pub_time']);
                                            $pub_time = date('d F Y', $date_str);
                                            $pop_post_author_id = $pop_post['author_id'];
                                            $pop_post_author = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM `users` WHERE `id` = $pop_post_author_id"));
                                    ?>
										<article class="mini-post">
											<header>
												<h3><a href="single.php?post=<?= $pop_post['id'] ?>"><?= $pop_post['name'] ?></a></h3>
												<time class="published" datetime="2015-10-20"><?= $pub_time ?></time>
												<a href="user.php?id=<?= $pop_post_author_id ?>" class="author"><img src="<?= $pop_post_author['image'] ?>" alt="" /></a>
											</header>
											<a href="#" class="image"><img src="<?= $pop_post['image'] ?>" alt="" /></a>
										</article>
                                    <?php } ?>
								</div>
							</section>

						<!-- Posts List -->
							<section>

								<h3>Rating bloggers</h3>

								<ul class="posts">
                                    <?php
                                        $pop_users_req = mysqli_query($connection,"SELECT * FROM `users` ORDER BY `likes` DESC LIMIT 5");

                                        while ($pop_user = mysqli_fetch_assoc($pop_users_req)){
                                            $pop_user_id = $pop_user['id'];
                                            $pop_user_posts = mysqli_fetch_array(mysqli_query($connection,"SELECT COUNT(`id`) FROM `posts` WHERE `author_id` = $pop_user_id"));
                                    ?>
									<li>
										<article>
											<header>
												<h3><a href="/user.php?id=<?= $pop_user['id'] ?>"><?= $pop_user['name'] ?></a></h3>
												<span class="published"><?= $pop_user['likes'] ?> likes in <?= $pop_user_posts[0] ?> posts</span>
											</header>
											<a href="#" class="image"><img src="<?= $pop_user['image'] ?>" alt="" /></a>
										</article>
									</li>
                                    <?php } ?>
								</ul>
							</section>

						<!-- Footer -->
							<section id="footer">
								<p class="copyright">&copy; Blog. Design: <a href="http://html5up.net">HTML5 UP</a>.</p>
							</section>

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