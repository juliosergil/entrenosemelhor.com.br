<?php
function configure_keys() {
	return array(
		//system
		'db',
		'memcache',
		'webroot',
		'system',
		'bulletin',
		'pagseguro',
		'moip',
		'pagamentodg',
		'mercadopago',
		'dinheiro',
		'paypal',
		'bill',
		'other',
		//settings
		'option',
		'mail',
		'sms',
		'credit',
		'skin',
		'authorization',
		'credito',
		'background',
		'slideshowbanners',
		'cores',
		'header',
	);
}
 
 function configure_save($key = null) {
	global $INI;

	// salva apenas uma chave
	if ($key && isset($INI[$key])) {
		return _configure_save($key, $INI[$key]);
	}

	// salva todas  
	$keys = configure_keys();
	foreach ($keys as $one) {
		if (isset($INI[$one])) {
			_configure_save($one, $INI[$one]);
		}
	}

	return true;
}

function _configure_save($key, $value) {
	if (!$key) return false;

	$php = DIR_CONFIGURE . '/' . $key . '.php';
	$v = "<?php\r\n\$value = ";
	$v .= var_export($value, true);
	$v .= ";\r\n?>";

	return file_put_contents($php, $v);
}



function configure_load() {
	global $INI;
	$keys = configure_keys();
	foreach($keys AS $one) {
		$INI[$one] = _configure_load($one);
	}
	return $INI;
}

function _configure_load($key=null) {
	if (!$key) return NULL;
	$php = DIR_CONFIGURE . '/' . $key . '.php';
	if ( file_exists($php) ) {
		require_once($php);
	}
	return $value;
}



