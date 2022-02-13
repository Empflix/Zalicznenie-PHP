<?php
namespace Pos;


use JetBrains\PhpStorm\NoReturn;
use Pos\Login\Login;
    use Pos\Menu\Menu;

    class App
    {
        #[NoReturn] public function run()
        {
            while(true)
            {
                $login = new Login();
                $user = $login->logIn();

                $menu = new Menu($user);
                $menu->showMenu();

            }

        }





    }
