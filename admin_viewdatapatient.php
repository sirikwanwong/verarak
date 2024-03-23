<?php
    $pdo = new PDO("mysql:host=localhost; dbname=verarak; charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
 <?php
    $stmt = $pdo->prepare("SELECT * FROM medical_records WHERE patient_id =?");
    $stmt->bindParam(1,$_GET["patient_id"]);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="admin_viewdatapatient.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<header>
    <?php include('homepage_admin.php');?>
</header>
<div class="container">
    <div class="sidebar">
        <div class="sidebar-1">
            <!-- ตรวจสอบว่ามีข้อมูลใน $row หรือไม่ก่อนแสดงผล -->
            <?php if(isset($row)): ?>
                รหัสผู้ป่วย: <?=$row["patient_id"]?><br>
                ชื่อ-สกุล: <?=$row["name_patient"]?>
            <?php endif; ?>
        </div>
        <div class="side-nav">
            <button class="sidebar-item" id="general">ข้อมูลทั่วไป</button>
            <button  class="sidebar-item" id="history">ประวัติการรักษา</button> 
            <button class="sidebar-item" id="course">คอร์สการรักษา</button0>
        </div>
            </div>
        <div class="content">
            <div id="results"></div>
        </div>
</div>

<script>
  // general
    document.getElementById("general").addEventListener("click", function() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "fetch_general.php?patient_id=<?= $_GET["patient_id"] ?>", true);
        xhr.onreadystatechange = function() {
          if (xhr.readyState == 4 && xhr.status == 200) {
              document.getElementById("results").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
});
// history
document.getElementById("history").addEventListener("click", function() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch_history.php?patient_id=<?= $_GET["patient_id"] ?>", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("results").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
});
</script>