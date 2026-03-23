<?php

class DirectoryScanner
{
    private $_foldersToScan = array();

    private $_fileList = array();
    private $_folderList = array();

    private function clear()
    {
        $this->_foldersToScan = array();

        $this->_fileList = array();
        $this->_folderList = array();
    }

    public function scan($rootFolder, $extensions = array())
    {
        $this->clear();

        if ($rootFolder !== NULL) {
            //TODO check folder access
            $extensions = ($extensions !== NULL && is_array($extensions)) ? $extensions : array();

            $this->enqueueFolder($rootFolder);

            $finished = FALSE;
            $folderPath = $this->nextFolderToScan();

            while (!$finished) {
                try {
                    $result = $this->scanDir($folderPath, $extensions);
                } catch (Exception $e) {
                    throw $e;
                }

                if (sizeof($result['files'])) {
                    $this->_fileList = array_merge($this->_fileList, $result['files']);
                }

                $subdirs = $result['directories'];
                if (sizeof($subdirs)) {
                    $this->_folderList = array_merge($this->_folderList, $subdirs);

                    // enqueue folders to scan
                    foreach ($subdirs as $subdir) {
                        $this->enqueueFolder($subdir);
                    }
                }

                $folderPath = $this->nextFolderToScan();
                $finished = ($folderPath === FALSE);
            }
        }
    }

    private function enqueueFolder($dir)
    {
        $dir = rtrim($dir, '/');
        $key = md5($dir);

        $this->_foldersToScan[$key] = array('path' => $dir, 'scanned' => FALSE);
    }

    private function setScannedFolder($dir)
    {
        $dir = rtrim($dir, '/');
        $key = md5($dir);

        if (isset($this->_foldersToScan[$key])) {
            $this->_foldersToScan[$key]['scanned'] = TRUE;
        }
    }

    private function nextFolderToScan()
    {
        foreach ($this->_foldersToScan as $folder) {
            if (!$folder['scanned']) {
                return $folder['path'];
            }
        }

        return FALSE;
    }


    private function scanDir($directory, $extensions)
    {
        $files = array();
        $directories = array();

        $iterator = new DirectoryIterator($directory);

        $filter = FALSE;
        if (is_array($extensions) && sizeof($extensions) > 0) {
            $filter = TRUE;
        } else {
            $extensions = array();
        }

        while ($iterator->valid()) {

            if ($iterator->isFile()) {
                $ext = $iterator->getExtension();

                if (!$filter || in_array($ext, $extensions)) {
                    $files[] = $iterator->getPathname();
                }
            } elseif ($iterator->isDir()) {
                if (!$iterator->isDot()) {
                    $dirPath = $iterator->getPathname();

                    if (trim($dirPath) != '') {
                        $directories[] = $dirPath;
                    }
                }
            }

            $iterator->next();
        }

        $this->setScannedFolder($directory);

        return array(
            'files' => $files,
            'directories' => $directories
        );
    }

    public function getFiles()
    {
        return $this->_fileList;
    }

    public function getFolders()
    {
        return $this->_folderList;
    }
}


class MYSQL_Upgrader
{

    private $replacements = 0;

    public function upgradeFiles($directory)
    {
        try {
            $scanner = new DirectoryScanner();
            $scanner->scan(
                $rootFolder = $directory,
                $extensions = ['php']
            );

            $files = $scanner->getFiles();

            $currentFileName = '.' . str_replace(dirname(__FILE__), '', __FILE__);
            $exceptions = array($currentFileName, './DirectoryScanner.php');


            for ($i = 0; $i < sizeof($files); $i++) {
                $file = $files[$i];

                if (in_array($file, $exceptions)) {
                    echo "Skipping file: {$file}<br><br>";
                } else {

                    echo "Processing file: {$file}<br>";

                    if (is_file($file)) {
                        $this->updateFileContent($file);
                    }
                }
            }


            $sourceDbFile = 'DB.class.php.txt';
            $destDbFile = 'include/library/DB.class.php';
            if (is_file($sourceDbFile) && is_dir('include')) {
                echo '<br><br>Copying file ' . $sourceDbFile . ' to ' . $destDbFile;
                if (copy($sourceDbFile, $destDbFile)) {
                    echo "<br>Copy done!";
					unlink($sourceDbFile);
                } else {
                    echo "<br>was not possible to copy DB file.";
                }
            } else {
                echo 'include directory or db file not found';
            }
			 
			
        } catch (Exception $e) {
            echo "<br>Error :" . $e->getMessage();
        }
    }


