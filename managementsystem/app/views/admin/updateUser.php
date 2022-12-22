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
        <form action="/Admin/updateUser" class="updateCreate" method="POST">
            <input type="hidden" name="loginId" value="<?= $data['loginId'] ?>">
            <input type="hidden" name="userId" value="<?= $data['userId'] ?>">
            <h2 class="context">User details</h2>
            <div class="userDetails">
                <input type="text" name="Firstname" placeholder="Firstname" value="<?= $data['info']->Firstname ?>">
                <input type="text" name="Infix" placeholder="Infix" value="<?= $data['info']->Infix ?>">
                <input type="text" name="Lastname" placeholder="Lastname" value="<?= $data['info']->Lastname ?>">
                <input type="number" name="Age" placeholder="Age" value="<?= $data['info']->Age ?>">
            </div>
            <h2>Login detials</h2>
            <div class="loginDetails">
                <input type="text" name="Email" placeholder="Email" value="<?= $data['info']->Email ?>">
                <input type="text" name="Password" placeholder="Password" value="<?= $data['info']->UserPass ?>">
                <select name="RollId">
                    <option value="<?= $data['info']->RollId ?>"><?= $data['info']->RollName ?></option>
                    <option value="1">Admin</option>
                    <option value="2">User</option>
                </select>
                <select name="IsActive">
                    <option value="<?= $data['info']->IsActive ?>">Active</option>
                    <option value="1">Active</option>
                    <option value="0">Deactivate</option>
                </select>
                <input class="submit" type="submit" value="Update">
            </div>
        </form>
    </main>
    <footer>

    </footer>
</body>

</html>