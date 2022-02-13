<?php

namespace Pos\Menu;

use JetBrains\PhpStorm\NoReturn;
use JetBrains\PhpStorm\Pure;
use Pos\App;
use Pos\Csv\CsvReader;
use Pos\Csv\CsvWriter;
use Pos\DishMenu\DishMenu;


class Menu
{
    private $user;
    private $dishMenu;

    #[Pure] public function __construct($user)
    {
        $this->user = $user;
        $this->dishMenu = new DishMenu();
    }

    #[NoReturn] public function showMenu()
    {
        while (true) {
            $this->userInstruction();
            $parm = readline();
            echo "Options: " . PHP_EOL;
            switch ($parm) {
                case "addU":
                    $this->addUser();
                    break;
                case "salH":
                    $this->dishMenu->salesHistory();
                    break;
                case "addD":
                    $this->dishMenu->newItem();
                    break;
                case 1:
                    self::fastOrder();
                    break;
                case "logO":
                case 2:
                    $start = new App();
                    $start->run();
                    break;
                case 3:
                case "exit":
                    exit();


            }
        }

    }

    public function userInstruction()
    {
        if ($this->adminIsLoggedIn()) {
            echo " addU   --> Add new user" . PHP_EOL;
            echo " addD   --> Add new dish" . PHP_EOL;
            echo " salH   --> Sales history" . PHP_EOL;
            echo " logO   --> Logout" . PHP_EOL;
            echo " exit  --> Exit" . PHP_EOL;


        } else {
            echo " 1  --> Quick sale" . PHP_EOL;
            echo " 2  --> Logout" . PHP_EOL;
            echo " 3  --> Exit" . PHP_EOL;

        }

    }

    public function adminIsLoggedIn(): bool
    {
        if ($this->user === "0000") {
            return true;
        } else {
            return false;
        }

    }

    public function fastOrder()
    {
        $cart = [];
        $parm = true;


        while ($parm) {
            $parm1 = true;

            while ($parm1) {
                $menu = new CsvReader('menu');
                $menu = $menu->readCsv();
                $countMenu = count($menu);


                $this->dishMenu->showDishMenu();

                $choiceNumber = readline();
                $choiceNumber = intval($choiceNumber);
                if (is_numeric($choiceNumber) and $choiceNumber <= $countMenu) {
                    break;
                }

                echo "Try again Mordko :)" . PHP_EOL.PHP_EOL;
            }


            echo "Successfully added to the cart." . PHP_EOL;
            $this->dishMenu->showItem($choiceNumber);
            $item = $this->dishMenu->addToCart($choiceNumber);

            array_push($cart, $item);
            echo "----------------------" . PHP_EOL;
            echo "-------- Cart --------" . PHP_EOL ;
            $this->dishMenu->showItem($cart);
            echo "----------------------" . PHP_EOL . PHP_EOL;

            $parm2 = true;
            while ($parm2) {
                echo "Is that all?" . PHP_EOL;
                echo "Yes/No" . PHP_EOL;
                $answer = readline();
                switch (strtolower($answer)) {
                    case "yes":
                        $this->dishMenu->showBill($cart);
                        $this->dishMenu->addToOrders($cart);
                        $parm = false;
                        $parm2 = false;
                        break;

                    case "no":
                        $parm2 = false;
                        break;

                }
            }
        }


    }

    public function addUser()

    {
        echo "Name :" . PHP_EOL;
        $name = readline();
        echo "Login :" . PHP_EOL;
        $login = readline();
        $var = true;
        while ($var) {
            echo "Password :" . PHP_EOL;
            $pass1 = readline();
            echo "Repeat password :" . PHP_EOL;

            $pass2 = readline();
            if ($pass1 === $pass2) {
                $var = false;

            } else {
                echo "Passwords do not match. Try again." . PHP_EOL;
            }
        }
        $array = array(array($login, $pass2, $name));
        $this->addSeller($array);
        echo "Employee added :)" . PHP_EOL;

    }

    public function addSeller($array)
    {
        $newSeller = new CsvWriter($array);
        $newSeller->writeCsv('user');
    }

}