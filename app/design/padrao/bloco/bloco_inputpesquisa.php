<div style="display:none;" class="tips"><?=__FILE__?></div> 
<link rel="stylesheet" href="<?=$PATHSKIN?>/css/line-awesome/css/line-awesome.min.css">

	<style> 
		  
	.search-box {
		margin-right: 11px;
		display: flex;
		position: relative;
	}

	.search-box input {
		box-shadow: none;
			font-size: 15px;
		background: #f7f7f7;
		border: none;
		border-radius: 25px;
		height: 50px;
		padding-left: 30px!important;
		padding-right: 50px!important;
		width: 250px!important;
		margin-bottom: 0!Important;
		box-shadow: 3px 5px 12px 3px rgba(62, 83, 102, .06)!important;
		-webkit-box-shadow: 3px 5px 12px 3px rgba(62, 83, 102, .06)!important;
		-moz-box-shadow: 3px 5px 12px 3px rgba(62, 83, 102, .06)!important;
		background: rgb(210 215 220 / 10%)!important;
	}

	.search-box button {
		position: absolute;
		right: 20px;
		top: 9px;
		background: none;
			border: none;
	}

	.search-box button i {
		font-size: 25px;
	}
	.la, .las {
		font-family: 'Line Awesome Free';
		font-weight: 900;
	}
	.la-search:before {
		content: "\f002";
	} 
	</style>
<form id="nform" action="<?=$ROOTPATH?>/?Estado=&state=&city=&page=search">
	<div class="search-header">
		<div class="search-box">
			<input name="pesquisa" type="text"   value="<?=$_GET["pesquisa"]?>" placeholder="Pesquise em todo site">
			<button type="submit"><i class="las la-search searchbtn"></i></button>
		</div>
	</div>
</form>  