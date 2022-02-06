<?php

namespace login;

class Login
{
    private $user;
    private $password;

    public function logIn()
    {
        while(true)
        {
            echo "Login";
            $this->user=readline();
            echo "Password";
            $this->password=readline();


        }
    }
    public function  checkLoginDetails($user,$password)
    {
        
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