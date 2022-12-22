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
            <form class="login" action="/Home/login" method="post">
                <h2>Login</h2>
                <?= $data['error'] ?>
                <input class="email" type="text" name="email" placeholder="Email">
                <input class="password" type="password" name="pass" placeholder="Password">
                <input class="submit" type="submit" value="Login">
                <a class="registerBtn" href="/Register/index" class="goToRegister">Or register</a>
            </form>
        </div>
    </main>
</body>

</html>