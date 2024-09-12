<!DOCTYPE html>
<html lang="en">
<?php
    $title = 'Inbox Guard';
    $loginpage = 'active';
    require_once '../include/head.php';
?>
<body>
    <?php
    require_once '../include/header-user.php';
    ?>
    <section class="login-banner">
        <div class="container mt-5">
            <h1>Welcome back!</h1>
            <p>Log in now to your email account to be protected from malicious attacks.</p>
            <form  action="" method="POST" class="login-user my-4 d-flex flex-column">
                <div class="mb-4">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" placeholder="Enter your email address" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" value="<?php if(isset($_POST['password'])){ echo $_POST['password']; } ?>">
                </div>
                
                <button type="submit" class="login-btn btn mt-3">Login</button>

                <?php
                    if(isset($_POST['login']) && isset($error)){
                    ?>
                        <p class="text-danger text-center">
                            <?= $error ?>
                        </p>
                    <?php
                    }
                ?>
                <p class="d-flex justify-content-center mt-5">Don't have an account yet?&nbsp;
                    <a href="signup.php" class="login-signup">Sign Up</a>
                </p>
            </form>
        </div>
    </section>
</body>
</html>