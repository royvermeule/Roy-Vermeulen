<?php
class Register extends BaseController
{
    public function __construct()
    {
        $this->userModel = $this->model('userModel');
    }

    public function index()
    {
        //checking if there is a post request
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {

            $title =  "Manage your systems";
            //sanatizing the post before procescing
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //checks if all the required fields have been filled
            if (
                $_POST['email'] == null
                && $_POST['pass'] == null
                && $_POST['firstname'] == null
                && $_POST['lastname'] == null
                && $_POST['age'] == null
            ) {
                $data = [
                    'title' => $title,
                    'succeed' => '',
                    'error' => '<p class="error">Pleass enter all required fields</p>'
                ];
                $this->view('homepages/register', $data);

                //checks if the email is typed correctly
            } elseif (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
                $data = [
                    'title' => $title,
                    'succeed' => '',
                    'error' => '<p class="error">This is not a valid email</p>'
                ];
                $this->view('homepages/register', $data);

                //check if password is 12 characters
            } elseif (strlen($_POST['pass']) < 12) {
                $data = [
                    'title' => $title,
                    'succeed' => '',
                    'error' => '<p class="error">The password must be et least 12 characters long</p>'
                ];
                $this->view('homepages/register', $data);
            } else {
                //if the data gets trough the validation its compared to the db fields
                $email = $_POST['email'];

                //sending the variable to the model
                $checkDetails = $this->userModel->checkEmail($email);

                //checking if the email already exists
                if ($checkDetails == false) {
                    $data = [
                        'title' => $title,
                        'succeed' => '<p class="succeed">Account made succesfully go to <a href="/Home/login">login</a></p>',
                        'error' => ''
                    ];
                    $this->view('homepages/register', $data);
                    $this->userModel->addUser($_POST);
                } else {
                    $data = [
                        'title' => $title,
                        'succeed' => '',
                        'error' => '<p class="error">A account with this email already exists</p>'
                    ];
                    $this->view('homepages/register', $data);
                }
            }
        } else {
            $data = [
                'title' => 'Manage your systems',
                'error' => '',
                'succeed' => ''
            ];

            $this->view('homepages/register', $data);
        }
    }
}
