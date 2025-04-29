<?php
if (isset($_GET['file'])) {
  $file = $_GET['file'];
  
  // Amankan input

  
  // Path ke file
  $file_path = $_SERVER['DOCUMENT_ROOT'].'/administrasi-data-penelitian/berkas/'.$file;

  // Debugging: tampilkan path file
  echo "File path: " . $file_path . "<br>";

  // Periksa apakah file ada
  if (file_exists($file_path)) {
    // Mengatur header untuk unduhan
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'. $file. '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_path));
    readfile($file_path);
    exit;
  } else {
    echo 'File not found!';
  }
} else {
  echo 'No file specified!';
}
?>
