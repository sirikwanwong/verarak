<?php
    $pdo = new PDO("mysql:host=localhost;dbname=verarak;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<?php
    $stmt = $pdo->prepare("SELECT * FROM medical_records WHERE patient_id =?");
    $stmt->bindParam(1,$_GET["patient_id"]);
    $stmt->execute();
    $row=$stmt->fetch();?>