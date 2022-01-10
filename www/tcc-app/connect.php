<?php
try {
  $conn = new PDO('mysql:host=172.27.0.3;dbname=sundata', 'tcc_albert', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?>