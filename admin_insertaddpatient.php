<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php
    $pdo = new PDO("mysql:host=localhost; dbname=verarak; charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];
    $name_patient = $_POST['name_patient'];
    $id_card = $_POST['id_card'];
    $date_of_birth = $_POST['date_of_birth'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $career = $_POST['career'];
    $status_id = $_POST['status_id'];
    $ethnicity = $_POST['ethnicity'];
    $nationality = $_POST['nationality'];
    $religion = $_POST['religion'];
    $address = $_POST['address'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $sub_district= $_POST['sub_district'];
    $zip_code = $_POST['zip_code'];
    $tel = $_POST['tel'];
    $congenital_disease = $_POST['congenital_disease'];
    $allergy = $_POST['allergy'];
    $surgery_history = $_POST['surgery_history'];
    $accident_history = $_POST['accident_history'];


    $sql_insert = "INSERT INTO medical_records (patient_id,name_patient, id_card,date_of_birth, age, gender,career,status_id,ethnicity,nationality,religion,address,province,district,sub_district,zip_code,tel,congenital_disease,allergy,surgery_history,accident_history) 
    VALUES (:patient_id, :name_patient, :id_card, :date_of_birth, :age, :gender,:career,:status_id,:ethnicity,:nationality,:religion,:address,:province,:district,:sub_district,:zip_code,:tel,:congenital_disease,:allergy,:surgery_history,:accident_history)";

    $stmt_insert = $pdo->prepare($sql_insert);
    $stmt_insert->bindParam(':patient_id', $patient_id);
    $stmt_insert->bindParam(':name_patient', $name_patient);
    $stmt_insert->bindParam(':id_card', $id_card);
    $stmt_insert->bindParam(':date_of_birth', $date_of_birth);
    $stmt_insert->bindParam(':age', $age);
    $stmt_insert->bindParam(':gender', $gender);


    $stmt_insert->bindParam(':career', $career);
    $stmt_insert->bindParam(':status_id', $status_id);
    $stmt_insert->bindParam(':ethnicity', $ethnicity);
    $stmt_insert->bindParam(':nationality', $nationality);
    $stmt_insert->bindParam(':religion', $religion);
    $stmt_insert->bindParam(':address', $address);

    $stmt_insert->bindParam(':province', $province);
    $stmt_insert->bindParam(':district', $district);
    $stmt_insert->bindParam(':sub_district', $sub_district);
    $stmt_insert->bindParam(':zip_code', $zip_code);
    $stmt_insert->bindParam(':tel', $tel);
    $stmt_insert->bindParam(':congenital_disease', $congenital_disease);
    $stmt_insert->bindParam(':allergy', $allergy);
    $stmt_insert->bindParam(':surgery_history', $surgery_history);
    $stmt_insert->bindParam(':accident_history', $accident_history);
    $stmt_insert->execute();
    if ($stmt_insert) {
        header('refresh:0.5; url=admin_medrecords.php');
    } else {
        echo "error";
    }
}
?>
            