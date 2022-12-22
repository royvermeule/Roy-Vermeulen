<?php
//Load the model and the view
class BaseController
{
    public function model($model)
    {
        //Require model file
        require_once '../app/models/' . $model . '.php';
        //Instantiate model
        return new $model();
    }

    public function validator($validator)
    {
        //Require model file
        require_once '../app/validators/' . $validator . '.php';
        //Instantiate model
        return new $validator();
    }

    //Load the view (checks for the file)
    public function view($view, $data = [])
    {
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die("View does not exists.");
        }
    }
}
