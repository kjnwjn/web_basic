<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <!-- BOOTSTRAP LINK CDN -->
    <!-- css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- BOOTSTRAP js -->

    <!-- font awesome js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Alertify JS -->


    <!-- icon -->
    <link rel="icon" type="image/png" href="../../public/assest/img/icon.png">
    <link rel="stylesheet" href="<?= getenv('BASE_URL') ?>style2.css">
    <title><?= isset($data['title']) ? $data['title'] : 'Document' ?></title>
</head>

<body onload="preloader()" style="font-size: initial;">
    <div class="loader-wrapper">
        <div class="loader-circle">
            <div class="loader-wave"></div>
        </div>
    </div>
    <!-- HEADER -->
    <?php
    include('./private/view/partial/header.php')
    ?>
    <!-- ---------------- -->

    <!-- BODY -->
    <?php

    isset($data['page']) ?
        include('./private/view/pages/actionPages/' . $data['page'] . '.php') : null
    ?>
    <!-- ---------------- -->
    <?php echo (false); ?>
    <!-- FOOTER -->
    <?php
    include('./private/view/partial/footer.php')
    ?>
    <!-- ---------------- -->

</body>

<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

<!-- 
    RTL version
-->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css" />
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css" />
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css" />
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css" />


<script src="/main.js"> </script>

=======
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= getenv('BASE_URL') ?>style.css">
    <title><?= isset($data['title']) ? $data['title'] : 'Document' ?></title>
</head>

<body>
    <header class="w-100 p-4 d-flex justify-content-center align-items-center">
        <a class="mx-2" href="/">Home</a> |
        <a class="mx-2" href="/news">News</a> |
        <a class="mx-2" href="/404">Not Found</a> |
        <a class="mx-2" href="/login">Login</a> |
        <a class="mx-2" href="/security">Security page</a> |
        <a class="mx-2" href="/about">About</a>
    </header>
    <?php
    isset($data['page']) ?
        include('./private/view/pages/' . $data['page'] . '.php') : null
    ?>
</body>

<script type="module" src="<?= getenv('BASE_URL') ?>main.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
>>>>>>> d7fc51a10643a9560bcb280b4add131580ba1a22

</html>