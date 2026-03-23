<?php include template("manage_header"); ?>

<? 
// --- Bloco PHP: Configuração de Cores Padrão (Lógica Preservada) ---
if ($INI['cores']['homeTop'] == "") { $INI['cores']['homeTop'] = "#F78338"; }
if ($INI['cores']['backcidade'] == "") { $INI['cores']['backcidade'] = "#FFF4A6"; }
if ($INI['cores']['icon-backgroundhover'] == "") { $INI['cores']['icon-backgroundhover'] = "#f78323"; }
if ($INI['cores']['links'] == "") { $INI['cores']['links'] = "#007bff"; }
if ($INI['cores']['lupa'] == "") { $INI['cores']['lupa'] = "#007bff"; }
if ($INI['cores']['adpremium'] == "") { $INI['cores']['adpremium'] = "#F6F6F6"; }
if ($INI['cores']['recommendation'] == "") { $INI['cores']['recommendation'] = "#fff"; }
if ($INI['cores']['galpremium'] == "") { $INI['cores']['galpremium'] = "#333"; }
if ($INI['cores']['adrecomendados'] == "") { $INI['cores']['adrecomendados'] = "#fff"; }
if ($INI['cores']['nav-link'] == "") { $INI['cores']['nav-link'] = "#333"; }
if ($INI['cores']['navbar-light'] == "") { $INI['cores']['navbar-light'] = "#fff"; }
if ($INI['cores']['bgheader'] == "") { $INI['cores']['bgheader'] = "#ececec"; }
if ($INI['cores']['btn-add'] == "") { $INI['cores']['btn-add'] = "#F70"; }
if ($INI['cores']['subtitle'] == "") { $INI['cores']['subtitle'] = "#f70"; }
if ($INI['cores']['cormapa'] == "") { $INI['cores']['cormapa'] = "#b8d21b"; }
if ($INI['cores']['not-found'] == "") { $INI['cores']['not-found'] = "#642982"; }
if ($INI['cores']['price-list-offer'] == "") { $INI['cores']['price-list-offer'] = "#929e32"; }
if ($INI['cores']['price-box'] == "") { $INI['cores']['price-box'] = "#929E32"; }
if ($INI['cores']['info-block'] == "") { $INI['cores']['info-block'] = "#fff4a6"; }
if ($INI['cores']['welcome'] == "") { $INI['cores']['welcome'] = "#303030"; }
if ($INI['cores']['fill'] == "") { $INI['cores']['fill'] = "#999"; }
if ($INI['cores']['rodape'] == "") { $INI['cores']['rodape'] = "#303030"; }
if ($INI['cores']['txtrodape'] == "") { $INI['cores']['txtrodape'] = "#fff"; }
if ($INI['cores']['color_qtd_vendido'] == "") { $INI['cores']['color_qtd_vendido'] = "#FF7300"; }
if ($INI['cores']['color_contadornovo'] == "") { $INI['cores']['color_contadornovo'] = "#80B300"; }
if ($INI['cores']['color_fundo_news'] == "") { $INI['cores']['color_fundo_news'] = "#494f59"; }
if ($INI['cores']['color_fundo_laterais_rodape'] == "") { $INI['cores']['color_fundo_laterais_rodape'] = "#D3E5EF"; }
if ($INI['cores']['color_fundo_meio_rodape'] == "") { $INI['cores']['color_fundo_meio_rodape'] = "#226D97"; }
if ($INI['cores']['titulo_destaque'] == "") { $INI['cores']['titulo_destaque'] = "#303030"; }
if ($INI['cores']['background_titulo_destaque'] == "") { $INI['cores']['background_titulo_destaque'] = "#fff"; }
if ($INI['cores']['background_titulos'] == "") { $INI['cores']['background_titulos'] = "#0173C9"; }
if ($INI['cores']['background_oferta_nacional'] == "") { $INI['cores']['background_oferta_nacional'] = "#B33191"; }
if ($INI['cores']['cor_letra_topo'] == "") { $INI['cores']['cor_letra_topo'] = "#fff"; }
if ($INI['cores']['botaodetalhe'] == "") { $INI['cores']['botaodetalhe'] = "#222222"; }
if ($INI['cores']['botaodetalhehover'] == "") { $INI['cores']['botaodetalhehover'] = "#303030"; }
if ($INI['cores']['fundooferta'] == "") { $INI['cores']['fundooferta'] = "#fff"; }
if ($INI['cores']['topodetalhe'] == "") { $INI['cores']['topodetalhe'] = "url(/skin/padrao/background/body-bg11.png)"; }
if ($INI['cores']['rodapedetalhe'] == "") { $INI['cores']['rodapedetalhe'] = "#fff"; }
if ($INI['cores']['btfinaliza'] == "") { $INI['cores']['btfinaliza'] = "#007D9A"; }
if ($INI['cores']['btfinalizahover'] == "") { $INI['cores']['btfinalizahover'] = "#336699"; }
if ($INI['cores']['rodapesup'] == "") { $INI['cores']['rodapesup'] = "#303030"; } 
?>

