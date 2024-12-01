<?php
// validation.php
class FormValidator {
    private $errors = [];
    private $data = [];
    
    public function validate($data) {
        $this->data = $data;
        
        // Student Number validation
        if (empty($data['studentNumber'])) {
            $this->addError('studentNumber', 'Student number is required');
        } elseif (!preg_match('/^[0-9]{8}$/', $data['studentNumber'])) {
            $this->addError('studentNumber', 'Student number must be 8 digits');
        }
        
        // Name validation
        if (empty($data['firstName'])) {
            $this->addError('firstName', 'First name is required');
        } elseif (!preg_match('/^[a-zA-Z\s]{2,50}$/', $data['firstName'])) {
            $this->addError('firstName', 'First name must contain only letters');
        }
        
        if (empty($data['lastName'])) {
            $this->addError('lastName', 'Last name is required');
        } elseif (!preg_match('/^[a-zA-Z\s]{2,50}$/', $data['lastName'])) {
            $this->addError('lastName', 'Last name must contain only letters');
        }
        
        // Email validation
        if (empty($data['email'])) {
            $this->addError('email', 'Email is required');
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->addError('email', 'Invalid email format');
        }
        
        // Password validation
        if (empty($data['password'])) {
            $this->addError('password', 'Password is required');
        } elseif (strlen($data['password']) < 8) {
            $this->addError('password', 'Password must be at least 8 characters');
        }
        
        if ($data['password'] !== $data['confirmPassword']) {
            $this->addError('confirmPassword', 'Passwords do not match');
        }
        
        // Program validation
        if (empty($data['program'])) {
            $this->addError('erollprogram', 'Please select a program');
        }
        
        return empty($this->errors);
    }
    
    private function addError($field, $message) {
        $this->errors[$field] = $message;
    }
    
    public function getErrors() {
        return $this->errors;
    }
}

