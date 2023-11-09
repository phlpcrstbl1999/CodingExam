<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
    <div class="wrapper">
        <div class="container">
        <form method="POST" action="backend/action.php">
            <input type="text" class="name-input" name="name" placeholder="Enter Your Name" required>
            <input type="submit" class="submit-btn" name="access" value="Access Questions">
        </form>
        </div>
    </div>

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