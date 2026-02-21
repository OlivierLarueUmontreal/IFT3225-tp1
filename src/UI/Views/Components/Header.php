<?php
$isLoggedIn = !empty($_SESSION['username']);

// Determine current route (relative to BASE_URL) to set active nav links
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$requestPath = strtok($requestUri, '?');
$requestPath = rtrim($requestPath, '/');
$requestPath = preg_replace('#^' . preg_quote(BASE_URL) . '#', '', $requestPath);
$route = ltrim($requestPath, '/');
$firstSegment = explode('/', $route)[0] ?? '';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?? 'TP1 App' ?></title>
    <link rel="stylesheet" href="<?= makeUrl('src/UI/CSS/style.css') ?>">

    <!--BOOTSTRAP-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/efd10e98b4.js" crossorigin="anonymous"></script>

</head>
<body>
<header style="margin-bottom: 40px">
    <nav class="navbar navbar-expand-lg header-navbar">
        <a class="navbar-brand" href="<?= makeUrl('') ?>">TP1 App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <?php if ($isLoggedIn): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($firstSegment === 'exercices') ? 'active' : '' ?>"
                           href="<?= makeUrl('exercices') ?>">My Exercices</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($firstSegment === 'my-account' || $firstSegment === 'accounts') ? 'active' : '' ?>"
                           href="<?= makeUrl('my-account') ?>">My Account</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= $_SESSION['username'] ?>
                        </a>
                        <!-- profile Dropdown menu -->
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?= makeUrl('my-account') ?>">Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="<?= makeUrl('logout') ?>">Logout</a>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>
<main class="container">
