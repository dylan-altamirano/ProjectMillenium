<?php 
    function contadorVisitas()
 {
   $a = file("contador.data");
   $b = $a[0];
   
   if(isset($COOKIE['conteo']) && $COOKIE['conteo'] == 1)
   {
	   
   }else{
	   $b =$b+1;
	   $conteo = fopen("contador.data","w");
	   fwrite($conteo, $b);
	   fclose($conteo);
	   setcookie("conteo", "1");
   }
   return $b;
  }
?>