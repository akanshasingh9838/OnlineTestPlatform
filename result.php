<?php
session_start();
require 'admin/config.php';
$correct = 0;
$no = 0;
$wrong = 0;

$cat =  $_SESSION['category'];
// echo $cat;
$sql = "SELECT * FROM `questions` WHERE category = '$cat' ";
// echo $sql;
$res = $conn->query($sql);
if ($res->num_rows > 0) {
while ($row = $res->fetch_assoc()) {
        if ($row['ans'] == $_POST[$row['ques_id']]) {
            $correct++;
        } else if ($_POST[$row['ques_id']] == 'no') {
            $no++;
        } else {
            $wrong++;
        }
    }
}
echo "Correct" . $correct;
echo "<br>";
echo "Not Attempt" . $no;
echo "<br>";
echo "Wrong" . $wrong;
echo "<br>";
?>