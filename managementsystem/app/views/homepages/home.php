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
    <main>
        <h1 class="title"><?= $data['title'] ?></h1>
        <h3><?= $data['info']->Firstname ?></h3>
        <a href="/Home/logout">logout</a>
    </main>
</body>

</html>