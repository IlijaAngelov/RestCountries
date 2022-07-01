<?php
session_start();
include "partials/header.php";
?>
<section class="container">
    <div class="wrapper">
        <div class="signup">
            <form action="inc.signup.php" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="passwordrepeat">Repeat Password:</label>
                    <input type="password" name="passwordrepeat" placeholder="Repeat Password" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" placeholder="zyx@google.com">
                </div>
                <br>
                <button class="submit_button" type="submit" name="signup">Sign Up</button>
            </form>
        </div>
    </div>
</section>