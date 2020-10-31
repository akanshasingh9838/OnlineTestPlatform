<?php
    include("config.php");
    include("sidebar.php");

    if(isset($_POST['submit'])){
        $ques=isset($_POST['ques']) ? $_POST['ques'] : '';
        $option1=isset($_POST['option1']) ? $_POST['option1'] : '';
        $option2=isset($_POST['option2']) ? $_POST['option2'] : '';
        $option3=isset($_POST['option3']) ? $_POST['option3'] : '';
        $option4=isset($_POST['option4']) ? $_POST['option4'] : '';
        $ans=isset($_POST['ans']) ? $_POST['ans'] : '';
        $category=isset($_POST['category']) ? $_POST['category'] : '';

        $sql='INSERT INTO questions(`question`,`option1`,`option2`,`option3`,`option4`,`ans`,`category`)VALUES("'.$ques.'","'.$option1.'","'.$option2.'","'.$option3.'","'.$option4.'","'.$ans.'","'.$category.'")';
        if ($conn->query($sql) === TRUE) {
            $message="New record created successfully";
            //for not submitting same value again
            header('Location:addquestion.php');
		}
		else {
            $errors=array('input'=>'form','msg'=>$conn->error);
            echo "Error: " . $sql . "<br>" . $conn->error;
        }       

        
       
        

    }
?>


<div class="container">
    <form action="" method="POST" enctype="multipart/form-data">
        <p>
        <label for="ques">Enter the question</label>
        <textarea id="ques" name="ques" placeholder="Write something.." style="height:100px"></textarea>

        <p>
        <label for="option1">Option 1</label>
        <input type="text" id="option1" name="option1" placeholder="Your last name.">
        </p>

        <p>
        <label for="option2">Option 2</label>
        <input type="text" id="option2" name="option2" placeholder="Enter here..">
        </p>

        <p>
        <label for="option3">Option 3</label>
        <input type="text" id="option3" name="option3" placeholder="Enter here..">
        </p>

        <p>
        <label for="option4">Option 4</label>
        <input type="text" id="option4" name="option4" placeholder="Enter here..">
        </p>

        <p>
        <label for="ans">Correct Option is?</label>
        <select name="ans" id="ans">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
        </p>

        <p>
        <label for="category">Question lie in which category?</label>             
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
        ?>
        </select> 
        </p>

        <input type="submit" name="submit" value="Add Question">
    </form>
</div>