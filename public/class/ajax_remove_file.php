<?php
if (isset($_POST['file'])) {
	$file = '../admin/images/' . $_POST['file'];
	if (file_exists($file)) {
		unlink($file);
	}
}
?>
