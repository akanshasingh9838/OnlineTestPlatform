<?php
    include("config.php");
    include("sidebar.php");

    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $sql = "DELETE FROM usersignup WHERE `user_id`='$id'";

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
                    <th>User ID</th>
                    <th> Username</th>
                    <th>mail</th>
                    <th>Action</th>
                </tr>               
            </thead>
                       
            <tbody>
                <?php
                    $sql = "SELECT * FROM usersignup";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            
                            echo '<tr>';
                            echo "<td>".$row["user_id"]."</td>";
                            echo "<td>".$row["username"]."</td>";
                            echo "<td>".$row["email"]."</td>";
                            echo "<td>";
                            echo '<a href="#" title="Edit"><img src="images/pencil.png" alt="Edit" /></a>';
                            echo '<a href="user.php?id='.$row["user_id"].'" onclick="return checkdelete()" title="Delete"><img src="images/cross.png" alt="Delete" /></a>';
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