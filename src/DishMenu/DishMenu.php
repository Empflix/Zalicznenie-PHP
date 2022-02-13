<?php

namespace Pos\DishMenu;

use Pos\Csv\CsvReader;
use Pos\Csv\CsvWriter;

class DishMenu
{
    public function showDishMenu()
    {
        $menu = new CsvReader('menu');
        $menu = $menu->readCsv();

        for ($i = 0; $i < count($menu); $i++) {
            $j = $i + 1;
            echo $j . "." . $menu[$i][0] . " " . $menu[$i][1] . " " . $menu[$i][2] . "zł" . PHP_EOL;
            echo "" . PHP_EOL;
        }

    }

    public function showItem($parm)
    {
        $item = new CsvReader('menu');
        $item = $item->readCsv();
        if (is_integer($parm)) {
            echo $parm . "." . $item[$parm - 1][0] . " " . $item[$parm - 1][1] . " " . $item[$parm - 1][2]  . PHP_EOL;
            echo "" . PHP_EOL;
            return $item;
        } elseif (is_array($parm)) {

            for ($i = 0; $i < count($parm); $i++) {

                echo $parm[$i] . PHP_EOL;
            }
            return $parm;
        }

    }

    public function addToCart($parm)
    {
        $item = new CsvReader('menu');
        $item = $item->readCsv();
        return $item[$parm - 1][0] . " " . $item[$parm - 1][1] . " " . $item[$parm - 1][2];


    }

    public function showBill($cart)
    {
        echo "----------------------" . PHP_EOL ;
        echo "-------- Cart --------" . PHP_EOL ;
        self::showItem($cart);
        echo "----------------------" . PHP_EOL . PHP_EOL;
        echo "Total:" . PHP_EOL;
        echo self::addUpBill($cart)." zł." . PHP_EOL . PHP_EOL;

    }

    public function addUpBill($cart)
    {
        $sum = 0;
        for ($i = 0; $i < count($cart); $i++) {
            $value = intval(substr($cart[$i], -2));
            $sum += $value;
        }
        return $sum;

    }

    public function addToOrders($cart)
    {
        $cart = array($cart);
        $csv = new CsvWriter($cart);
        $csv->writeCsv('order');

    }

    public function salesHistory()
    {
        $csv = new CsvReader('order');
        $csv = $csv->readCsv('"');
        var_dump($csv);
        $int=0;
        for ($i=0;$i<count($csv);$i++)
        {
            $int++;
            echo $int.":".PHP_EOL;
            for($j=0;$j<count($csv[$i]);$j++)
            {
                if ($csv[$i] !== null) {
                    if(strlen($csv[$i][$j])>5) {

                        echo  $csv[$i][$j] . PHP_EOL;
                    }
                }
            }

        }
        echo "".PHP_EOL.PHP_EOL;


    }

    public function newItem()
    {
        $var = true;
        while ($var) {
            echo "Add the dish" . PHP_EOL;
            echo "Enter the name" . PHP_EOL;
            $name = readline();
            echo "Description" . PHP_EOL;
            $description = readline();
            echo "Price" . PHP_EOL;
            $price = readline();
            echo "Are you sure you want to add  :" . PHP_EOL;
            echo $name . " " . $description . " " . $price . PHP_EOL;
            echo "Yes/No:" . PHP_EOL;
            $choice = readline();
            $choice = trim(strtolower($choice));

            if ($choice == "yes" ) {
                $array = array(array($name, $description, $price));
                $newItem = new CsvWriter($array);
                $newItem->writeCsv('menu');
                $this->showDishMenu();
                $var = false;
            }
        }


    }


}