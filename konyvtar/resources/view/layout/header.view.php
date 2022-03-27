<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BOT - Könyvtár</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
</head>
<body>

<header class="container py-3">
    <div class="row">
        <div class="col-8">
            <h1 class="display-2">
                Bláthy Könyvtár
            </h1>
        </div>
        <div class="col-4">
            <img src="/img/logo.png" alt="LOGO" class="img img-fluid">
        </div>
    </div>
</header>

<?php if(isset($messages) && $messages != false) : ?>
    <div class="alert alert-light alert-dismissible fade show" role="alert"
         style="position: fixed; bottom: 0; right: 0;">

        <ul>
        <?php foreach ($messages as $message) : ?>
            <li class="text-<?= $message["type"] ?>"><?= $message["text"] ?> </li>
        <?php endforeach; ?>
        </ul>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>
<?php endif; ?>
