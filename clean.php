<?php 

$files = glob('./uploads/*'); 
foreach($files as $file){ 
	if(is_file($file))
		unlink($file); 
}

$files2 = glob('./tmp/*'); 
foreach($files as $file){ 
	if(is_file($file))
		unlink($file); 
}

?>
