<!DOCTYPE html>
<html lang="en">
<?php
    $title = 'Inbox Guard';
    $homepage = 'active';
    require_once 'include/head.php';
?>
<body>
    <?php
    require_once 'include/header-user.php';
    ?>
    <section class="home-banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="mb-2">
                        <h1><span class="inbox">Inbox</span><span class="guard">Guard</span></h1>
                    </div>
                    <div class="mb-2">
                        <h1 class="banner-title"><span>Email</span><span>Protection</span><span>Platform</span></h1>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <img src="img/banner.jpg" class="img-fluid home-img" alt="">
                </div>
            </div>
        </div>
        <div class="container">
            <div>
                <h5>We provide users with strong protection against malicious email-based attacks. InboxGuard will ensure the 
                security and integrity of your data.</h5>
            </div>

            <div id="login-screen" class="hidden">
                <button type="button" id="login-btn">Login with Google</button>
            </div>

            <div id="profile-screen" class="hidden">
                <p>Welcome <span id="user-name"></span>!</p>
                <!-- <img id="avatar" class="hidden" src=""/> -->
                <button id="logout-btn">Logout</button>
            </div>

            <script type="module" src="js/google.js"></script>

            <?php
            require_once 'include/google.php';
            ?>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/appwrite@16.0.0"></script>
</body>
</html>