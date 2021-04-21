<?php
require 'components/header.php';
session_start()
?>
				<!-- Main -->
					<div id="main">
                        <h3 style="color: darkred"> <?php echo $_SESSION['post_message']; unset($_SESSION['post_message']) ?> </h3><br>
						<!-- Post -->
                        <form action="include/add_post.php" enctype="multipart/form-data" method="post">
                            <article class="post">
                                <h1>Add Post</h1>
                                <input type="text" name="name" placeholder="Post name"><br>
                                <input type="text" name="subtitle" placeholder="Subtitle"><br>
                                <input type="text" name="anons" placeholder="Anons"><br>
                                <textarea name="content" placeholder="Post content"></textarea><br>
                                <input type="file" name="file"><br><br>
                                <input type="submit" class="button big fit" value="Add Post">
                            </article>
                        </form>
					</div>

				<!-- Footer -->
					<section id="footer">
						<p class="copyright">&copy; Blog. Design: <a href="http://html5up.net">HTML5 UP</a>.</p>
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