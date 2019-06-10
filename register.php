<?php
session_start();
include("dbcontroller.php");
$db_handle = new DBController();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $salt1 = "qm&h*";
    $salt2 = "pg!@";
    $token = hash('ripemd128', "$salt1$password$salt2");


    $sql = $db_handle->runQuery("select name, email from users where email='$email'");

    $_SESSION['email'] = $sql[0]['email'];

    if (empty($sql)) {
        $sql = "insert into users (name,email, password) values('$name','$email','$token')";

        $db_handle->runQuery($sql);

        $db_handle->closeConnection();
        $response = array(
            "type" => "success",
            "message" => "You have registered successfully.<br/><a href='login.php'>Now Login</a>."
        );
    } else {
        $response = array(
            "type" => "error",
            "message" => "Email already in use."
        );
    }
}
?>

<?php
if (!empty($response)) : ?>
<div id="response" class="<?= $response["type"]; ?></div>
    <?= $response["message"]; ?>
<?php endif; ?>
<?php require_once 'partials/header.php' ?>
<div style=" padding-top: 40px">
<div class="container">
    <form class="form-horizontal" role="form" method="POST" action="">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h2>Register New User</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="name">Name</label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
                        <input type="text" name="name" class="form-control" id="name"
                               placeholder="John Doe" required autofocus>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="email">E-Mail Address</label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                        <input type="text" name="email" class="form-control" id="email"
                               placeholder="you@example.com" required autofocus>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="password">Password</label>
            </div>
            <div class="col-md-6">
                <div class="form-group has-danger">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                        <input type="password" name="password" class="form-control" id="password"
                               placeholder="Password" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="password">Confirm Password</label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem">
                            <i class="fa fa-repeat"></i>
                        </div>
                        <input type="password" name="password-confirmation" class="form-control"
                               id="password-confirm" placeholder="Password" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-success"><i class="fa fa-user-plus"></i> Register</button>
            </div>
        </div>
    </form>
</div>
</div>
<?php require_once 'partials/footer.php' ?>

<script>
    function signupvalidation() {
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var confirm_pasword = document.getElementById('password-confirm').value;
        var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

        var valid = true;

        if (name === "") {
            valid = false;
            document.getElementById('name_error').innerHTML = "required.";
        }

        if (email === "") {
            valid = false;
            document.getElementById('email_error').innerHTML = "required.";
        } else {
            if (!emailRegex.test(email)) {
                valid = false;
                document.getElementById('email_error').innerHTML = "invalid.";
            }
        }

        if (password === "") {
            valid = false;
            document.getElementById('password_error').innerHTML = "required.";
        }
        if (confirm_pasword === "") {
            valid = false;
            document.getElementById('password-confirm_error').innerHTML = "required.";
        }

        if (password !== confirm_pasword) {
            valid = false;
            document.getElementById('password-confirm_error').innerHTML = "Both passwords must be same.";
        }

        return valid;
    }
</script>