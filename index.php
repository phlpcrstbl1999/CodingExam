<?php
    session_start();
    require_once('db/db.php');
    if(!isset($_SESSION['name'])) {
        header('location:login.php');
    }else {
        $name = $_SESSION['name'];
    }
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
    <h3>HELLO <?php echo strtoupper($name); ?>!</h3>
    <div class="questions-container">
    
        <?php
            $sql = "Select * from tblquestions";
            $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)){
                $q_id = $row['q_id'];
                $question = $row['questions'];
                $opt1 = $row['opt1'];
                $opt2 = $row['opt2'];
                $opt3 = $row['opt3']; 
        ?>
        <div class="question">
            <?php echo $question;?>
        </div>
        <div class="choices">
            <div class="form">
                <input type="radio" name="choice" id="optA" value="A">
                <label class="choice-desc" for="optA">A. <?php echo $opt1; ?></label>
            </div>
           <div class="form">
                <input type="radio" name="choice" id="optB" value="B">
                <label class="choice-desc" for="optB">B. <?php echo $opt2; ?></label>
           </div>
           <div class="form">
                <input type="radio" name="choice" id="optC" value="C">
                <label class="choice-desc" for="optC">C. <?php echo $opt3; ?></label>
           </div>
        </div>
        <div class="btn">
        <input type="hidden" name="q_id" id="q_id" value="<?php echo $q_id; ?>">
        <button type="button" class="next-btn" name="next" id="next">Next</button>

        </div>
        <?php
            }
        ?>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="JS/main.js"></script>
    <script src="assets/sweetalert/jquery-3.6.0.min.js"></script>
    <script src="assets/sweetalert/sweetalert2.all.min.js"></script>
</body>
</html>