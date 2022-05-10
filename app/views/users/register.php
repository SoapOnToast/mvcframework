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
        <h2>Register</h2>
        
        <form action="<?= URLROOT ?>/users/register" method="POST">
            <input type="text" placeholder="Username" name="username">
            <span class="invalidFeedback">
                <?= $data['usernameError'] ?>
            </span>

            <input type="email" placeholder="Email" name="email">
            <span class="invalidFeedback">
                <?= $data['emailError'] ?>
            </span>

            <input type="password" placeholder="Confirm password" name="confirmPassword">
            <span class="invalidFeedback">
                <?= $data['confirmPasswordError'] ?>
            </span>

            <input type="password" placeholder="Password" name="password">
            <span class="invalidFeedback">
                <?= $data['passwordError'] ?>
            </span>

            <button id="submit" type="submit" value="Submit">Submit</button>
        </form>
    </div>
</div>
</div>