<style type="text/css" media="screen">
	/* Estilos do Farbtastic (Preservados) */
	.colorwell {
		border: 2px solid #fff;
		width: 80px; 
		text-align: center;
		cursor: pointer;
		height: 30px; 
		padding: 0;
		box-sizing: border-box;
		display: inline-block;
	}
	body .colorwell-selected {
		border: 2px solid #000;
		font-weight: bold;
	}
	
	/* Layout Responsivo, Centralização e Spacing Aprimorado */
	.centered-container {
		max-width: 1200px; 
		margin: 0 auto; 
		padding: 5px; 
	}

	.content-wrapper {
		display: flex;
		flex-wrap: wrap; 
		width: 100%;
		box-sizing: border-box;
	}
	.main-content {
		width: 100%; 
		padding: 0 15px;
		box-sizing: border-box;
	}
	.sidebar-picker {
		width: 100%; 
		padding: 20px 15px 0 15px;
		box-sizing: border-box;
	}
	
	/* Seções de Imagem/Cor (HEADER, RECOMENDADOS, PREMIUM) */
	.section-row-clean {
		display: flex;
		flex-wrap: wrap;
		margin-bottom: 25px; 
		padding: 20px; 
		border: 1px solid #ddd;
		background: #fcfcfc;
	}
	/* Coluna 50% */
	.col-50-clean {
		width: 100%; 
		padding: 10px;
		box-sizing: border-box;
		display: flex;
		flex-direction: column;
		align-items: flex-start;
	}
	
	/* Centraliza o H1 "Ou escolha uma COR" */
	.col-50-clean h1 {
		width: 100%; 
		text-align: center; 
		margin-top: 0; 
		margin-bottom: 10px;
	}

	/* Alinhamento da Coluna de Cores (Input + Link) */
	.color-input-group {
		display: flex;
		flex-direction: column;
		align-items: center; 
		margin-top: 10px;
		margin: 10px auto 0 auto; 
	}
	.color-input-group span {
		font-size: 12px;
	}
	.image-upload-group {
		/* Mantendo a estrutura anterior que causava o "embolamento" */
		display: flex;
		flex-direction: column;
		gap: 5px; 
	}
	.image-upload-group div {
		font-size: 12px;
	}
	
	/* NOVO/REFORÇADO: Estilo para Links de Ação (CTAs) */
	.cta-link {
		color: #007bff; /* Azul forte */
		font-weight: bold;
		text-decoration: underline;
		line-height: 1.5; /* Ajuda a "desembolar" o texto sem mexer no padding externo */
	}
	.cta-link-icon {
		color: #007bff;
		font-weight: bold;
		text-decoration: none;
		display: flex;
		align-items: center;
		gap: 5px;
		line-height: 1.5;
	}
	.link-detalhe {
		color: #333;
		font-weight: normal;
		text-decoration: underline;
		font-size: 12px;
		line-height: 1.5;
	}
	
	/* Outras Cores (Layout de Tabela mais limpo) */
	.color-setting-item {
		display: flex;
		align-items: center;
		margin-bottom: 12px;
	}
	.color-setting-item .label {
		flex-basis: 75%;
		padding-right: 15px;
		font-size: 13px;
	}
	.color-setting-item .control {
		flex-basis: 25%;
	}
	
	/* Topo da Seção */
	.top-heading h4 {
		margin: 0;
		padding: 16px;
	}
	
	/* Centraliza o Seletor de Cores (Picker) */
	.picker-sticky {
		position: sticky; 
		top: 20px; 
		border: 1px solid #ddd; 
		padding: 15px; 
		background: #fff;
		text-align: center;
		display: flex;
		flex-direction: column;
	}
	#picker {
		margin: 0 auto; 
	}


	@media (min-width: 768px) {
		.col-50-clean {
			width: 50%; 
		}
		.color-setting-item .label {
			font-size: 14px;
		}
	}

	@media (min-width: 992px) {
		/* Desktop layout: Content (70%) and Picker (30%) */
		.main-content {
			width: 70%;
			padding-right: 25px;
		}
		.sidebar-picker {
			width: 30%;
			padding: 0 15px;
		}
	}
