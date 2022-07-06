<?php
    session_start();
    require 'vendor/autoload.php';
    include 'partials/header.php';
?>
<section id="control-center">
    <button class="submit_button" id="get-btn">Get Countries</button>
    <div id="container" class="flex-container">
    </div>
</section>
<script src="axios.js"></script>
</body>
</html>


