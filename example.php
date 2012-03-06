<?php

use FtpPhp\Ftp;
spl_autoload_register(function($className){
    require_once str_replace(array('\\','_'),array('/'),$className).'.php';
});


try {
	$ftp = new Ftp();

	// Opens an FTP connection to the specified host
	$ftp->connect('ftp.ed.ac.uk');

	// Login with username and password
	$ftp->login('anonymous', 'example@example.com');

	// Download file 'README' to local temporary file
	$temp = tmpfile();
	$ftp->fget($temp, 'README', Ftp::ASCII);

	// echo file
	echo '<pre>';
	fseek($temp, 0);
	fpassthru($temp);

} catch (\Exception $e) {
	echo 'Error: ', $e->getMessage();
}
