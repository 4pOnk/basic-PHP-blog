<?php
require 'components/header.php';
$post_id = $_GET['post'];
$post = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM `posts` WHERE `id` = $post_id"));
?>
    <!-- Main -->
    <div id="main">

        <!-- Post -->
        <form action="include/update_post.php?post=<?= $post_id ?>" enctype="multipart/form-data" method="post">
            <article class="post">
                <h1>Add Post</h1>
                <input type="text" name="name" placeholder="Post name" value="<?= $post['name'] ?>"><br>
                <input type="text" name="subtitle" placeholder="Subtitle" value="<?= $post['subtitle'] ?>"><br>
                <input type="text" name="anons" placeholder="Anons" value="<?= $post['anons'] ?>"><br>
                <textarea name="content" placeholder="Post content" ><?= $post['content'] ?></textarea><br>
                <input type="file" name="file"><br><br>
                <input type="submit" class="button big fit" value="Update Post">
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
