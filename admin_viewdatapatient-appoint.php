<?php include('admin_datapatient_id.php');?> 
<?php
                $stmt = $pdo->prepare("SELECT * FROM appointment_admin_page WHERE patient_id =?");
                $stmt->bindParam(1,$_GET["patient_id"]);
                $stmt->execute();
            ?>
            <table>
                <tr>
                  <th>วันเดือนปีที่รักษา</th>
                </tr>
        <?php while($row=$stmt->fetch()): ?>
            <tr>
                <td><?=$row ["date"] ?></td>
                  
            </tr>
        <?php endwhile; ?>
        </table>