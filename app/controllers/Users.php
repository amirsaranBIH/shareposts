<?php

  class Users extends Controller {
    public function __construct() {

    }

    public function register() {
      // Check for POST
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Process form

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data = [
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'name_error' => '',
          'email_error' => '',
          'password_error' => '',
          'confirm_password_error' => ''
        ];

        // Validate email
        if (empty($data['email'])) {
          $data['email_err'] = 'Please enter email';
        }

        // Validate name
        if (empty($data['name'])) {
          $data['name_err'] = 'Please enter name';
        }

        // Validate password
        if (empty($data['password'])) {
          $data['password_err'] = 'Please enter password';
        } elseif (strlen($data['password']) < 6) {
          $data['password_err'] = 'Password must be at least 6 characters';
        }

        // Validate Confirm Password
        if (empty($data['confirm_password'])) {
          $data['confirm_password_err'] = 'Please confirm password';
        } else {
          if ($data['password'] !== $data['confirm_password']) {
            $data['confirm_password_err'] = 'Passwords do not match';
          }
        }

        // Make sure errors are empty
        if (empty($data['email_err']) &&
            empty($data['name_err']) &&
            empty($data['password_err']) &&
            empty($data['confirm_password_err'])) {
          // Valideated
          die('Success');
        } else {
          // Load view with errors
          $this->view('users/register', $data);
        }
      } else {
        // Init data
        $data = [
          'name' => '',
          'email' => '',
          'password' => '',
          'confirm_password' => '',
          'name_error' => '',
          'email_error' => '',
          'password_error' => '',
          'confirm_password_error' => ''
        ];

        // Load view
        $this->view('users/register', $data);
      }
    }

    public function login() {
      // Check for POST
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Process form

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data = [
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'email_error' => '',
          'password_error' => ''
        ];

        // Validate email
        if (empty($data['email'])) {
          $data['email_err'] = 'Please enter email';
        }

        // Validate password
        if (empty($data['password'])) {
          $data['password_err'] = 'Please enter password';
        }

        // Make sure errors are empty
        if (empty($data['email_err']) &&
            empty($data['password_err'])) {
          // Valideated
          die('Success');
        } else {
          // Load view with errors
          $this->view('users/login', $data);
        }
      } else {
        // Init data
        $data = [
          'email' => '',
          'password' => '',
          'email_error' => '',
          'password_error' => ''
        ];

        // Load view
        $this->view('users/login', $data);
      }
    }
  }