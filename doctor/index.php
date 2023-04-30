<!DOCTYPE html>
<html>

<head>
    <title>Doctor Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <link rel="shortcut icon" href="../assets/images/favicon.ico">
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form id="register_form">
                <h1>Create Account</h1>
                <div class="social-container">
                </div>
                <input type="text" name="reg_name" id="reg_name" placeholder="Name" autocomplete="off">
                <input type="email" name="reg_email" id="reg_email" placeholder="Email" autocomplete="off">
                <input type="password" name="reg_password" id="reg_password" placeholder="Password" autocomplete="off">
                <button class="register" id="register">SignUp</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form id="login_form">
                <span id="invalid_details" class="text-danger"></span>
                <h1>Hello, Doctor!</h1>
                <div class="social-container">
                </div>
                <input type="email" name="log_email" id="log_email" placeholder="Email" autocomplete="off">
                <input type="password" name="log_password" id="log_password" placeholder="Password" autocomplete="off">
                <!-- <a href="#">Forgot Your Password</a> -->
                <button class="login" id="login">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <!-- <h1>Hello, Doctor!</h1>
                    <p>Enter your details and start journey with us</p> -->
                    <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_kltum0us.json"  background="transparent"  speed="1"  style="width: 400px; height: 400px;"  loop  autoplay></lottie-player>
                </div>
            </div>
        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <!-- <script src="../jquery-1.9.1.js"></script> -->
    <script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    // signUpButton.addEventListener('click', () => {
    //     container.classList.add("right-panel-active");
    // });
    // signInButton.addEventListener('click', () => {
    //     container.classList.remove("right-panel-active");
    // });
    $(document).ready(function() {
        $("#login_form").validate({
            rules: {
                "log_email": {
                    required: true
                },
                "password": {
                    required: true
                },
            },
            messages: {
                "email_id": {
                    required: "Please enter email"
                },
                "password": {
                    required: "Please enter Password"
                },
            },
            errorElement: 'div',
            ignore: ':not(:visible)',
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            }
        });
        $("#register_form").validate({
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
            if ($("#register_form").valid()) {
                var name = $("#reg_name").val();
                var email = $("#reg_email").val();
                var password = $("#reg_password").val();
                // console.log(email, password);
                register(name, email, password);
                $(this).prop("disabled", true);
                // add spinner to button
                $(this).html(
                    ` <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`
                );
            }
        }, 1500);
        });
        $("#login").click(function(e) {
            e.preventDefault();
            $("#login").val("Signing In...");
            setTimeout(function(){ 
            if ($("#login_form").valid()) {
                var email = $("#log_email").val();
                var password = $("#log_password").val();
                // console.log(email, password);
                login(email, password);
                $(this).prop("disabled", true);
                // add spinner to button
                $(this).html(
                    ` <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`
                );
            }
        }, 1500);
        });

        function register(name, email, password) {
            $.ajax({
                type: "POST",
                url: "controller/common_controller.php",
                data: {
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
                        $("#login").val("SIGN IN");
                    }
                }
            });
        }
    });
    </script>


</body>


</html>