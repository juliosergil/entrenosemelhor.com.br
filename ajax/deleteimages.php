<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');
require_once(dirname(dirname(__FILE__)) .'/util/Util.php');

$action = strval($_REQUEST['filtro']);

$image = abs(intval($_REQUEST['image']));

if ( 'del_image_gal' == $action) {
	//echo "---------".$image;

	echo $sql = "DELETE FROM team_fotos WHERE id = '".$image."'";
	mysqli_query(DB::$mConnection,$sql) or die (mysqli_error(DB::$mConnection));

	exit;
}
