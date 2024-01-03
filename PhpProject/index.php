<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require('validation.php');

if (isset($_POST['submit'])) {
    $validation = new UserValidator($_POST);
    $errors = $validation->validateForm();

    if (empty($errors)) {
        $validation->insertUserIntoDatabase();
        header("Location: /Login/Login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>SignUp</title>
</head>
<style>
    body {
        background-image: url(background.jpg);
        padding-bottom: 20px;
    }

    .form-container {
        max-width: 50%;
        margin: auto;
        margin-bottom: 20px;
        padding: 20px;
        background-color: #ffc107;
    }

    .error {
        color: red;
    }
</style>

<body>
    <!-- Header/navbar -->
    <header class="pb-4">
        <nav class="navbar navbar-expand-lg justify-content-between navbar-light bg-secondary">
            <div class="navbar-nav">
                <a href="" class="nav-link px-5" style="font-weight: bold; color: white; font-size: 26px;">Rubico</a>
            </div>
        </nav>
    </header>
    <!-- All fields -->
    <section>
    <div class="container mt-5 p-5 bg-warning" style="width: 50%;">
            <h2 class="d-block mx-auto" style="width: 20%;">Sign Up</h2>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                <!-- field for first name -->
                <div class="form-group">
                    <label for="firstName">First Name: </label>
                    <input class="form-control" type="text" name="firstName" value="<?php echo isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : ''; ?>">
                    <div class="error">
                        <?php echo $errors['firstName'] ?? ''; ?>
                    </div>
                </div><br>
                <!-- field for last name -->
                <div class="form-group">
                    <label for="lastName">Last Name: </label>
                    <input class="form-control" type="text" name="lastName" value="<?php echo isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : ''; ?>">
                    <div class="error">
                        <?php echo $errors['lastName'] ?? ''; ?>
                    </div>
                </div><br>
                <!-- field for email -->
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input class="form-control" type="text" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    <div class="error">
                        <?php echo $errors['email'] ?? ''; ?>
                    </div>
                </div><br>
             <!-- field for password -->
                <div class="form-group">
                    <label for="password">Password: </label>
                    <input class="form-control" type="password" name="password" value="">
                    <div class="error">
                        <?php echo $errors['password'] ?? ''; ?>
                    </div>
                </div><br>

                <!-- field for confirm password -->
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password: </label>
                    <input class="form-control" type="password" name="confirmPassword" value="">
                    <div class="error">
                        <?php echo $errors['confirmPassword'] ?? ''; ?>
                    </div>
                </div><br>
                <!-- field for phone number -->
                <div class="form-group">
                    <label for="phoneNumber">Phone no.: </label>
                    <input class="form-control" type="text" name="phoneNumber" value="<?php echo isset($_POST['phoneNumber']) ? htmlspecialchars($_POST['phoneNumber']) : ''; ?>">
                    <div class="error">
                        <?php echo $errors['phoneNumber'] ?? ''; ?>
                    </div>
                </div><br>
                <!-- field for address -->
                <div class="form-group">
                    <label for="address">Address: </label>
                    <textarea class="form-control" name="address" rows="5"><?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?></textarea>
                    <div class="error">
                        <?php echo $errors['address'] ?? ''; ?>
                    </div>
                </div><br>
                <!-- Gender radio buttons-->
                <div>
                    <label id="GenderText">Gender</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="Male" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Male') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="genderMale">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="Female" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Female') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="genderFemale">
                            Female
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="Other" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Other') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="genderOther">
                            Other
                        </label>
                    </div>
                    <div class="error">
                        <?php echo $errors['gender'] ?? ''; ?>
                    </div>
                </div>
                <br>
                <!-- for dob or calender -->
                <div>
                    <label for="dateOfBirth" class="mb-2">Select your Date of birth</label><br>
                    <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker" inline="true">
                        <input type="date" class="form-control shadow bg-white rounded" name="dateOfBirth" value="<?php echo isset($_POST['dateOfBirth']) ? htmlspecialchars($_POST['dateOfBirth']) : ''; ?>">
                        <div class="error">
                            <?php echo $errors['dateOfBirth'] ?? ''; ?>
                        </div>
                    </div>
                </div>
                <br>
                <!-- Profile pic -->
                <!-- <div class="input-group">
                    <div class="custom-file">
                        <label class="custom-file-label" for="formFile">Select a profile picture</label><br>
                        <input type="file" class="custom-file-input" name="profilePicture">
                        <div class="error">
                           
                        </div>
                    </div>
                </div><br> -->
                <!-- for Drop down -->
                <div class="col-md-4">
                    <label class="form-label" for="inputState">Select Your City</label>
                    <select id="inputState" class="form-select" name="city">
                        <option disabled selected value>Please select</option>
                        <option value="Haridwar" <?php echo (isset($_POST['city']) && $_POST['city'] == 'Haridwar') ? 'selected' : ''; ?>>Haridwar</option>
                        <option value="Dehradun" <?php echo (isset($_POST['city']) && $_POST['city'] == 'Dehradun') ? 'selected' : ''; ?>>Dehradun</option>
                        <option value="Roorkee" <?php echo (isset($_POST['city']) && $_POST['city'] == 'Roorkee') ? 'selected' : ''; ?>>Roorkee</option>
                    </select>
                    <div class="error">
                        <?php echo $errors['city'] ?? ''; ?>
                    </div>
                </div>

                <br><br>
                <!-- for checkbox -->
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="agree" name="checkbox" <?php echo (isset($_POST['checkbox']) && $_POST['checkbox'] == 'agree') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="checkBox">
                        Agree to terms and conditions
                    </label> <br>
                    <div class="error">
                        <?php echo $errors['checkbox'] ?? ''; ?>
                    </div>
                </div>
                <!-- submit button -->
                <input type="submit" value="Sign Up" name="submit" 
                    class="btn btn-primary mx-auto d-block m-4 px-3">
                <!-- Login page redirection -->
                <div>
                    <center>
                        <p>Already have an account?</p>
                        <input type="login" value="Sign in" id="login" onclick="location.href='/Login/Login.php'" class="btn btn-primary mx-auto d-block m-4 px-3">
                    </center>
                </div>
            </form>
        </div>
    </section>
</body>

</html>
