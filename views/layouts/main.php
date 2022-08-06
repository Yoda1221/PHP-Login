<?php

use App\core\Application;

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PHP Login Demo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <?php if(!Application::isGuest()) :?>
                        <li class="nav-item">
                            <a class="nav-link" href="/protected">Protected</a>
                        </li>
                    <?php endif;?>
                </ul>
                <?php if(Application::isGuest()) :?>
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Log In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/registration">Registration</a>
                        </li>
                    </ul>
                <?php else :?>
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/profile">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout">LogOut</a>
                        </li>
                    </ul>
                <?php endif;?>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        <?php if(Application::$app->session->getFlashMesg('success')): ?>
            <div class="alert alert-success">
                <?php echo Application::$app->session->getFlashMesg('success'); ?>
            </div>
        <?php endif; ?>
        {{ content }}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
