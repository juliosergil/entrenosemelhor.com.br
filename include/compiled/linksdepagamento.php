<div style="display:none;" class="tips"><?=__FILE__?></div>  
<?

if(!file_exists(WWW_MOD."/gateway.inc")) { 

	  if( $row['linkpagamento']) { ?>
			<div class="pricing-footer" id="" data-valor="<?=$row['valor']?>" data-nome="<?=utf8_decode($row['nome'])?>" data-idplano="<?=utf8_decode($row['id'])?>">
				<?php if(isset($login_user[id])) { ?>
					<a target="_blank" href="<?=$row['linkpagamento']?>" class="btn yellow-crusta"> CONTINUAR </a>
				<? }else{ ?>
					<a   href="<?=$ROOTPATH?>/login" class="btn yellow-crusta"> CONTINUAR </a>
				<?  } ?>
			</div>
	 <? }
		else if($row['id'] == 10){ // gratis?> 
		
		<?php if(isset($login_user[id])) { ?>
				<div class="pricing-footer" id="btn_assine" data-valor="<?=$row['valor']?>" data-nome="<?=utf8_decode($row['nome'])?>" data-idplano="<?=utf8_decode($row['id'])?>">
					<a target="_blank" href="<?=$ROOTPATH?>/adminanunciante/team/edit.php?idplano=10" class="btn yellow-crusta"> CONTINUAR </a>
				</div>
			<? }else{ ?>						 
				<div class="pricing-footer" id="btn_assine" data-valor="<?=$row['valor']?>" data-nome="<?=utf8_decode($row['nome'])?>" data-idplano="<?=utf8_decode($row['id'])?>">
					<a   href="<?=$ROOTPATH?>/login" class="btn yellow-crusta"> CONTINUAR </a>
				</div>
			<? } ?>						 
	 <? } ?>
	 
<? }
else{ 
  
	if(isset($login_user[id])) { ?>
	
		<div class="pricing-footer" id="btn_assine" data-valor="<?=$row['valor']?>" data-nome="<?=utf8_decode($row['nome'])?>" data-idplano="<?=utf8_decode($row['id'])?>">
			<a target="_blank" href="<?=$ROOTPATH?>/adminanunciante/team/edit.php?idplano=<?=$row['id']?>" class="btn yellow-crusta"> CONTINUAR </a>
		</div>
	
	<? }else{ ?>						 
		
		<div class="pricing-footer" id="btn_assine" data-valor="<?=$row['valor']?>" data-nome="<?=utf8_decode($row['nome'])?>" data-idplano="<?=utf8_decode($row['id'])?>">
			<a   href="<?=$ROOTPATH?>/login" class="btn yellow-crusta"> CONTINUAR </a>
		</div>
	
	<? } ?>						 
	 
								
<? } ?>