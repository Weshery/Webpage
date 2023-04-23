<?php
include "../../Querys/AccountManagmentQuerys/signUpQuerys.php";
class SignupContr extends Signup
{

    private $uid;
    private $pwd;
    private $pwdRpeat;
    private $email;


    public function __construct($uid, $pwd, $pwdRpeat, $email)
    {

        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdRpeat = $pwdRpeat;
        $this->email = $email;
    }

    public function signUpUser()
    {
        if ($this->emptyInput() == false) {

            header("location: http://localhost/webpage/?oldal=login&error=emptyinput");
            exit();
        }

        if ($this->invalidUid() == false) {

            header("location: http://localhost/webpage/?oldal=login&error=invalidUsername");
            exit();
        }

        if ($this->invalidEmail() == false) {

            header("location: http://localhost/webpage/?oldal=login&error=invalidEmail");
            exit();
        }

        if ($this->pwdMatch() == false) {

            header("location: http://localhost/webpage/?oldal=login&error=invalidPwd");
            exit();
        }

        if ($this->uidTakenCheck() == false) {

            header("location: http://localhost/webpage/?oldal=login&error=UsernameOrPasswordTaken");
            exit();
        }

        $this->setUser($this->uid, $this->pwd, $this->email);
    }



    private function emptyInput()
    {
        $result = false;
        if (empty($this->uid || $this->pwd || $this->pwdRpeat || $this->email)) {

            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }


    private function invalidUid()
    {
        $result = false;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail()
    {
        $result = false;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function pwdMatch()
    {
        $result = false;

        if ($this->pwd !== $this->pwdRpeat) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function uidTakenCheck()
    {
        $result = false;

        if (!$this->checkUser($this->uid, $this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
