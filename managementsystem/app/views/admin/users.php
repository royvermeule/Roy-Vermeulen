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
        <table class="infoTable">
            <thead>
                <th>Firstname</th>
                <th>Infix</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Password</th>
                <th>Age</th>
                <th>Roll</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?= $data['users'] ?>
            </tbody>
        </table>
    </main>
    <footer>

    </footer>
</body>

</html>