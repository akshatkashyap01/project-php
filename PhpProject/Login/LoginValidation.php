<?php
session_start();


// Connect to the database
        $servername = "127.0.0.1";
        $username = "root";
        $password = "1126";
        $dbname = "user";
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

class loginValidator
{
    private $data;
    private $errors = [];
    private static $fields = ['loginError', 'email', 'password'];

    public function __construct($post_data)
    {
        $this->data = $post_data;
    }

    public function validateForm()
    {
        foreach (self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                $this->addError($field, ucfirst($field) . ' is required');
            }
        }

        $this->validateEmail();
        $this->validatePassword();

        return $this->errors;
    }

    public function login()
    {
        $email = $this->data['email'];
        $password = $this->data['password'];

        // Check if the user exists
        $sql = "SELECT ID, password FROM users WHERE email='$email'";
        $result = $GLOBALS['conn']->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $row['password'])) {
                // Password is correct
                $_SESSION["auth_user"] = $row['ID'];
                header("Location: /Dashboard/Dashboard.php");
                exit;
            } else {
                // Incorrect credentials
                $this->addError('loginError', 'Login failed. Incorrect credentials.');
            }
        } else {
            // User doesn't exist
            $this->addError('loginError', 'User not found.');
        }
    }

    private function validateEmail()
    {
        $val = trim($this->data['email']);
        if (empty($val)) {
            $this->addError('email', 'Email cannot be empty');
        } else {
            if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                $this->addError('email', 'Invalid email format');
            }
        }
    }

    private function validatePassword()
    {
        $val = trim($this->data['password']);
        if (empty($val)) {
            $this->addError('password', 'Password cannot be empty');
        }
    }

    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }
}

// Example Usage:
if (isset($_POST['login'])) {
    $validator = new loginValidator($_POST);
    $errors = $validator->validateForm();

    if (empty($errors)) {
        $validator->login();
    }
}
?>
