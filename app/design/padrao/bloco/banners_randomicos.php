<div style="display:none;" class="tips"><?=__FILE__?></div> 
	
 <!-- modulo de banners aleatorios perfil -->
 <? 
 $ran = array(1,2,3,4,5,6,7,8,9,10);
$randomElement = $ran[array_rand($ran, 1)];


 for($i = 1;$i <11; $i++) {
	   $randomElement = $ran[array_rand($ran, 1)];
	   if(empty($INI['bulletin'][$randomElement])){
		   continue;
	   }
	   else{
		   break;
	   }
   }  ?>
   
 <? if(!empty($INI['bulletin'][$randomElement])){?>
	 <DIV style="text-align:center;"><?php echo  $INI['bulletin'][$randomElement]; ?> </DIV>  
  <? } ?>
 
 <!-- // fim  -->