<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* Just some styles for the bar */
        .loading-bar {
            background: blue;
            width: 300px;
            height: 20px;
            display: none;
        }
            .loading-bar.active {
                display: block;
            }
			
			.loader {
				 display: none;
			  border: 16px solid #f3f3f3; /* Light grey */
			  border-top: 16px solid #3498db; /* Blue */
			  border-radius: 50%;
			  width: 120px;
			  height: 120px;
			  animation: spin 2s linear infinite;
			}

			@keyframes spin {
			  0% { transform: rotate(0deg); }
			  100% { transform: rotate(360deg); }
			}
	.botao{
			height: 38px;
		width: 315px;
		font-size: 20px;
		
	}

    </style>
</head>
<body  style="text-align: center !important;">
    <button class="myBtn botao">CLIQUE PARA ATUALIZAR</button>
    <div class="response"></div>
   <div class="loader"></div>

    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>
    <script>
        // Handle button click
        $('.myBtn').on('click', function(){
            $('input').val( "" );
			$('.loader').show();
            // Inmediatly show your bar
            var $loadingBar = $('.loader');
            $loadingBar.addClass('active');

            // Then execute Ajax
            $.ajax({
                 url: "upgrade_mysqli.php",
                method: 'GET'
            })
            .done(function(data) {
                // Display response data
                <? if($_REQUEST['debug']=="1"){?> $('div.response').html(data); <? } ?>
                <? if($_REQUEST['debug']==""){?> $('div.response').html('<P style="margin-top:33px;font-size:14px;">Sua plataforma foi atualizada com sucesso. Certifique-se de ter atualizado a versão do PHP do seu servidor para 7.3 ou 7.4</P>'); <? } ?>
           
		   })
            .fail(function(error) {
                // Display error if fails
                $('div.response').html(error);
            })
            .always(function() {
                // Always hide loading bar when finish
                $loadingBar.removeClass('active');
				$('.loader').hide();
            });
        });
    </script>
</body>
</html>