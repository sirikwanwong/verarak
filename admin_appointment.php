<?php
    $pdo = new PDO("mysql:host=localhost; dbname=verarak; charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<?php
    $stmt = $pdo->prepare("SELECT * FROM appointment_admin_page "); 
    $stmt->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" href="admin_appointment.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script>
 

    // document.getElementById("submitFormBtn").addEventListener("click", function() {
    //             // Perform form submission (you can use AJAX if needed)
    //             // After successful submission, change button to show a tick mark
    //             document.getElementById("openFormBtn").innerHTML = "&#10004;"; // Unicode for tick mark
    //             // Optionally, close the popup form
    //             document.getElementById("popupForm").style.display = "none";
    //     });
    function close_modal(){
            document.getElementById('close')
            var popup = document.getElementById("popup-form-check");
            popup.style.display = "none"; 
        };
    function showformcheck(patientId){
                var popup = document.getElementById("popup-form-check");
                popup.style.display = "flex";
                var patientIdSpan = document.getElementById("patient_id");
            patientIdSpan.textContent = patientId;
                displayDate();
            };
    function displayDate() {
            var now = new Date(); 
            var dateField = document.getElementById('date_present'); 
            var dateString = now.toLocaleDateString('en-GB', {day: '2-digit', month: 'short', year: 'numeric'}); // ดึงวันที่และเวลาแบบ local โดยกำหนดรูปแบบเป็น วันที่ เดือน ปี
            dateField.value = dateString; // กำหนดค่าใน input element เป็นวันที่และเวลาปัจจุบัน
        } 

    function submitForm() {
    var patientid = document.getElementById("patient_id").value;
    var date_appoint = document.getElementById("date_present").value;
    var weight_patient = document.getElementById("weight").value;
    var height_patient = document.getElementById("height").value;
    var diastolic_patient = document.getElementById("diastolic").value;
    var temperature_patient = document.getElementById("temperature").value;
    var pluse_rate_patient = document.getElementById("pluse_rate").value;
    
    var formData = {
        patient_id: patientId,
        date_present: date_appoint,
        weight : weight_patient,
        height: height_patient,
        diastolic:diastolic_patient,
        temperature:temperature_patient,
        pluse_rate: pluse_rate_patient
       
    };

   
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "admin_add-datacheckin.php", true); 
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Upon successful submission, hide the form
            document.getElementById("popup-form-check").style.display = "none";
            document.getElementById("openFormBtn").innerHTML = "&#10004;";
        }
    };
    xhr.send(JSON.stringify(formData));
}


            
  </script>

<body>
  <header>
   <?php include('homepage_admin.php');?>
  </header>
  <div class="container">
      <div class="sidebar">
          <div class="side-nav">
            <a href="#" class="sidebar-item">การนัดหมาย</a>
            <a href="#" class="sidebar-item">พบแพทย์</a>
            <a href="#" class="sidebar-item">จ่ายยา</a>
          </div>
      </div>
      <div class="content">
          <div class="select_date">
              <h3>ตารางการนัดหมาย</h3>
              <div><button class="button-add-booking" id="button-add-booking">เพิ่มการนัดหมาย + </button></div>
              <label for="date_appoint">วันเดือนปีที่นัดหมาย :<input type="date" id="date_appoint"></label>
          </div>
              <table>
                    <tr>
                          <th>วันเดือนปีที่นัดหมาย</th>
                          <th>เวลาที่นัดหมาย</th>
                          <th>ชื่อผู้ป่วย</th>
                          <th>ชักประวัติ</th>
                          <th>check in </th>
                    </tr>
                <?php while($row=$stmt->fetch()): ?>
                      <tr>
                          <td><?=$row ["date"] ?></td>
                          <td><?=$row ["time"] ?></td>
                          <td><?=$row ["name_patient"] ?></td>
                          <td><button class="add-data"  value="<?=$row ['patient_id'] ?>" onclick="showformcheck(this.value)" >เพิ่มข้อมูล <i class='far fa-edit'></i></button></td><br>   
                          <td><button class="button-check">check in <i class='fa fa-check-square-o'></i></button></td><br>     
                      </tr>
                <?php endwhile; ?>
              </table>
          </div>
      </div>
      


</body>
</html>

<div id="popup-form-check" class="popup-form">
    <form id="patientForm" class="form-container">
    <span onclick="close_modal()" class="close">&times;</span>
        <h2>ชักประวัติ</h2>
        <hr>
        <label class="patientid">รหัสผู้ป่วย :<span id="patient_id"></span></label><br>
        <label>วันที่เข้ารับการรักษา : <input type="text" id="date_present" name="date" class="input-date"></label><br>
        <div class="input-row1">
        <label>weight: <input type="text" id="weight" name="weight" class="input-field">kg</label>
        <label>height: <input type="text" id="height" name="height" class="input-field">cm</label><br>
        </div>
        <div class="input-row">
                <label>BP: <input type="text" id="diastolic" name="diastolic" class="input-field">mmhg</label>
                <label>T : <input type="text" id="temperature" name="temperature" class="input-field">c</label>
                <label>PR : <input type="text" id="pluse_rate" name="pluse_rate" class="input-field">/min</label>
        </div>

       
        <button type="button" id="submitFormBtn" class="submit-btn" onclick="submitForm()">Submit</button>
    </form>
</div>