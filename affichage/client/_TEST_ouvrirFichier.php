<?php
// Store the file name into variable

$client_id = $_GET['client_id'];

$file = '../../upload/client/'.$client_id.'_form-medical.pdf';
$filename = $client_id.'_form-medical.pdf';

// Header content type
header('Content-type: application/pdf');

header('Content-Disposition: inline; filename="' . $filename . '"');

header('Content-Transfer-Encoding: binary');

header('Accept-Ranges: bytes');

// Read the file
@readfile($file);
?>
