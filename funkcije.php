<?php

function provjeriOIB($oib){
    if(strlen($oib) != 11){
    	 return FALSE;   
	}
        if(is_numeric($oib)){
            $a = 10;
            for($i = 0; $i < 10; $i++){
                $a = $a + intval(substr($oib, $i, 1), 10);
                $a = $a % 10;
                if($a == 0){$a = 10;}
                $a *= 2;
                $a = $a % 11;
            }
            $control = 11 - $a;
            if($control == 10){$control = 0;}
            return $control == intval(substr($oib, 10, 1), 10);
        }else{
            return FALSE;
        }
   
}