<?php include './config/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STUDENT INFORMATION</title>
    <?php include 'common/header.php'; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   </head>
<body>
    <div class="center-container">
        <div class="form-card">
            <h5 class="text-center text-warning font-weight-bold mb-0">LOGIN</h5>
            <form action="" method="post" id="user_login_form" autocomplete="off">
                <div class="form-group">
                    <label class="font-weight-bold">Username</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" name="user_name" id="user_name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Password</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-lock icon-left"></i></span>
                        </div>
                        <input type="password" name="pass_word" id="pass_word" class="form-control">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-eye" id="togglePassword"></i></span>
                        </div>
                    </div>
                    <div class="container">
                        <a href="" class="anchor-tag"> Forgot Password?</a>
                    </div>
                </div>
                <div class="form-group align-right">
                    <button type="button" class="btn btn-sm btn-secondary font-weight-bold" id="resetRecords">CLEAR</button>
                    <button type="button" class="btn btn-sm btn-dark font-weight-bold" id="loginRecords" onclick="studentLogin()">LOGIN</button>
                </div>
            </form>
        </div>
    </div>
    <?php include 'common/footer.php'; ?>
</body>
</html>
<script>
     document
   .getElementById("togglePassword")
   .addEventListener("click", function () {
     const passwordField = document.getElementById("pass_word");
     const type =
       passwordField.getAttribute("type") === "password" ? "text" : "password";
     passwordField.setAttribute("type", type);
     this.classList.toggle("fa-eye");
     this.classList.toggle("fa-eye-slash");
   });
</script>