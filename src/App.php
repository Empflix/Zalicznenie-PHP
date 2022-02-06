<?php
namespace Pos;

use login\Login;
use menu\Menu;

class App
{
    public function run()
    {
        while(true)
        {
              $login = new Login();
              $user = $login->getUser();
              $menu = new Menu($user);
              $menu->showMenu();

        }

    }





}