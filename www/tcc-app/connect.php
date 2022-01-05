<?php
try {
  $conn = new PDO('mysql:host=198.27.126.168;dbname=sundata', root, root);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?>