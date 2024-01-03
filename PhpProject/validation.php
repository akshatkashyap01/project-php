<?php

class UserValidator {

    private $data;
    private $errors = [];
    private static $fields = ['firstName', 'lastName', 'email', 'password', 'confirmPassword', 'phoneNumber', 'address', 'gender', 'dateOfBirth', 'city', 'checkbox'];

    public function __construct($post_data) {
        $this->data = $post_data;
    }

    public function validateForm() {
        foreach (self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                $this->addError($field, ucfirst($field) . ' is required');
            }
        }

        $this->validateFirstName();
        $this->validateLastName();
        $this->validateEmail();
        $this->validatePassword();
        $this->validateConfirmPassword();
        $this->validatePhoneNumber();
        $this->validateAddress();
        $this->validateGender();
        $this->validateDateOfBirth();
        // $this->validateProfilePicture();
        $this->validateCity();
        $this->validateCheckbox();

        return $this->errors;
    }

    public function insertUserIntoDatabase() {
        $servername = "127.0.0.1";
        $username = "root";
        $password = "1126";
        $dbname = "user";

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert data into the database using prepared statements
        $sql = "INSERT INTO users (firstName, lastName, email, password, phoneNumber, address, gender, dateOfBirth, city, checkbox) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssssss",
            $this->data['firstName'],
            $this->data['lastName'],
            $this->data['email'],
            password_hash($this->data['password'], PASSWORD_BCRYPT), // Hash the password
            $this->data['phoneNumber'],
            $this->data['address'],
            $this->data['gender'],
            $this->data['dateOfBirth'],
            // $this->data['profilePicture'],
            $this->data['city'],
            $this->data['checkbox']
        );

        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }


    private function validateFirstName() {
        $val = trim($this->data['firstName']);
        if (empty($val)) {
            $this->addError('firstName', 'First name cannot be empty');
        } else {
            if (!preg_match('/^[a-zA-Z]{3,10}$/', $val)) {
                $this->addError('firstName', 'Only letters allowed, and must be 3 letters min and 12 letters max');
            }
        }
    }

    private function validateLastName() {
        $val = trim($this->data['lastName']);
        if (empty($val)) {
            $this->addError('lastName', 'Last name cannot be empty');
        } else {
            if (!preg_match('/^[a-zA-Z]{3,10}$/', $val)) {
                $this->addError('lastName', 'Only letters allowed, and must be 12 letters max');
            }
        }
    }

    private function validateEmail() {
        $val = trim($this->data['email']);
        if (empty($val)) {
            $this->addError('email', 'Email cannot be empty');
        } else {
            if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                $this->addError('email', 'Invalid email format');
            }
        }
    }

    private function validatePassword() {
        $val = trim($this->data['password']);
        if (empty($val)) {
            $this->addError('password', 'Password cannot be empty');
        } elseif (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+])(?=.*[a-zA-Z]).{8,}$/', $val)) {
            $this->addError('password', 'Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character');
        }
    }

    private function validateConfirmPassword() {
        $val = trim($this->data['confirmPassword']);
        if (empty($val)) {
            $this->addError('confirmPassword', 'Confirm Password cannot be empty');
        } elseif ($val !== $this->data['password']) {
            $this->addError('confirmPassword', 'Passwords do not match');
        }
    }

    private function validatePhoneNumber() {
        $val = trim($this->data['phoneNumber']);
        if (empty($val)) {
            $this->addError('phoneNumber', 'Phone number cannot be empty');
        } else {
            if (!preg_match('/^[0-9]{10}$/', $val)) {
                $this->addError('phoneNumber', 'Phone number should have 10 digits only and they must be numeric');
            }
        }
    }

    private function validateAddress() {
        $val = trim($this->data['address']);
        if (empty($val)) {
            $this->addError('address', 'Address cannot be empty');
        } 
    }

    private function validateGender() {
        $val = trim($this->data['gender']);
        if (empty($val)) {
            $this->addError('gender', 'Please select a gender');
        }
    }

    private function validateDateOfBirth() {
        $val = trim($this->data['dateOfBirth']);
        if (empty($val)) {
            $this->addError('dateOfBirth', 'Date of birth cannot be empty');
        } 
    }

    // private function validateProfilePicture() {
        
    //     $val = $this->data['profilePicture'];
    //     if (empty($val['name'])) {
    //         $this->addError('profilePicture', 'Profile picture is required');
    //     } else {
    //         $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    //         $file_extension = strtolower(pathinfo($val['name'], PATHINFO_EXTENSION));
    //         if (!in_array($file_extension, $allowed_extensions)) {
    //             $this->addError('profilePicture', 'Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.');
    //         }
    //     }
    // }

    private function validateCity() {
        $val = trim($this->data['city']);
        if (empty($val)) {
            $this->addError('city', 'Please select a city');
        }
    }

    private function validateCheckbox() {
        $val = trim($this->data['checkbox']);
        if (empty($val)) {
            $this->addError('checkbox', 'You must agree to terms and conditions');
        }
    }

    private function addError($key, $val) {
        $this->errors[$key] = $val;
    }

   

}

?>
