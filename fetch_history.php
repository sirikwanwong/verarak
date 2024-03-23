<?php
    $pdo = new PDO("mysql:host=localhost; dbname=verarak; charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" href="fecth_history.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
<body>
    
<?php
if(isset($_GET['patient_id'])) {
    // Retrieve the patient_id from the request
    $patient_id = $_GET['patient_id'];

    // Prepare and execute the query to fetch general information about the patient
    $stmt = $pdo->prepare("SELECT * FROM treatment WHERE patient_id = ?");
    $stmt->execute([$patient_id]);
    
    // Fetch the data
    if ($stmt->rowCount() > 0) {
        while ($patient_data = $stmt->fetch()) {
                $html = "<div class='results_data'>";
                $html.="<table>
                        <tr>
                            <th>วันที่เข้าการรักษา</th>
                            <th>ดูรายละเอียด</th>
                        </tr>";
                $html.= "<tr>
                                <td>".$patient_data["date"]."</td>
                                <td><button class='button-view'>view</button></td>
                        </tr>";
                    }
                $html.= "</table>";
                $html.= "</div>";
                echo $html;
            } else {
                // If no data found, return an error message or handle it as needed
                echo "No data found for the provided patient ID.";
            }
        }
?>


