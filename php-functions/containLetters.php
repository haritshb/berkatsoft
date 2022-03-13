<?php

    function containLetters($firstWord, $secondWord){
        $total_found = 0;
        $length = strlen($firstWord);
        for ($x = 0; $x < $length; $x++) {
            $chr = substr($firstWord, $x, 1);            
            if(strpos(strtolower($secondWord), $chr) !== false){
                $total_found = $total_found + 1;
            }  
        }

        if($total_found < 3){
            return false;
        }else{
            return true;
        }
    }

    var_dump((bool) containLetters('brs', 'berkatsoft'));
    var_dump((bool) containLetters('brs', 'berkatco'));
    var_dump((bool) containLetters('brs', 'BERKATsoft'));
?>