    <?php

// Include config file

require_once 'config.php';

 

// Define variables and initialize with empty values

$username = $password = "";

$username_err = $password_err = "";

 

// Processing form data when form is submitted

if($_SERVER["REQUEST_METHOD"] == "POST"){

 

    // Check if username is empty

    if(empty(trim($_POST["username"]))){

        $username_err = 'Please enter username.';

    } else{

        $username = trim($_POST["username"]);

    }

    

    // Check if password is empty

    if(empty(trim($_POST['password']))){

        $password_err = 'Please enter your password.';

    } else{

        $password = trim($_POST['password']);

    }

    

    // Validate credentials

    if(empty($username_err) && empty($password_err)){

        // Prepare a select statement

        $sql = "SELECT username FROM users WHERE where Username='$username' 
        and Password='$password'";

        

        if($stmt = mysqli_prepare($link, $sql)){

            // Bind variables to the prepared statement as parameters

            mysqli_stmt_bind_param($stmt, "s", $param_username);

            

            // Set parameters

            $param_username = $username;

            

            // Attempt to execute the prepared statement

            if(mysqli_stmt_execute($stmt)){

                // Store result

                mysqli_stmt_store_result($stmt);

                

                // Check if username exists, if yes then verify password

                if(mysqli_stmt_num_rows($stmt) == 1){                    

                    // Bind result variables

                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);

                    if(mysqli_stmt_fetch($stmt)){

                        if(password_verify($password, $hashed_password)){

                            /* Password is correct, so start a new session and

                            save the username to the session */

                            session_start();

                            $_SESSION['username'] = $username;      

                            header("location:index.html");

                        } else{

                            // Display an error message if password is not valid

                            $password_err = 'The password you entered was not valid.';

                        }

                    }

                } else{

                    // Display an error message if username doesn't exist

                    $username_err = 'No account found with that username.';

                }

            } else{

                echo "Oops! Something went wrong. Please try again later.";

            }

        }

    

        // Close statement

       // mysqli_stmt_close($stmt);          


    }

    

    // Close connection

    mysqli_close($link);

}

?>

 

<!DOCTYPE html>

<html lang="rtl">

<head>

    <meta charset="UTF-8">

    <title>Login</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">

    <style type="text/css">

        body{ font: 14px sans-serif; }

        .wrapper{ width: 350px; padding: 20px; }

    </style>

</head>

<body >

    <div class="wrapper">

        <h2>تسجيل الدخول</h2>
        <p>فضلاً قم بتعبئة بيانات الحساب الخاص بك</p>

        <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <table  align="center">
                  <tr valign"baseline">
     <td nowrap="nowrap" align="right"></td>
                  </tr>
                  <tr valign="baseline">
  
   <td>

<input type="text" name="username"class="form-control" value="<?php echo $username; ?>">

<span class="help-block"><?php echo $username_err; ?></span>

</div>    </td>
<td>
   <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
  

   <label>اسم المستخدم</label></td>
<tr>
   
<td>

<input type="password" name="password" class="form-control">

<span class="help-block"><?php echo $password_err; ?></span>

</div>
                     </td>
                     <td nowrap="nowrap" align="right">
       <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">

<label>كلمة المرور</label></td>
                  </tr>
                 
                 
<tr><td>        
            <div class="form-group">

                <input type="submit" class="btn btn-primary" value="Login">
            </div>
</td></tr>
<tr><td>            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
</td></tr>
<tr><td>           <a href="index.html"> تسجيل الدخول</a>
</td></tr>
                </table>        


        </form>

    </div>    

</body>

</html>

