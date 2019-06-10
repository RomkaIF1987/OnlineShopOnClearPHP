<?php
session_start();
include("dbcontroller.php");
$db_handle = new DBController();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form

    $user_email = mysqli_real_escape_string($db_handle->connectDB(), $_POST['email']);
    $user_password = mysqli_real_escape_string($db_handle->connectDB(), $_POST['password']);

    $salt1 = "qm&h*";
    $salt2 = "pg!@";
    $token = hash('ripemd128', "$salt1$user_password$salt2");

    $sql = $db_handle->runQuery("SELECT id FROM users WHERE email = '$user_email' and password = '$token'");

    $count = count($sql[0]);

    if ($count == 1) {

        $ses_sql = $db_handle->runQuery("SELECT name, money FROM users WHERE email = '$user_email' ");
        $_SESSION['login_user'] = $ses_sql[0]['name'];
        $_SESSION['user_account'] = $ses_sql[0]['money'];

        header("location: index.php");
    } else {
        $error = "Your Login Name or Password is invalid";
    }
}

?>
<?php require_once 'partials/header.php' ?>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Sign In</h5>
                    <form action="" method="post" class="form-signin">
                        <div class="form-label-group">
                            <input type="email" id="inputEmail" name="email" class="form-control"
                                   placeholder="Email address" required autofocus>
                            <label for="inputEmail">Email address</label>
                        </div>

                        <div class="form-label-group">
                            <input type="password" id="inputPassword" name="password" class="form-control"
                                   placeholder="Password" required>
                            <label for="inputPassword">Password</label>
                        </div>

                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Remember password</label>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Submit">
                            Sign in
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'partials/footer.php' ?>
