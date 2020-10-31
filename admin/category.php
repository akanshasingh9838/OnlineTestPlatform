<?php
include("config.php");
include("sidebar.php");
if(isset($_POST['submit'])){
    if(isset($_POST['category']))
    {
        $category=$_POST['category'];
    }
    else{
        echo "Input category firstly";
    }

    //echo $category;
    $sql = "INSERT INTO testcategory (category_name)
    VALUES ('$category')";

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql = "DELETE FROM testcategory WHERE `cat_id`='$id'";

    if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
    } else {
    echo "Error deleting record: " . $conn->error;
    }
}


?>

<div class="container">
    <p>
        <form action="" method="POST" >
            <label>Category</label>
            <input  type="text" id="category" name="category" ><br>
            <input type="submit" value="submit" name="submit">
        </form>
    </p>

    <table>
							
        <thead>
            <tr>
                <th>Category-ID</th>
                <th>Category Name</th>  
                <th>Action</th>     
            </tr>        
        </thead> 
        <tbody>
            <?php
                $sql="SELECT * FROM testcategory";
                $result=$conn->query($sql);
                if($result->num_rows>0){
                    while($row= $result->fetch_assoc()){
                        echo '<tr>';
                        echo "<td>".$row["cat_id"]."</td>";
                        echo "<td>".$row["category_name"]."</td>";
                        echo "<td>";
                        echo '<a href="#" title="Edit"><img src="images/pencil.png" alt="Edit" /></a>';
                        echo '<a href="category.php?id='.$row["cat_id"].'" onclick="return checkdelete()" title="Delete"><img src="images/cross.png" alt="Delete" /></a>';
                        echo "</td>";
                        echo '</tr>';
                    }
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