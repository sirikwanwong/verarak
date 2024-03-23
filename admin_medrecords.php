<?php
    $pdo = new PDO("mysql:host=localhost; dbname=verarak; charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<?php
    $stmt = $pdo->prepare("SELECT * FROM medical_records"); 
    $stmt->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" href="admin_medrecords.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="bower_components/sweetalert2/dist/sweetalert2.min.js"></script>
  
  <script>
        document.addEventListener("DOMContentLoaded", function() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "run_patient_id.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    document.getElementById("patient_id").value = xhr.responseText;
                } else {
                    console.error("เกิดข้อผิดพลาดในการรับข้อมูล patient_id");
                }
            }
        };
        xhr.send();
    });

        function showform(){
                // generateAndSendNumberKey();
                var popup = document.getElementById("bd-modal");
                popup.style.display = "flex";
            };
        function close_modal(){
            document.getElementById('close')
            var popup = document.getElementById("bd-modal");
            popup.style.display = "none"; 
        };

  </script>

</head>

<header>
   <?php include('homepage_admin.php');?>
</header>


<body>
  <div class="container">
        <input type="text" id="search-box" placeholder="ค้นหา" ></input><br>
        <a href="#" id="button-add" class="button-add" onclick="showform()" > เพิ่มประวัติผู้ป่วยใหม่ + </a>
    <table>
        <tr>
            <th>รหัสผู้ป่วย</th>
            <th>ชื่อผู้ป่วย</th>
            <th>   </th>
            <th>   </th>
        </tr>
        <?php while($row=$stmt->fetch()): ?>
            <tr>
                <td><?=$row ["patient_id"] ?></td>
                <td><?=$row ["name_patient"] ?></td>
                <td><a class="button-view" href="admin_viewdatapatient.php?patient_id=<?=$row ["patient_id"] ?>">view</a></td>
                <td><button class="button-booking">เพิ่มลงในการนัดหมาย</button></td><br>     
            </tr>
        <?php endwhile; ?>
        </table>
</div>


<div class="bg-modal"id="bd-modal">
    <div class="modal-content">
        <form id="form_data"action="admin_insertaddpatient.php" method="post" >
        <span onclick="close_modal()" class="close">&times;</span>
            <label> รหัสผู้ป่วย: <input type="text"  id="patient_id" name="patient_id" readonly></label><br>
            <label>ชื่อ-สกุล :<input type="text" name="name_patient"></label>   
            <label>เลขบัตรประชาชน : <input  type="text" name="id_card"></label><br>
            <label>วัน เดือน ปี เกิด : <input type="date" name="date_of_birth"></label>
            <label>อายุ : <input type="number" name="age"> ปี</label>
            <label>เพศ : <select id="typegender" name="gender">
                <option value="หญิง">หญิง</option>
                <option value="ชาย">ชาย</option></select></label><br>
                <label>อาชีพ : <input  type="text" name="career">
            <label>สถานภาพ : <input type="checkbox" value="โสด" name="status_id"> โสด
                <input type="checkbox" value="สมรส" name="status_id">สมรส
                <input type="checkbox" value="หย่าร้าง" name="status_id"> หย่าร้าง</label><br>
            <label>เชื้อชาติ : <input type="text" name="ethnicity"></label>
            <label>สัญชาติ : <input type="text" name="nationality"></label>
            <label>ศาสนา : <input type="text" name="religion"></label><br>
            <label>ที่อยู่ : <input type="text" name="address"></label>
            <label>จังหวัด : <input type="text" name="province"></label>
            <label>อำเภอ : <input type="text" name="district"></label><br>
            <label>ตำบล : <input type="text" name="sub_district"></label>
            <label>รหัสไปรษณีย์ : <input type="text" name="zip_code"></label><br>
            <label>เบอร์โทรศัพท์ : <input type="text" pattern="[0-9]{10}" name="tel"></label><br>
            <label>โรคประจำตัว : <input type="text" name="congenital_disease"></label><br>
            <label>ประวัติแพ้ยา : <input type="text" name="allergy"></label><br>
            <label>ประวัติการผ่าตัด : <input type="text" name="surgery_history"></label><br>
            <label>ประวัติการประสบอุบัติเหตุ : <input type="text" name="accident_history"></label><br>
            <input id="submit" type="submit" value="เพิ่มประวัติผู้ป่วย">
            
        </form>
    </div>

</div>


</body>    
<footer>

        
</footer>
</html>