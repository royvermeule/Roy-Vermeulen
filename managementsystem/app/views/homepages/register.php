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
        <h1 class="title"><?= $data['title'] ?></h1>
    </header>
    <main>
        <div class="loginRegisterPage">
            <form class="register" action="/Register/register" method="post">
                <h2>Register</h2>
                <?= $data['error'] ?>
                <?= $data['succeed'] ?>
                <input type="text" name="firstname" id="firstname" placeholder="Firstname    (required)">
                <input type="text" name="infix" id="infix" placeholder="infix">
                <input type="lastname" name="lastname" id="lastname" placeholder="lastname   (required)">
                <input type="email" name="email" id="email" placeholder="Email   (required)">
                <input type="password" name="pass" id="pass" placeholder="Password   (required)">
                <input type="number" name="age" id="age" placeholder="Age    (required)">
                <input class="submit" type="submit" value="Register">
            </form>
        </div>
    </main>
    <footer>

    </footer>
</body>

</html>