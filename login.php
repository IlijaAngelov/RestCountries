<?php
session_start();
include "partials/header.php";
?>
<div class="container">
    <form action="inc.login.php" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password">
        </div>
        <button class="submit_button" type="submit" name="submit">Log In</button>
    </form>
</div>