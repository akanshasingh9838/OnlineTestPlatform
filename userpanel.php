<?php include("admin/config.php");
session_start();
if(isset($_POST['submit'])){
  $_SESSION['category']=$_POST['category'];
  header('Location:test.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link  type="text/css" rel="stylesheet"  href="style2.css"  >
</head>
<body>


<div class="category">
    <form action="userpanel.php" method="POST">
    
      <label>Category</label>         
      <select name="category">		
    <?php																				
      $sql = "SELECT `category_name` FROM testcategory";
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        echo '<option value="'.$row["category_name"].'">'.$row["category_name"].'</option>';
        
        }
      } else {
        echo "0 results, Manage categories first";
      }																		
    ?>    </select> 
								
        
    <input type="submit" value="Start Test" name="submit">
    </form>
    
</div>
 
</body>
</html>