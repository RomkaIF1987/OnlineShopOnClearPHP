<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Online Shop">
    <meta name="author" content="Roman Zhyliak">
    <title>Simple Online Shop</title>
    <link href="../css/style.css" type="text/css" rel="stylesheet"/>
    <link href="../css/bootstrap.css" type="text/css" rel="stylesheet"/>
    <link href="../css/footer.css" type="text/css" rel="stylesheet"/>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sticky-footer-navbar/">
</head>
<body class="d-flex flex-column h-100">
<?php require_once 'Cart.php' ?>
<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Online Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav text-right">
                <?php if (empty($_SESSION['login_user'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register.php">Register</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a href="cartConfirm.php" class="nav-link">Cart <span
                                    class="badge badge-light"><?= (!empty($_SESSION["cart_item"])) ? (count($_SESSION["cart_item"])) : '' ?></span></a>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link">Account: <?= $_SESSION['user_account'] ?> </div>
                    </li>
                    <li class="nav-item">
                        <div class="d-flex">
                            <div class="dropdown mr-1">
                                <button type="button" class="btn btn-secondary dropdown-toggle" id="dropdownMenuOffset"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        data-offset="10,20">
                                    <?= $_SESSION['login_user'] ?>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                                    <a class="dropdown-item" href="logout.php">Logout</a>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>
<div class="mt-5"></div>