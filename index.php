<?php
require('model/database.php');
require('model/accounts_db.php');
require('model/questions_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'show_login';
    }
}

switch ($action) {
    case 'show_login': {
        include('view/login.php');
        break;
    }

    case 'validate_login': {
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        if ($email == NULL || $password == NULL) {
            $error = 'Email and Password not included';
            include('errors/error.php');
        } else {
            $user = AccountsDB::validate_login($email, $password);
            $userId = $user->getId();
            if ($userId == false) {
                header("Location: .?action=display_registration");
            } else {
                header("Location: .?action=display_questions&userId=$userId");
            }
        }

        break;
    }

    case 'display_registration': {
        include('view/registration.php');
        break;
    }

    case 'submit_registration': {
        $firstName = filter_input(INPUT_POST, 'firstName');
        $lastName = filter_input(INPUT_POST, 'lastName');
        $birthday = filter_input(INPUT_POST, 'birthday');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        if(strlen($password) < 8) {
            echo 'Password should be at least 8 characters';
        }
        if (empty($firstName)){
            echo 'First name is empty'; }
        echo "<br>";
        if (empty($lastName)){
            echo 'Last name is empty'; }
        echo "<br>";
        if (empty($birthday)){
            echo 'Birthday is empty'; }
        echo "<br>";
        if (empty($email)){
            echo 'Email is empty'; }
        echo "<br>";
        if (strpos($email, '@') == false ) {
            echo 'Email must contain an @ character';
            echo "<br>";
        }
    }

    case 'display_questions': {
        $userId = filter_input(INPUT_GET, 'userId');
        if ($userId == NULL || $userId < 0) {
            header('Location: .?action=display_login');
        } else {
            $questions = get_users_questions($userId);
            include('view/display_questions.php');
        }
        break;
    }

    case 'display_question_form': {
        $userId = filter_input(INPUT_GET, 'userId');
        if ($userId == NULL || $userId < 0) {
            header("Location: .?action=display_login");
        } else {
            include('view/question_form.php');
        }
        break;
    }

    case 'submit_question': {
        $userId = filter_input(INPUT_POST, 'userId');
        $title = filter_input(INPUT_POST, 'title');
        $body = filter_input(INPUT_POST, 'body');
        $skills = filter_input(INPUT_POST, 'skills');
        if ($userId == NULL || $title == NULL || $body == NULL || $skills == NULL) {
            $error = 'All fields are required';
            include('errors/error.php');
        } else {
            create_question($title, $body, $skills, $userId);
            header("Location: .?action=display_questions&userId=$userId");
        }
        break;
    }

    default: {
        $error = 'Unknown Action';
        include('errors/error.php');
    }

    case 'delete_question': {
        $questionId = filter_input(INPUT_POST, 'questionId');
        $userId = filter_input(INPUT_POST, 'userId');
        if ($questionId == NULL || $userId == NULL) {
            $error = 'Please enter your information';
            include('error.php');
        } else {
            delete_question($questionId);
            header("Location: .?action=display_questions&userId=$userId");
        }
        break;
    }
    case 'edit_question': {
        $questionId = filter_input(INPUT_POST, 'questionId');
        $userId = filter_input(INPUT_POST, 'userId');
        if ($questionId == NULL || $userId = NULL) {
            $error = 'Please enter your information';
            include('error.php');
        } else {
            $questions = get_question($questionId);
            $actionString = 'update_question';
            include('create_new_question.php');
        }
        break;
    }
}
