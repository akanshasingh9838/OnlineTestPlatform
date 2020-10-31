<?php
    include("config.php");
    include("sidebar.php");

    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $sql = "DELETE FROM questions WHERE `ques_id`='$id'";

        if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        } else {
        echo "Error deleting record: " . $conn->error;
        }
    }
?>
<div class="container">       
        <table>            
            <thead>
                <tr>
                    <th>Question ID</th>
                    <th>Question</th>
                    <th>Option 1</th>
                    <th>Option 2</th>
                    <th>Option 3</th>
                    <th>Option 4</th>
                    <th>Right Answer</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>               
            </thead>
                       
            <tbody>
                <?php
                    $sql = "SELECT * FROM questions";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            
                            echo '<tr>';
                            echo "<td>".$row["ques_id"]."</td>";
                            echo "<td>".$row["question"]."</td>";
                            echo "<td>".$row["option1"]."</td>";
                            echo "<td>".$row["option2"]."</td>";
                            echo "<td>".$row["option3"]."</td>";
                            echo "<td>".$row["option4"]."</td>";
                            echo "<td>".$row["ans"]."</td>";
                            echo "<td>".$row["category"]."</td>";
                            echo "<td>";
                            echo '<a href="#" title="Edit"><img src="images/pencil.png" alt="Edit" /></a>';
                            echo '<a href="viewquestions.php?id='.$row["ques_id"].'" onclick="return checkdelete()" title="Delete"><img src="images/cross.png" alt="Delete" /></a>';
                            echo "</td></tr>";
                        }
                    } else {
                        echo "0 results";
                    }
                ?>
            </tbody>
            
        </table>
        
</div>
                    
<script>
    function checkdelete(){
        return confirm("Are you sure you want to delete this data??")
    }
</script>