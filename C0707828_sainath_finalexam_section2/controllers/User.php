<?php



class User extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function signUp() {
        if (isset($_POST["name"]) && isset($_POST["email"]) &&
                isset($_POST["username"]) && isset($_POST["password"])) {

            $data["name"] = $_POST["name"];
            $data["email"] = $_POST["email"];
            $data["username"] = $_POST["username"];
            $data["password"] = md5($_POST["password"]);

            echo $this->model->signUp($data);
        }
    }

    public function signIn() {
        if (isset($_POST["username"]) && isset($_POST["password"])) {

            $response = $this->model->signIn('*', "username = '" . $_POST["username"] . "'");
            $response = $response[0];

            if ($response["password"] == md5($_POST["password"])) {
                $this->createSession($response['username'], $response["id"]);
                echo 1;
            }
        }
    }

    function createSession($username, $id) {
        Session::setValue('U_NAME', $username);
        Session::setValue('ID', $id);
    }

    function destroySession() {
        Session::destroy();
        header('Location:'.URL);
    }   

}
