 
 <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #808080;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-banner {
          /*  background-color: #fff;*/
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
            width: 90%;
            position: relative;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            background: none;
            border: none;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            color: #333;
        }

        .close-btn:hover {
            color: #ff0000;
        }

        .modal-banner h2 {
            font-size: 24px;
            margin: 0 0 10px 0;
            color: #333;
        }

        .modal-banner p {
            font-size: 16px;
            color: #666;
            margin: 0 0 10px 0;
        }

        .modal-banner a {
            text-decoration: none;
            color: #1a73e8;
            font-size: 16px;
            display: inline-flex;
            align-items: center;
        }
		
		
	@media screen and (max-width: 720px) {
		 .modal-banner img {
			 width: 132%;
			 margin-top: -63%;
			 padding: 0px !important;
			 margin-left: -60px;
		 }
		 
		 .close-btn {
			width: 34% !important;
		 } 
	}


        .modal-banner a:hover {
            text-decoration: underline;
        }

        .modal-banner img {
	   /* width: 400px;  
		height: auto; */
		margin-right: 5px;
}

    </style>
	
	
	    <div class="modal-overlay" id="modal">
        <div class="modal-banner">
		 <img class="close-btn" onclick="closeModal()"  src="<?=$PATHSKIN?>/images/popup_fechar.png" alt="Ícone de link"> 
            <h2></h2>
            <p></p>
            <a href="javascript:$('#modalCadastrar').modal('show');" >
                <img src="<?=$PATHSKIN?>/images/bannerpopup.png" alt="Ícone de link">

            </a>
        </div>
    </div>

    <script>
        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }
    </script>