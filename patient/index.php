<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="./style.css" />
    <link rel="shortcut icon" href="../assets/images/favicon.ico">
    <title>Patient Login</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form class="sign-in-form">
                    <div style="color:red;">
                        <span id="invalid_details" class="text-danger"></span>
                    </div>
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="log_email" id="log_email" placeholder="Email" autocomplete="off"/>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="log_password" id="log_password" placeholder="Password" autocomplete="off"/>
                    </div>
                    <input type="submit" id="login" value="Login" class="btn solid" />
                </form>
                <form action="#" class="sign-up-form">
                    <h2 class="title">Sign up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="reg_name" id="reg_name" placeholder="Username" autocomplete="off"/>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="reg_email" id="reg_email" placeholder="Email" autocomplete="off"/>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="reg_password" id="reg_password" placeholder="Password" autocomplete="off"/>
                    </div>
                    <input type="submit" id="register" class="btn" value="Sign up" />
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here ?</h3>
                    <p>
                        Enter your details to get your Electronic Medical Records
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Sign up
                    </button>
                </div>
                <img src="./img/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us ?</h3>
                    <p>
                        To keep connected with us please login with your personal info
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Sign in
                    </button>
                </div>
                <img src="./img/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="./app.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script>
    $(document).ready(function() {
        $(".login_form").validate({
            rules: {
                "log_email": {
                    required: true
                },
                "log_password": {
                    required: true
                },
            },
            messages: {
                "log_email": {
                    required: "Please enter email"
                },
                "log_password": {
                    required: "Please enter Password"
                },
            },
            errorElement: 'div',
            ignore: ':not(:visible)',
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            }
        });
        $(".register_form").validate({
            rules: {
                "reg_name": {
                    required: true
                },
                "reg_email": {
                    required: true
                },
                "reg_password": {
                    required: true
                },
            },
            messages: {
                "reg_name": {
                    required: "Please enter email"
                },
                "reg_email": {
                    required: "Please enter Password"
                },
                "reg_password": {
                    required: "Please enter Password"
                },
            },
            errorElement: 'div',
            ignore: ':not(:visible)',
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            }
        });
        $("#register").click(function(e) {
            e.preventDefault();
            $("#register").val("Registering...");
            setTimeout(function(){ 
            var name = $("#reg_name").val();
            var email = $("#reg_email").val();
            var password = $("#reg_password").val();
            var pre_id="PT1000";
            var currentdate = new Date();
            var pat_id = pre_id + currentdate.getDate() +
                (currentdate.getMonth() + 1) +
                currentdate.getHours() +
                currentdate.getMinutes() +
                currentdate.getMilliseconds();
            register(pat_id,name, email, password);
            $(this).prop("disabled", true);
            $(this).html(
                ` <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`
            );
        }, 1500);
        });
        $("#login").click(function(e) {
            e.preventDefault();
            $("#login").val("Signing In...");
            setTimeout(function(){ 
            var email = $("#log_email").val();
            var password = $("#log_password").val();
            login(email, password);
            $(this).prop("disabled", true);
            $(this).html(
                ` <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`
            );
        }, 1500);
        });

        function register(pat_id,name, email, password) {
            $.ajax({
                type: "POST",
                url: "controller/common_controller.php",
                data: {
                    pat_id:pat_id.trim(),
                    name: name.trim(),
                    email: email.trim(),
                    password: password.trim(),
                    Type: "register"
                },
                success: function(result) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Register Successful',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    setTimeout(function(){ location.reload(true); }, 1500);
                }
            });
        }

        function login(email, password) {
            $.ajax({
                type: "POST",
                url: "controller/common_controller.php",
                data: {
                    email: email.trim(),
                    password: password.trim(),
                    Type: "login"
                },
                success: function(result) {
                    if (result == 1) {
                        window.location = "dashboard.php";
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Invalid Credentials!'
                        })
                        $("#login").val("LOGIN");
                    }
                }
            });
        }
    });
    </script>
</body>

</html>