<?php
    session_start();
    require_once('db/db.php');
    if(!isset($_SESSION['name'])) {
        header('location:login.php');
    }else {
        $name = $_SESSION['name'];
        $u_id = $_SESSION['u_id'];
      
    }
    $sqlcount = "Select count(q_id) q_idCount from tbluseranswers where u_id = $u_id";
    $resultcount = mysqli_query($con, $sqlcount);
    while($rowcount = mysqli_fetch_assoc($resultcount)){
        $count = $rowcount['q_idCount'];
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
    <?php
            
            if(isset($_SESSION['completed'])) {
    ?>
    <?php
       } else {
    ?>
    <h3>HELLO <?php echo strtoupper($name); ?>!</h3>
    <?php
    }
    ?>
    <div class="questions-container">
    
        <?php
            $sql = "Select * from tblquestions where q_id NOT IN (Select q_id from tbluseranswers where u_id = $u_id)";
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
        <input type="hidden" name="u_id" id="u_id" value="<?php echo $u_id; ?>">
        <input type="hidden" name="count" id="count" value="<?php echo $count; ?>">
        <?php
            if($count == 7) {

        ?>
        <button type="button" class="next-btn" name="next" id="next">Submit</button>
        <?php
            }else {
        ?>
        <button type="button" class="next-btn" name="next" id="next">Next</button>
        <?php
        }
        ?>        
        </div>
        <?php
            }
            if(isset($_SESSION['completed'])) {
                $sql = "Select * from tblresults";
                $result = mysqli_query($con, $sql);
                while($row = mysqli_fetch_assoc($result)){
                    $result1 = $row['result1'];
                    $result2 = $row['result2'];
                    $result3 = $row['result3'];
                }

                $sqlc = "SELECT u_ans, COUNT(*) AS num FROM tbluseranswers where u_id = $u_id GROUP BY u_ans";
                $resultc = mysqli_query($con, $sqlc);
                while($rowc = mysqli_fetch_assoc($resultc)){
                    // if($rowc['u_ans'] == "A") {
                    //     $aCount = $rowc['num'];
                    // }else if($rowc['u_ans'] == "B") {
                    //     $bCount = $rowc['num'];
                    // }else {
                    //     $cCount = $rowc['num'];
                    // }
                }
                $aCount = 2;
                $bCount = 2;
                $cCount = 4;
        ?>
         <div class="results">
         <h3>Here's your result <?php echo strtoupper($name); ?>!</h3>
         <div class="result">
         <?php 
                if($aCount > $bCount && $aCount > $cCount) {
                    $examResult = $result2;
                }else if($bCount > $aCount && $bCount > $cCount) {
                    $examResult = $result3;
                }else if($cCount > $aCount && $cCount > $bCount) {
                    $examResult = $result1;
                }else if($aCount == $bCount) {
                    $examResult = $result3;
                }else if($bCount == $cCount) {
                    $examResult = $result3;
                }else if($aCount == $cCount) {
                    $examResult = $result2;
                }
                echo $examResult;
            ?>  
         </div>
         <form method="POST" action="backend/action.php">
            <input type="submit" class="next-btn" name="tryAgain" value="Try Again">
         </form>
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
    <script>
        <?php
            if(isset($_SESSION['status'])) {
        ?>    
            swal.fire({
                icon: '<?php echo $_SESSION['status_code']; ?>',
                title: '<?php echo $_SESSION['status']; ?>',
                text: '<?php echo $_SESSION['status_text']; ?>'
            })
        <?php 
            unset($_SESSION['status']);
            unset($_SESSION['status_code']);
            unset($_SESSION['status_text']);
        }
        
        ?>
    </script>
</body>
</html>