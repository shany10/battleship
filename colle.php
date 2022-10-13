<?php

colle(4, 4 , []);

function colle($x, $y, $player)
{
    $croix = " ";
    
    for ($int = 0; $int < $y; $int++) {

        echo "+";

        for ($i = 0; $i < $x; $i++) {
            echo "---+";
        }

        echo "\n";

        echo "|";
        for ($i = 0; $i < $x; $i++) {
            if(!count($player) == 0) {
                // var_dump($player[]);
                // return;
                foreach($player as $value){
                    if($value[0] == $i && $value[1] == $int) {
                        $croix = "X";
                    }
                }
            }
          
            echo " $croix |";
            $croix = " ";
        }
        echo "\n";

        if ($int + 1 == $y) {
            echo "+";
            for ($i = 0; $i < $x; $i++) {
                echo "---+";
            }
            echo "\n";
        }
    }

    cli($player , $bool = null , $pl = null);
}

function cli($player , $bool , $pl)
{
    if($bool == null && $pl == null) {
        $bool = 0;
        $pl = 1;
    }
 
    if($bool == 0 || $bool == 1) {
        $pl = 1;
    }

    if($bool == 2 || $bool == 3) {
        $pl = 2;
    }

    if($bool  == 0 || $bool == 2) {
        array_push($player , []);
        echo "Player $pl, place your 2 ships :\n";
    }
    $line = readline("$>");
    readline_add_history($line);
    $arr = explode(" ", $line);
    if(count($arr) > 1 ) {
        $str = str_replace("[" , "" , $arr[1]);
        $str = str_replace("]" , "" , $str);
        $str = str_replace("," , " " , $str);
        $arr_cli = explode(" " , $str);
    }

    switch ($arr[0]) {
        case 'query':
            query($player ,$arr_cli , $bool , $pl);
            break;
        case 'add':
            add($player ,$arr_cli , $bool , $pl);
            break;
        case 'remove':
            remove($player ,$arr_cli , $bool ,$pl);
            break;
        case 'display':
            display($player[$pl-1]);
            break;
        case $arr[0]:
            echo "l'option que vous avez choisi n'existe pas\n";
            cli($player , $bool, $pl);
            break;
    }



}

function query($player , $arr_cli , $bool , $pl) {
   if(!count($player)) {
    foreach($player[$pl-1] as $value) {
        if($value[0] == $arr_cli[0] && $value[1] == $arr_cli[1]) {
            echo "full\n";
            cli($player , $bool , $pl);
            return;
        }
    }
   }
    echo "empty\n";
    cli($player , $bool, $pl);
}

function add($player , $arr_cli , $bool , $pl) {

    if(!count($player) == 0) {
    foreach($player[$pl-1] as $value) {
        if($value[0] == $arr_cli[0] && $value[1] == $arr_cli[1]) {
            echo "A cross already exists at this location\n";
            cli($player , $bool, $pl);
            return;
        }
    }
}
    $bool += 1; 
    echo $bool."\n";
    array_push($player[$pl-1] , $arr_cli);
    cli($player , $bool, $pl);
}

function remove($player ,$arr_cli , $bool , $pl) {
    if(!count($player)) {
    foreach($player[$pl-1] as $key => $value) {
        if($value[0] == $arr_cli[0] && $value[1] == $arr_cli[1]) {
            unset($player[$key]);
            var_dump($player);
            cli($player , $bool, $pl);
            return;
        }
    }
}
    echo "No cross exists at this location\n";
    cli($player , $bool, $pl);

}

function display($player) {
    colle(4 , 4 , $player);
}