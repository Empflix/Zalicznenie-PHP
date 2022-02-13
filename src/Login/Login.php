<?php

namespace Pos\Login;


use Pos\Csv\CsvReader;

class Login
{
    private $user;
    private $password;

    public function logIn()
    {

        while (true) {
            echo "Login:  ";
            $this->user = readline();
            echo "Password:  ";

            $this->password = readline();
            $correctdata = $this->checkLoginDetails($this->user, $this->password);

            if ($correctdata == false) {

                return $this->user;

            } else {
                echo "Wrong login or password." . PHP_EOL;
            }


        }
    }

    public function checkLoginDetails($user, $password): bool
    {

        $dat = new CsvReader('user');
        $data = $dat->readCsv();

        for ($i = 0; $i < count($data); $i++) {

            if ($data[$i][0] === $user and $data[$i][1] === $password) {

                return false;
            }

        }


        return true;
    }


    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }




}