<?php
class Admin extends BaseController
{
    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
        $this->pageValidator = $this->validator('PageValidator');
    }

    public function index()
    {
        $check = $this->pageValidator->checkSessionAndRoll();

        if ($check == 'admin') {

            $Id = $_SESSION['Id'];

            $getAdminInfo = $this->userModel->getAllUserDetailsById($Id);
            $data = [
                'title' => 'Admin panel',
                'info' => $getAdminInfo
            ];

            $this->view('admin/index', $data);
        } else {
            echo "<p>
            <center>
            <h1 style='color: red;'>You do not have permision to view this page</h1>
            <a style='colore: lightblue' href='/Home/index'>Log in</a>
            </center>
            </p>";
        }
    }

    public function users()
    {
        $check = $this->pageValidator->checkSessionAndRoll();

        if ($check == 'admin') {

            $users = $this->userModel->getAllUserDetails();

            $rows = '';

            foreach ($users as $value) {
                $rows .= "<tr>
                                <td>$value->Firstname</td>
                                <td>$value->Infix</td>
                                <td>$value->Lastname</td>
                                <td>$value->Email</td>
                                <td>$value->UserPass</td>
                                <td>$value->Age</td>
                                <td>$value->RollName</td>
                                <td>
                                <a class='update' href='/Admin/updateUser/$value->loginId'>Update</a>
                                <a class='delete' href='/Admin/updateUser/$value->loginId'>Delete</a>
                                </td>
                            </tr>";
            }

            $data = [
                'title' => 'Users',
                'users' => $rows
            ];

            $this->view('admin/users', $data);
        } else {
            echo "<p>
            <center>
            <h1 style='color: red;'>You do not have permision to view this page</h1>
            <a style='colore: lightblue' href='/Home/index'>Log in</a>
            </center>
            </p>";
        }
    }

    public function updateUser($Id = null)
    {
        $check = $this->pageValidator->checkSessionAndRoll();

        if ($check == 'admin') {
            if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $this->userModel->updateUser($_POST);

                header("refresh: 0; url=/Admin/users");
            } else {
                $info = $this->userModel->getAllUserDetailsById($Id);
                $data = [
                    'title' => 'Update',
                    'info' => $info,
                    'loginId' => $Id,
                    'userId' => $info->UserDetailsId
                ];
                $this->view('admin/updateUser', $data);
            }
        } else {
            echo "<p>
            <center>
            <h1 style='color: red;'>You do not have permision to view this page</h1>
            <a style='colore: lightblue' href='/Home/index'>Log in</a>
            </center>
            </p>";
        }
    }
}
