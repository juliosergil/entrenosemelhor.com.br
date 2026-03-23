
<? if(file_exists(getcwd()."/include/mod/maps.inc")) { ?>

	 <!DOCTYPE html> 
	<body> 
	   <!-- <script src="https://code.jquery.com/jquery-1.8.1.js" type="text/javascript"></script> -->
		<script src="https://maps.google.com/maps/api/js?sensor=false"></script>   
		
		 <!-- <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmmA2l-jLY-dz1YEolMShZ12g8RCOwi6k&callback=initMap"></script>-->
		

			<script type="text/javascript">
				function CalculaDistancia() {
					$('#litResultado').html('Aguarde...');
					//Instanciar o DistanceMatrixService
					var service = new google.maps.DistanceMatrixService();
					//executar o DistanceMatrixService
					service.getDistanceMatrix(
					  {
						  //Origem
						  origins: [$("#txtOrigem").val()],
						  //Destino
						  destinations: [$("#txtDestino").val()],
						  //Modo (DRIVING | WALKING | BICYCLING)
						  travelMode: google.maps.TravelMode.DRIVING,
						  //Sistema de medida (METRIC | IMPERIAL)
						  unitSystem: google.maps.UnitSystem.METRIC
						  //Vai chamar o callback
					  }, callback);
				}
				//Tratar o retorno do DistanceMatrixService
				function callback(response, status) {
					//Verificar o Status
					if (status != google.maps.DistanceMatrixStatus.OK)
						//Se o status não for "OK"
						$('#litResultado').html(status);
					else {
						//Se o status for OK 
						$("#map").attr("src", "https://maps.google.com/maps?saddr=" + response.originAddresses  + "&output=embed");
					}
				}
			</script>
	 
			<div><span id="litResultado">&nbsp;</span></div>
			<div style="padding: 10px 0 0; clear: both">
				<iframe width="100%" scrolling="no" height="350" frameborder="0" id="map" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?saddr=<?=utf8_encode($_REQUEST['endereco'])?>&output=embed"></iframe>
			</div>
	</body>
	</html>

<? } ?>
