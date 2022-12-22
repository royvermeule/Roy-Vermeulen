<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>

<body>
    <header>
        <?php require_once APPROOT . '/views/admin/includes/adminNav.php' ?>
    </header>
    <main>
        <h1><?= $data['title'] ?></h1>
        <p>Welcome <?= $data['info']->Firstname ?> to the addmin pannel</p>
        <a href="/Home/logout">Logout</a>
    </main>
    <footer>

    </footer>
</body>

</html>