    private function updateFileContent($fileName)
    {
        $content = file_get_contents($fileName);

        $content = $this->replaceContent($content);

        if ($this->replacements > 0) {
            echo $this->replacements . " replacement(s) were made";

            try {
                file_put_contents($fileName, $content);
            } catch (Exception $e) {
                echo "an error ocurred when saving " . $e->getMessage();
            }

            echo ", file updated<br><br>";
        } else {
           // echo "nothing found<br><br>";
        }
    }


    private function replaceContent($content)
    {
        $this->replacements = 0;

        $replacement = array(
            'mysqli_query(DB::$mConnection,' => 'mysqli_query(DB::$mConnection,',
            'mysqli_error(DB::$mConnection' => 'mysqli_error(DB::$mConnection',

            'mysqli_fetch_array' => 'mysqli_fetch_array',
            'preg_replace' => 'preg_replace',
            'mysqli_fetch_assoc' => 'mysqli_fetch_assoc',
            'mysqli_num_rows' => 'mysqli_num_rows',
            'mysqli_fetch_row' => 'mysqli_fetch_row',
            'mysqli_fetch_object' => 'mysqli_fetch_object',
            'MYSQLI_ASSOC' => 'MYSQLI_ASSOC',
            'mysqli_data_seek' => 'mysqli_data_seek',

            'mysqli_affected_rows(DB::$mConnection' => 'mysqli_affected_rows(DB::$mConnection',

            'mysqli_escape_string' => 'mysqli_escape_string',
            'spl_autoload_register("my_autoloader");function my_autoloader($class_name) {' => 'spl_autoload_register("my_autoloader");function my_autoloader($class_name) {',
            'define(\'SYS_MAGICGPC\', get_magic_quotes_gpc());' => '//define(\'SYS_MAGICGPC\', get_magic_quotes_gpc());',

            'mysql_connect($INI[\'db\'][\'host\'],$INI[\'db\'][\'user\'], $INI[\'db\'][\'pass\'])' => 'mysqli_connect($INI[\'db\'][\'host\'],$INI[\'db\'][\'user\'], $INI[\'db\'][\'pass\'],$INI[\'db\'][\'name\'])',

            'mysql_connect($db[\'host\'], $db[\'user\'], $db[\'pass\']);' => 'mysqlI_connect($db[\'host\'], $db[\'user\'], $db[\'pass\'],$db[\'name\']);',
            'error_reporting(E_ALL^E_WARNING^E_NOTICE^E_DEPRECATED);ini_set('allow_url_include', '0');ini_set('allow_url_include', 'off');ini_set('allow_url_include', 'false');' => 'error_reporting(E_ALL^E_WARNING^E_NOTICE^E_DEPRECATED);ini_set(\'allow_url_include\', \'0\');ini_set(\'allow_url_include\', \'off\');ini_set(\'allow_url_include\', \'false\');',

            'mysqli_insert_id(DB::$mConnection' => 'mysqli_insert_id(DB::$mConnection',
            'mysqli_close(DB::$mConnection' => 'mysqli_close(DB::$mConnection',
            'mysqli_set_charset(DB::$mConnection' => 'mysqli_set_charset(DB::$mConnection',
            'mysqli_real_escape_string(DB::$mConnection' => 'mysqli_real_escape_string(DB::$mConnection',
            'mysql_select_db($INI[\'db\'][\'name\'])' => '//mysql_select_db($INI[\'db\'][\'name\'])',
            'mysql_select_db($db[\'name\'], $m);' => '//mysql_select_db($db[\'name\'], $m)'
        );

        $content = str_replace(
            array_keys($replacement),
            array_values($replacement),
            $content,
            $this->replacements
        );

        return $content;
    }
	


}
 
    $upgrader = new MYSQL_Upgrader();
    $upgrader->upgradeFiles('.'); 
 


  function recurse_copy($src,$dst) { 

	$dir = opendir($src); 
	@mkdir($dst); 
	while(false !== ( $file = readdir($dir)) ) { 
		if (( $file != '.' ) && ( $file != '..' )) { 
			if ( is_dir($src . '/' . $file) ) { 
				recurse_copy($src . '/' . $file,$dst . '/' . $file); 
			} 
			else { 
				if(copy($src . '/' . $file,$dst . '/' . $file)){
					echo " <br>  - ". $src . '/' . $file." copiado para ".$dst;
				}
				else{
					echo "<br> - erro ao copiar ". $src . '/' . $file." para ".$dst;
				}
			} 
		} 
	} 
	closedir($dir); 
}

recurse_copy('encode','.');
	