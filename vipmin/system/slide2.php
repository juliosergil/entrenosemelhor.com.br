<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

need_manager();
need_auth('admin');
 
$system = Table::Fetch('system', 1);
 
$sql = " 
CREATE TABLE IF NOT EXISTS `linkbanners2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(200) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

 ";
$rs = @mysqli_query(DB::$mConnection,$sql);


if ($_POST) {
 
 
	if(!empty($_POST['totalbanners'])){
	
		$sql = "delete from linkbanners2";
		mysqli_query(DB::$mConnection,$sql);
			 
		for($i=0;$i<=$_POST['totalbanners'];$i++){
			$nomefile 	= $_POST['nomefile#'.$i];
			$title 	= $_POST['title#'.$i]; 
			$link 	= $_POST['link#'.$i]; 
	
			 if($nomefile==""){
				continue;
			 }
			$sql = "insert into linkbanners2 (file,link,title) values ('$nomefile','$link','$title')";

			$rs = mysqli_query(DB::$mConnection,$sql);
			if(!$rs){
				echo "=====".mysqli_error(DB::$mConnection);
				exit;
			}
		
		}
	}

	 
	unset($_POST['commit']);
	$INI = Config::MergeINI($INI, $_POST);
	$INI = ZSystem::GetUnsetINI($INI);
	save_config();

	$value = Utility::ExtraEncode($INI);
	$table = new Table('system', array('value'=>$value));
	if ( $system ) $table->SetPK('id', 1);
	$flag = $table->update(array( 'value'));
 
	Session::Set('notice', 'Informações atualizadas com sucesso!');
	redirect( WEB_ROOT . '/vipmin/system/slide2.php');
}
 

include template('manage_system_slide2');


