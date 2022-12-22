<?php
class PageValidator extends BaseController
{
    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
    }

    public function checkSessionAndRoll()
    {
        session_start();

        if (!isset($_SESSION['Id'])) {
            echo "<p>
            <center>
            <h1 style='color: red;'>Please log in to view this page</h1>
            <a style='colore: lightblue' href='/Home/index'>Log in</a>
            </center>
            </p>";
        } else {
            $Id = $_SESSION['Id'];
            $roll = $this->userModel->getAllUserDetailsById($Id);
            if ($roll->RollName == 'Admin') {
                return 'admin';
            } elseif ($roll->RollName == 'User') {
                return 'user';
            }
        }
    }

    public function checkSession()
    {
        session_start();

        if (!isset($_SESSION['Id'])) {
            return 'noSession';
        } else {
            return 'runningSession';
        }
    }
}
