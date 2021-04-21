<?php
require 'components/header.php';
?>
<!-- Main -->
<div id="main">

    <!-- Post -->
    <form action="include/admin_changes.php" enctype="multipart/form-data" method="post">
        <article class="post">
            <h1>Add Post</h1>
            <input type="text" name="name" placeholder="Site name" value="<?= $settings['name'] ?>"><br>
            <input type="text" name="pagination" placeholder="Pagination" value="<?= $settings['pagination'] ?>"><br>
            <input type="file" name="file"><br><br>
            <input type="submit" class="button big fit" value="Change settings">
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