<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Login</title>
</head>
<!-- Background image -->
<body style="background-image: url('/background.jpg'); height: 100vh; background-repeat: no-repeat; background-size: cover;">
    <!-- header/navbar -->
    <header class="pb-4">
        <nav class="navbar navbar-expand-lg justify-content-between navbar-light bg-secondary">
            <div class="navbar-nav">
                <a href="" class="nav-link px-5" style="font-weight: bold; color: white; font-size: 26px;">Rubico</a>
            </div>
            <!-- link for refernce to Signup form -->
            <div class="pe-4">
                <a href="/index.php">
                    <button class="btn btn-primary">SignUp</button>
                </a>
            </div>
        </nav>
    </header>
    <br><br><br>
    <!-- Section for different fields -->
    <section>
        <div class="container mt-5 p-5 bg-warning " style="width: 35%;">
            <!-- heading for login -->
            <h2 class="d-block mx-auto" style="width: 20%;">Sign In</h2> 
            <br>
            <small class="text-danger" name="loginError">      <?php
                    // Include the loginValidator class and process the form
                    require_once 'loginValidator.php';

                    if (isset($_POST['submit'])) {
                        $validator = new loginValidator($_POST);
                        $errors = $validator->validateForm();

                        if (empty($errors)) {
                            $validator->login();
                        }
                    }
                    echo $errors['loginError'] ?? '';
                ?>
            </small>
            <form method="post">
                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input class="form-control" type="text" name="email">
                    <div class="error">
                        <?php echo $errors['email'] ?? ''; ?>
                    </div>
                </div><br>
                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password: </label>
                    <input class="form-control" type="password" name="password">
                    <div class="error">
                        <?php echo $errors['password'] ?? ''; ?>
                    </div>
                </div><br>
                <!--Submit  -->
                <input type="submit" name="submit" value="SignIn" class="btn btn-primary mx-auto d-block m-4 px-3">
            </form>
        </div>
    </section>
</body>
</html>
