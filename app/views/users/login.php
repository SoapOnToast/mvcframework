<?php
    require APPROOT . '/views/includes/head.php';
?>

<div id="section-landing">
<div class="navbar">
    <?php
        require APPROOT . '/views/includes/navigation.php';
    ?>
</div>
<div class="container-login">
    <div class="wrapper-login">
        <h2>Sign in</h2>
        <form action="<?= URLROOT ?>/users/login" method="POST">
            <input type="text" placeholder="Username" name="username" autocomplete="username">
            <span class="invalidFeedback">
                <?= $data['usernameError'] ?>
            </span>
            <input type="password" placeholder="Password" name="password" autocomplete="current-password">
            <span class="invalidFeedback">
                <?= $data['passwordError'] ?>
            </span>

            <button id="submit" type="submit" value="submit">Submit</button>
            <p class="options">Not Registered yet? <a href="<?= URLROOT ?>/users/register">Create an account!</a></p>
        </form>
    </div>
</div>
</div>
