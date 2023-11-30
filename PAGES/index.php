<?php
@include 'config.php';

session_start();

$register_error = '';  // Initialize the registration error message
$login_error = '';    // Initialize the login error message
$success_message = '';

if (isset($_POST['login'])) {
    // Login form is submitted
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $pass = $_POST['password'];

    $select = "SELECT * FROM user_form WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $stored_password = $row['password'];

        if (password_verify($pass, $stored_password)) {
            $user_type = $row['user_type'];
            $_SESSION['user_type'] = $user_type;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_department'] = $row['department'];

            if ($user_type == 'Admin') {
                header('location: homepage_admin.php');
            } elseif ($user_type == 'Super-Admin') {
                header('location: ongoing.php');
            } else {
                header('location: homepage_user.php');
            }
        } else {
            $login_error = 'Incorrect email or password!';
        }
    } else {
        $login_error = 'Incorrect email or password!';
    }
}

if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $department = $_POST['department'];

    $user_type = 'User';

    if (empty($department)) {
        $register_error = 'Please choose your department.';
    } else {
        $select = "SELECT * FROM user_form WHERE user_email = '$user_email'";
        $result = mysqli_query($conn, $select);

        if (mysqli_num_rows($result) > 0) {
            $register_error = 'Email already exists';
        } else {
            if ($password !== $cpassword) {
                $register_error = 'Passwords do not match!';
            } else {
                $pass = password_hash($password, PASSWORD_DEFAULT);

                $insert = "INSERT INTO user_form(name, user_email, password, user_type, department) VALUES('$name','$user_email','$pass','$user_type','$department')";
                mysqli_query($conn, $insert);
                $success_message = 'Registration successful.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login and Registration</title>
   <link rel="stylesheet" href="css/userform.css">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
        function selectDepartment() {
            var departmentSelect = document.getElementById("department");
            var selectedDepartment = departmentSelect.options[departmentSelect.selectedIndex].value;
            var errorSpan = document.getElementById("departmentError");

            if (selectedDepartment === "") {
                errorSpan.textContent = 'Please choose your department.';
            } else {
                errorSpan.textContent = '';
            }
        }
    </script>
</head>
<body>
<div class="container" id="container">

<div class="form-container sign-up-container">
    <form action="" method="post">
        <h1>Register Account</h1>
        <?php
        if(isset($register_error)){
            echo '<span class="error-msg">'.$register_error.'</span>';
        };
        ?>
        <input type="text" name="name" required placeholder="Full Name">
        <input type="email" name="user_email" required placeholder="Email Address">
        <input type="password" name="password" required placeholder="Enter Password" id="password">
        <span toggle="#password" class="eye-toggle fa fa-fw fa-eye field-icon toggle-password"></span>
        <input type="password" name="cpassword" required placeholder="Confirm Password">
        <select id="department" name="department" onchange="selectDepartment()">
			<option value="">Select a department</option>
			<option value="DIT">DIT</option>
			<option value="DCEA">DCEA</option>
			<option value="DCEE">DCEE</option>
			<option value="DAFE">DAFE</option>
			<option value="DIET">DIET</option>
		</select>
        <span id="departmentError" class="error-msg"></span>
        <button type="submit" name="register" class="learn-mores"><h3>Register</h3></button>
    </form>
</div>
<div class="form-container sign-in-container">
	<form action="" method="post">
		<h1>Log In</h1>
        <?php
        if (!empty($login_error)):
        ?>
        <div class="alert alert-danger w-75 mx-auto" style="font-size: 14px;">
            <?php echo $login_error; ?>
        </div>
        <?php
        endif;
        ?>
        <input type="text" name="user_email" required placeholder="Email Address">
        <input type="password" name="password" required placeholder="Enter Password" id="login-password">
        <span toggle="#login-password" class="eye-toggle fa fa-fw fa-eye field-icon toggle-password"></span>
        <button id="loginButton" type="submit" name="login" class="learn-more"><h3>Login</h3></button>
	</form>
</div>
<div class="overlay-container">
	<div class="overlay">
		<div class="overlay-panel overlay-left">
			<h1>Hello!</h1>
			<p>Make sure you use your CvSU account ok?</p>
			<button class="ghosts" id="signIn">Login</button>
		</div>
		<div class="overlay-panel overlay-right">
            <div class="text">
			    <h1>Welcome!</h1>
            </div>
			<p>Don't have an Account? Simply click the link below to register</p>
			<button class="ghost" id="signUp">Register</button>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
	const signUpButton = document.getElementById('signUp');
	const signInButton = document.getElementById('signIn');
	const container = document.getElementById('container');

	signUpButton.addEventListener('click', () => {
		container.classList.add("right-panel-active");
	});
	signInButton.addEventListener('click', () => {
		container.classList.remove("right-panel-active");
	});

    $('.toggle-password').on('click', function () {
        const passwordField = $($(this).attr('toggle'));

        if (passwordField.attr('type') === 'password') {
            passwordField.attr('type', 'text');
            $(this).removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            passwordField.attr('type', 'password');
            $(this).removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

</script>
</body>
</html>