</style>

<script type="text/javascript" charset="utf-8">
	// Lógica do Farbtastic (Preservada)
	$(document).ready(function() {
		$('#demo').hide(); 
		
		var f = $.farbtastic('#picker');
		var p = $('#picker'); 
		var selected;
		
		$('.colorwell')
		.each(function () { 
			f.linkTo(this); 
			$(this).css('opacity', 0.75); 
			// Inicializa o background color do input com o valor (melhora o visual)
			$(this).css('background-color', $(this).val()); 
		})
		.focus(function() {
			if (selected) {
				$(selected).css('opacity', 0.75).removeClass('colorwell-selected');
			}
			f.linkTo(this);
			p.css('opacity', 1);
			$(selected = this).css('opacity', 1).addClass('colorwell-selected');
		})
		.trigger('focus');

		// Garante que a cor seja atualizada no input ao mudar no picker
		f.linkTo(function(color) {
			$(selected).css('background-color', color);
		});
	});
	
	function validador(){
		return true;
	}
	
	function doupdate() {
		$('form').submit();
	}
	
	function buscafoto(file) {
		// Função placeholder
		return;
	}
</script>


<div id="bdw" class="bdw">
	<div id="bd" class="cf">
		<div id="partner">
			<div id="content" class="clear mainwide">
				<div class="clear box">
					<div class="box-content">
						<div class="sect">
							<form method="post">
								<div class="option_box">
									<div class="top-heading group">
										<div class="left_float"><h4>Alteração de cores do site</h4></div>
										<div class="the-button" style="width:257px;">
											<button onclick="doupdate();" id="run-button" class="input-btn" type="button">
												<div name="spinner-top" id="spinner-top" style="width: 83px; display: block;"><img name="imgrec" id="imgrec" src="<?= $ROOTPATH ?>/media/css/i/lendo.gif" style="display: none;"></div>
												<div id="spinner-text">Salvar</div>
											</button>
										</div>
									</div>
									
									<div class="centered-container">
										<div class="content-wrapper">
											
											<div class="main-content">
											
												<?php 
												$sections = ['header', 'recomendados', 'premium'];
												foreach ($sections as $tipo): 
													$nomecor = "cor_".$tipo;
												?>
												<div class="option_box">
													<div class="top-heading group">
														<div class="left_float"><h4>SESSÃO <?=strtoupper($tipo)?></h4></div>
													</div>
													<div id="container_box">
														<div id="option_contents" class="option_contents">
															
															<div class="section-row-clean">
																<div class="col-50-clean">
																	<h1 style="font-size: 18px; margin-bottom: 10px; text-align: left;" >Escolha uma IMAGEM </h1>
																	
																	<!--
																	<span class="cpanel-date-hint" style="margin-bottom: 10px;"><a href="javascript:buscafoto('img<?= array_search($tipo, $sections) + 1 ?>.png');" class="link-detalhe">Ver Imagens Sugeridas</a></span>														
																	-->
																	<div class="image-upload-group">
																		<div style="display: flex; align-items: center; gap: 5px;">
																			<a href="/vipmin/system/header.php?tipo=<?=$tipo?>" class="cta-link-icon"> <img src="<?=$ROOTPATH?>/media/css/i/background.png" style="max-width: 40px;">Fazer Upload da Imagem</a>
																		</div>
																		<div> 
																			<a target="_blank" href="https://pixabay.com/pt/images/search/" class="link-detalhe">Baixar imagens grátis (Pixabay)</a>. Dimensão sugerida:  1920px largura X 1280px altura 
																		</div>
																	</div>
																</div>
																
																<div class="col-50-clean">
																	<h1 style="font-size: 18px; clear: both; margin-bottom: 10px;" >Ou escolha uma COR </h1> 
																	<div class="color-input-group">
																		<input type="text"  name="cores[<?= $nomecor ?>]"  class="colorwell" value="<?php echo $INI['cores'][$nomecor]; ?>" style="background-color: <?php echo $INI['cores'][$nomecor]; ?>;" />
																		<span><a href="/vipmin/system/header.php?tipo=<?=$tipo?>" class="cta-link">Desativar Imagem (Usar Cor) </a></span>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<?php endforeach; ?>
											
												<div class="option_box">
													<div class="top-heading group">
														<div class="left_float"><h4>Outras Cores </h4></div>
													</div>
													<div id="container_box">
														<div id="option_contents" class="option_contents">
															<div class="section-row-clean" style="border: none; padding: 0; background: none;">
																<div class="col-50-clean" style="align-items: stretch;">
																	<?php
																	$other_colors_left = [
																		'icon-backgroundhover' => 'Cor do fundo dos icones de categoria(ao passar o mouse)',
																		'btn-add' => 'Cor dos botões',
																		'recommendation' => 'Cor do texto título recomendação',
																		'galpremium' => 'Cor do texto título galeria premium',
																		'lupa' => 'Cor da lupa (pesquisa)',
																		'links' => 'Cor dos Links',
																		'adpremium' => 'Fundo background anuncios premium (home)',
																		'backcidade' => 'Fundo background cidades (detalhe anúncio)',
																	];
																	foreach ($other_colors_left as $key => $label): ?>
																		<div class="color-setting-item">
																			<div class="label"><?= $label ?>:</div>
																			<div class="control">
																				<input type="text" name="cores[<?= $key ?>]" class="colorwell" value="<?php echo $INI['cores'][$key]; ?>" style="background-color: <?php echo $INI['cores'][$key]; ?>;" />
																			</div>
																		</div>
																	<?php endforeach; ?>
																</div>
																<div class="col-50-clean" style="align-items: stretch;">
																	<?php
																	$other_colors_right = [
																		'adrecomendados' => 'Fundo background recomendados (home)',
																		'nav-link' => 'Textos do topo (cabeçalho)',
																		'navbar-light' => 'Fundo do topo (cabeçalho)',
																		'rodapesup' => 'Rodape',
																		'color_qtd_vendido' => 'Cor da Quantidade Vendida',
																		'color_contadornovo' => 'Cor do Contador (Oferta)',
																	];
																	foreach ($other_colors_right as $key => $label): ?>
																		<div class="color-setting-item">
																			<div class="label"><?= $label ?>:</div>
																			<div class="control">
																				<input type="text" name="cores[<?= $key ?>]" class="colorwell" value="<?php echo $INI['cores'][$key]; ?>" style="background-color: <?php echo $INI['cores'][$key]; ?>;" />
																			</div>
																		</div>
																	<?php endforeach; ?>

																	<div style="margin-top: 25px; font-size: 11px; padding: 10px; border: 1px solid #eee; background: #fff;">
																		Note que se o componente ou elemento que você está tentando alterar a cor, e não conseguiu alterar por aqui, então possivelmente este componente não é um elemento de cor, e sim uma imagem
																		Para alterar imagens <a href="/vipmin/system/imagens.php" class="link-detalhe">Acesse a página de Imagens</a>.
																		Opcionalmente você pode alterar qualquer elemento seja cor ou imagem via código fonte utilizando códigos html ou css acessando o seu FTP diretamente no servidor <a target="_blank" href="http://www.youtube.com/watch?feature=player_embedded&v=sWmklZh5dqc" class="link-detalhe">Veja nosso vídeo explicativo</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											
											</div> <div class="sidebar-picker">
												<div class="picker-sticky">
													<h4 style="margin-bottom: 15px;">Seletor de Cores</h4>
													<div id="picker" style="opacity: 0.25;"></div>
												</div>
											</div>
											
										</div> </div> </div>
							</form>
						</div>
					</div>
					<div class="box-bottom"></div>
				</div>
			</div>

			<div id="sidebar">
			</div>

		</div>
	</div> </div> <script>
	// Preserved JS for Upload Feedback
	function stopUpload(file,param){
		var result = '';
		if (file != ""){
			jQuery(document).ready(function(){ 
				$.get("<?= $INI['system']['wwwprefix'] ?>/vipmin/update_background.php?file="+file+"&param="+param,
				function(data){
					if(jQuery.trim(data)==""){
						jQuery.colorbox({html:"<font color=blue>O arquivo foi carregado com sucesso. Agora acesse o site e aperte CTRL + F5 para remover o cache do navegador. Agora vá para a área pública e atualize a página (crtl+f5)</font>"});
					}
					else{
						// handle error
					}
				});
			});
		}
		else {
			jQuery(document).ready(function(){ 
				jQuery.colorbox({html:"<font color=red>Não foi possível enviar o arquivo.</font>"});
			});
		}
		return true;
	}
</script>