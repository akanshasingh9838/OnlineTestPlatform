<?php
session_start();
require 'admin/config.php';
?>

<style>
    .hide {
        display: none;
    }
</style>
<form action="result.php" method="post">
<?php

$category = $_SESSION['category'];
$sql = "SELECT * FROM `questions` WHERE `category`= '$category'";
$result=$conn->query($sql);
$count=$result->num_rows;

if ($count>0)
{
    $i=1;
    while($row = $result->fetch_assoc()) {  
        if ($i == 1) { 
    ?>
        <table id="akanksha<?php echo $i; ?>" class="table">
            <tr>
                <th>
                    <?php echo $i.". ";
                    echo $row['question'];
                    ?>
                </th>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="<?php echo $row['ques_id'] ?>" value="1">
                    <?php echo $row['option1'];  ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="<?php echo $row['ques_id'] ?>" value="2">
                    <?php echo $row['option2'];  ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="<?php echo $row['ques_id'] ?>" value="3">
                    <?php echo $row['option3'];  ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="<?php echo $row['ques_id'] ?>" value="4">    
                    <?php echo $row['option4'];  ?>
                </td>
            </tr>
            <tr>
                <td>
                    <button type="button" id="<?php echo $i; ?>" class="next">Next</button>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" style="display:none;" checked="checked" name="<?php echo $row['ques_id'] ?>" 
                    value="no">    
                </td>
            </tr>
        </table>
    
    <?php 
        $i++;
        } else if (($i > 1) && ($i < $count)) {
    ?>
        <table id="akanksha<?php echo $i; ?>" class="table">
            <tr>
                <th>
                    <?php echo $i.". ";
                    echo $row['question'];
                    ?>
                </th>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="<?php echo $row['ques_id'] ?>" value="1">
                    <?php echo $row['option1'];  ?>
                </td>
            </tr>
            <tr>
                <td>
                <input type="radio" name="<?php echo $row['ques_id'] ?>" value="2">
                    <?php echo $row['option2'];  ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="<?php echo $row['ques_id'] ?>" value="3">
                    <?php echo $row['option3'];  ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="<?php echo $row['ques_id'] ?>" value="4">    
                    <?php echo $row['option4'];  ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" style="display:none;" checked="checked" name="<?php echo $row['ques_id'] ?>" 
                    value="no">    
                </td>
            </tr>
            <tr>
                <td>
                    <button type="button" id="<?php echo $i; ?>" class="next">Next</button>
                    <button type="button" id="<?php echo $i; ?>" class="previous">Previous</button>
                </td>
            </tr>
        </table>
    <?php
    $i++;
        } else if ($i == $count) {
            ?>
            <table id="akanksha<?php echo $i; ?>" class="table">
            <tr>
                <th>
                    <?php echo $i.". ";
                    echo $row['question'];
                    ?>
                </th>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="<?php echo $row['ques_id'] ?>" value="1">
                    <?php echo $row['option1'];  ?>
                </td>
            </tr>
            <tr>
                <td>
                <input type="radio" name="<?php echo $row['ques_id'] ?>" value="2">
                    <?php echo $row['option2'];  ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="<?php echo $row['ques_id'] ?>" value="<?php echo $row['option3']?>">
                    <?php echo $row['option3'];  ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="<?php echo $row['ques_id'] ?>" value="<?php echo $row['option4']?>">    
                    <?php echo $row['option4'];  ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" style="display:none;" checked="checked" name="<?php echo $row['ques_id'] ?>" 
                    value="no">    
                </td>
            </tr>
            <tr>
                <td>
                    <button type="button" id="<?php echo $i; ?>" class="previous">Previous</button>
                    <input type="submit" value="Submit">
                </td>
            </tr>
        </table>
            <?php
            $i++;
        }
    ?>
<?php
    }
    
} 

?>
</form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function (){
        // alert('hii');
        $('.table').addClass('hide');
        $('#akanksha'+1).removeClass('hide');

        $(document).on('click', '.next', function() {
            last = parseInt($(this).attr('id'));
            next = last+1;

            $('#akanksha'+last).addClass('hide');
            $('#akanksha'+next).removeClass('hide');
        });
        $(document).on('click', '.previous', function() {
            last = parseInt($(this).attr('id'));
            pre = last-1;

            $('#akanksha'+last).addClass('hide');
            $('#akanksha'+pre).removeClass('hide');
        });
    });
</script>