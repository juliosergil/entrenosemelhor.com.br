 <?php  
require_once("include/head.php"); ?>
 
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Parceiros</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container { 
            margin: 0 auto;
            padding: 20px;
        }

        .titpages {
            font-size: 26px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 10px;
        }

        .contentpage {
            text-align: center;
            line-height: 1.8;
        }

        .contentpage a {
            display: inline-block;
            color: #0066cc;
            text-decoration: none;
            word-wrap: break-word;
            padding: 5px 0;
            transition: color 0.3s;
        }

        .contentpage a:hover {
            color: #003366;
        }

        @media (max-width: 600px) {
            .titpages {
                font-size: 22px;
            }

            .contentpage a {
                font-size: 14px;
            }
        }
    </style>
</head>


<body id=""> 
	<div>
	<?php  ?>
		<div class="">
		
			<?php  require_once(DIR_BLOCO."/header.php"); ?> 
			 
			 
			<div class="container">
					<div class="titpages">Parceiros</div>
					<div class="contentpage">
						<a target="_blank" href="https://www.vipcomsistemas.com.br">https://www.vipcomsistemas.com.br</a><br>
						<a target="_blank" href="http://www.vipcomsites.com.br">http://www.vipcomsites.com.br</a><br>
						<a target="_blank" href="http://www.sistemacomprascoletivas.com.br">http://www.sistemacomprascoletivas.com.br</a><br>
						<a target="_blank" href="http://www.criarsiteclassificados.com.br">http://www.criarsiteclassificados.com.br</a><br>
						<a target="_blank" href="http://www.guiacomercialscript.com.br">http://www.guiacomercialscript.com.br</a><br>
						<a target="_blank" href="http://www.scriptdeguiacomercial.com.br">http://www.scriptdeguiacomercial.com.br</a><br>
						<a target="_blank" href="http://www.sistemaclassificados.com.br">http://www.sistemaclassificados.com.br</a><br>
						<a target="_blank" href="http://www.scriptacompanhante.com.br">http://www.scriptacompanhante.com.br</a><br>
						<a target="_blank" href="https://www.escortscriptwebsite.com">https://www.escortscriptwebsite.com</a><br>
					</div>
				</div>

		</div> 
	</div> 
	<?php require_once(DIR_BLOCO."/rodape.php"); ?>
</body>
</html>
 