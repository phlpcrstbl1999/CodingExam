<?php
    require_once('db/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
    <div class="wrapper">
    <div class="questions-container">
    <form method="POST" action="backend/action.php">

        <?php
            $sql = "Select * from tblquestions";
            $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)){
                $question = $row['questions'];
                $opt1 = $row['opt1'];
                $opt2 = $row['opt2'];
                $opt3 = $row['opt2']; 
        ?>
        <div class="question">
            <?php echo $question;?>
        </div>
        <div class="choices">
            <div class="form">
                <input type="radio" name="choice" id="opt1" value="<?php echo $opt1;?>">
                <label class="choice-desc" for="opt1">A. <?php echo $opt1; ?></label>
            </div>
           <div class="form">
                <input type="radio" name="choice" id="opt2" value="<?php echo $opt2;?>">
                <label class="choice-desc" for="opt2">B. <?php echo $opt2; ?></label>
           </div>
           <div class="form">
                <input type="radio" name="choice" id="opt3" value="<?php echo $opt3;?>">
                <label class="choice-desc" for="opt3">C. <?php echo $opt3; ?></label>
           </div>
        </div>
        <div class="btn">
        <input type="submit" class="next-btn" name="next" value="next">

        </div>
    </form>
        <?php
            }
        ?>
    </div>
    </div>

</body>
</html>