<?php
class Home extends BaseController
{
    public function __construct()
    {
        $this->homeModel = $this->model('HomepageModel');
        $this->userModel = $this->model('UserModel');
        $this->pageValidator = $this->validator('PageValidator');
    }

    public function index()
    {
        //checking if there is a current session
        session_start();
        if (isset($_SESSION['Id'])) {
            header("refresh: 0; url=/Home/Homepage");
        } else {
            session_destroy();
            header("refresh: 0; url=/Home/login");
        }
    }

    public function homepage()
    {
        $check = $this->pageValidator->checkSessionAndRoll();



        if ($check == 'admin') {
            header("refresh: 0; url=/Admin/index");
        } elseif ($check == 'user') {

            $Id = $_SESSION['Id'];

            $getUserInfo = $this->userModel->getAllUserDetailsById($Id);

            $data = [
                'title' => 'Home',
                'info' => $getUserInfo
            ];

            $this->view('/homepages/home', $data);
        }
    }

    public function login()
    {
        //checking if there is a current user/session
        $check = $this->pageValidator->checkSession();

        if ($check == 'runningSession') {
            //sending user to the homepage
            header("refresh: 0; url=/Home/Homepage");
        } elseif ($check == 'noSession') {
            $_SESSION = array();
            session_destroy();

            $title = 'Manage your systems';
            //checking if there is a post request
            if ($_SERVER["REQUEST_METHOD"] == 'POST') {

                //sanatizing the post before procescing
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                //checks if all the fields have been filled
                if ($_POST['pass'] == NULL or $_POST['email'] == NULL) {

                    //setting the error messages
                    $data = [
                        'title' => $title,
                        'error' => '<p class="error">Pleass enter all fields</p>'
                    ];
                    $this->view('homepages/index', $data);
                    //checks if the email is typed correctly
                } elseif (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {

                    //setting the error messages
                    $data = [
                        'title' => $title,
                        'error' => '<p class="error">This is not a valid email</p>'
                    ];
                    $this->view('homepages/index', $data);
                    // header("Refresh: 3; url=/Home/index");

                } else {
                    //putting these post values into a $variable
                    $email = $_POST['email'];
                    $password = $_POST['pass'];

                    //sending the variable to the model
                    $checkDetails = $this->userModel->checkEmail($email);

                    //checking if email exists
                    if ($checkDetails == true) {
                        $Id = $checkDetails->Id;

                        $checkId = $this->userModel->getLoginById($Id);

                        //checking if password matches the email
                        if ($checkId->UserPass == $password) {

                            // checks if user is active
                            if ($checkId->IsActive == 1) {
                                //starting session
                                session_start();

                                //storing the id in the session
                                $_SESSION['Id'] = $checkId->Id;
                                $_SESSION['lastTime'] = time();
                                header("refresh: 0; url=/Home/Homepage");
                            } elseif ($checkId->IsActive == 0) {
                                //Ends session if account is inactive
                                $_SESSION = array();
                                session_destroy();
                                header("refresh: 0; url=/Home/index");
                            }

                            //if password is incorrect
                        } else {
                            $data = [
                                'title' => $title,
                                'error' => '<p class="error">The given password or email is incorrect, pls try again</p>'
                            ];
                            $this->view('homepages/index', $data);
                            // header("Refresh: 3; url=/Home/index");
                        }
                        //if email is incorrect
                    } else {
                        $data = [
                            'title' => $title,
                            'error' => '<p class="error">The given password or email is incorrect, pls try again</p>'
                        ];
                        $this->view('homepages/index', $data);
                        // header("Refresh: 3; url=/Home/index");
                    }
                }
            }
            $data = [
                'title' => 'Manage your systems',
                'error' => ''
            ];
            $this->view('homepages/index', $data);
        }
    }

    public function logout()
    {

        session_start();
        if ($_SESSION['Id']) {
            $_SESSION = array();
            session_destroy();
            header("Refresh: 0; url=/Home/index");
        } else {
            header("Refresh: 0; url=/Home/index");
        }
    }
}
