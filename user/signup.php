<?php

  session_start();

  if(isset($_SESSION['user']) && $_SESSION['user'] == 'user'){
    header('location: ../index.php');
  }

  require_once '../classes/user.class.php';
  require_once '../tools/functions.php';

  if(isset($_POST['signup'])){
    $user = new User();
    //sanitize
    $user->firstname = htmlentities($_POST['firstname']);
    $user->lastname = htmlentities($_POST['lastname']);
    $user->gender = isset($_POST['gender']) ? htmlentities($_POST['gender']) : '';
    $user->email = htmlentities($_POST['email']);
    $user->password = htmlentities($_POST['password']);

    //validate inputs of the users
    if (validate_field($user->firstname) && 
    validate_field($user->lastname) &&
    validate_field($user->gender) &&
    validate_field($user->email) &&
    validate_cpw($user->password, $_POST['confirmpassword'])){
        //proceed with saving
        if($user->add()){ 
          echo "<script>alert('You successfully created an account!');window.location.href='../index.php'</script>";
        }else{
          echo 'An error occured while adding in the database.';
        }
    }
  }

?>

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
    <section class="signup-banner">
        <div class="container mt-5">
            <h1>Create an account</h1>
            <p>Please enter your details to sign up and be protected from malicious email-based attacks.</p>
            <form  action="" method="POST" name="signup" class="signup-user my-4">
                <div class="form-group row flex-nowrap my-3">
                    <div class="col-sm-6 align-self-center">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter your first name" value="<?php if(isset($_POST['firstname'])){echo $_POST['firstname'];} ?>">
                        <?php
                            if(isset($_POST['firstname']) && !validate_field($_POST['firstname'])){
                        ?>
                            <div class="invalid-feedback d-block">
                            Please enter valid first name.
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="col-sm-6 align-self-center">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter your last name" value="<?php if(isset($_POST['lastname'])){echo $_POST['lastname'];} ?>">
                        <?php
                            if(isset($_POST['lastname']) && !validate_field($_POST['lastname'])){
                        ?>
                            <div class="invalid-feedback d-block">
                            Please enter valid last name.
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                                
                <div class="form-group my-3">
                    <label class="form-label">Gender</label>
                    <div class="d-flex">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="male" name="gender" value="Male" <?php if(isset($_POST['gender']) && $_POST['gender'] == 'Male') { echo 'checked'; } ?>>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check ms-3">
                            <input type="radio" class="form-check-input" id="female" name="gender" value="Female" <?php if(isset($_POST['gender']) && $_POST['gender'] == 'Female') { echo 'checked'; } ?>>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <div class="form-check ms-3">
                            <input type="radio" class="form-check-input" id="non-binary" name="gender" value="Non-binary" <?php if(isset($_POST['gender']) && $_POST['gender'] == 'Non-binary') { echo 'checked'; } ?>>
                            <label class="form-check-label" for="non-binary">Non-binary</label>
                        </div>
                    </div>
                    <?php
                    if((!isset($_POST['gender']) && isset($_POST['signup'])) || (isset($_POST['gender']) && !validate_field($_POST['gender']))){
                    ?>
                    <p class="text-danger my-1">Select your gender</p>
                    <?php
                    }
                    ?>
                </div>
            
                <div class="form-group">
                    <div class="col-sm-12 align-self-center my-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>">
                        <?php
                            if(isset($_POST['email']) && !validate_field($_POST['email'])){
                        ?>
                        <div class="invalid-feedback d-block">
                            Please enter valid email.
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 align-self-center my-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" value="<?php if(isset($_POST['password'])){echo $_POST['password'];} ?>">
                        <?php
                        if(isset($_POST['password']) && validate_password($_POST['password']) !== "success"){
                        ?>
                        <p class="text-danger my-1"><?= validate_password($_POST['password']) ?></p>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-sm-12 align-self-center my-3">
                        <label for="confirmpassword">Confirm password</label>
                        <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Enter your password again" value="<?php if(isset($_POST['confirmpassword'])){echo $_POST['confirmpassword'];} ?>">
                        <?php
                        if(isset($_POST['password']) && isset($_POST['confirmpassword']) && !validate_cpw($_POST['password'], $_POST['confirmpassword'])){
                        ?>
                            <div class="invalid-feedback d-block">
                            Your confirm password didn't match
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    
                    <button type="submit" name="signup" class="login-btn btn mt-4">Sign Up</button>

                    <?php
                        if(isset($_POST['signup']) && isset($error)){
                        ?>
                            <p class="text-danger text-center">
                                <?= $error ?>
                            </p>
                        <?php
                        }
                    ?>
                    <p class="d-flex justify-content-center mt-3">Already have an account?&nbsp;
                        <a href="login.php" class="login-signup">Login</a>
                    </p>
                </div>
            </form>
        </div>
    </section>
</body>
</html>