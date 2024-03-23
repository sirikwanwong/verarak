<?php
    $pdo = new PDO("mysql:host=localhost; dbname=verarak; charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" href="fecth_general.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
<body>
    
<?php
if(isset($_GET['patient_id'])) {
    // Retrieve the patient_id from the request
    $patient_id = $_GET['patient_id'];

    // Prepare and execute the query to fetch general information about the patient
    $stmt = $pdo->prepare("SELECT * FROM medical_records WHERE patient_id = ?");
    $stmt->execute([$patient_id]);
    
    // Fetch the data
    $patient_data = $stmt->fetch();
    if ($patient_data) {
                $html = "<div class='results_data'>";
                $html .= "<label id='patient_id'>รหัสผู้ป่วย: <input type='text' name='patient_id' value='" . $patient_data["patient_id"] . "'></label><br>";
                $html .= "<label>ชื่อ-สกุล: <input type='text' name='name_patient' value='" . $patient_data["name_patient"] . "'></label><br>";
                $html .= "<label>เลขบัตรประชาชน: <input type='text' name='id_card' value='" . $patient_data["id_card"] . "'></label><br>";
                $html .= "<label>วัน เดือน ปี เกิด: <input type='text' name='date_of_birth' value='" . $patient_data["date_of_birth"] . "'></label><br>";
                $html .= "<label>อายุ: <input type='text' name='age' value='" . $patient_data["age"] . "'></label><br>";
                $html .= "<label>เพศ: <input type='text' name='gender' value='" . $patient_data["gender"] . "'></label><br>";
                $html .= "<label>อาชีพ: <input type='text' name='career' value='" . $patient_data["career"] . "'></label><br>";
                $html .= "<label>สถานภาพ: <input type='text' name='status_id' value='" . $patient_data["status_id"] . "'></label><br>";
                $html .= "<label>เชื้อชาติ: <input type='text' name='ethnicity' value='" . $patient_data["ethnicity"] . "'></label><br>";
                $html .= "<label>สัญชาติ: <input type='text' name='nationality' value='" . $patient_data["nationality"] . "'></label><br>";
                $html .= "<label>ศาสนา: <input type='text' name='religion' value='" . $patient_data["religion"] . "'></label><br>";
                $html .= "<label>ที่อยู่: <input type='text' name='address' value='" . $patient_data["address"] . "'></label><br>";
                $html .= "<label>จังหวัด: <input type='text' name='province' value='" . $patient_data["province"] . "'></label><br>";
                $html .= "<label>อำเภอ: <input type='text' name='district' value='" . $patient_data["district"] . "'></label><br>";
                $html .= "<label>ตำบล: <input type='text' name='sub_district' value='" . $patient_data["sub_district"] . "'></label><br>";
                $html .= "<label>รหัสไปรษณีย์: <input type='text' name='zip_code' value='" . $patient_data["zip_code"] . "'></label><br>";
                $html .= "<label>เบอร์โทรศัพท์: <input type='text' name='tel' value='" . $patient_data["tel"] . "'></label><br>";
                $html .= "<label>โรคประจำตัว: <input type='text' name='congenital_disease' value='" . $patient_data["congenital_disease"] . "'></label><br>";
                $html .= "<label>ประวติแพ้ยา: <input type='text' name='allergy' value='" . $patient_data["allergy"] . "'></label><br>";
                $html .= "<label>ประวัติการผ่าตัด: <input type='text' name='surgery_history' value='" . $patient_data["surgery_history"] . "'></label><br>";
                $html .= "<label>ประวัติการประสบอุบัติเหตุ: <input type='text' name='accident_history' value='" . $patient_data["accident_history"] . "'></label><br>";
                $html .= "<div><button class='edit-general'>แก้ไข</button></div>";
                $html .= "</div>";
             }
            echo $html;
            } else {
                // If no data found, return an error message or handle it as needed
                echo "No data found for the provided patient ID.";
            }

    
       


?>



    