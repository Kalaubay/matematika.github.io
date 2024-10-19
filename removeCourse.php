<?php 
session_start(); 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Пайдаланушы енгізген мәндерді алу
    $remove_id_user = $_POST['remove_id_user'] ?? '';
    $remove_course_user = $_POST['remove_course_user'] ?? '';

    $errors = [];

    // ID бос па тексеру
    if(empty($remove_id_user)){
        $errors['remove_id_user'] = "ID is empty";
    }

    // Курс бос па тексеру
    if(empty($remove_course_user)){
        $errors['remove_course_user'] = "Course is empty";
    }

    // Қателер бар ма тексеру
    if($errors){
        $_SESSION['status'] = 'error';
        $_SESSION['errors'] = $errors;
        header('Location: students.php'); // Қателер болса students.php бетіне қайта бағыттау
    }
    else {
        require_once 'common/connect.php'; // Қосылымды шақыру

        // Курс жаңарту әрекеті
        $result = removeCourse($remove_id_user, $remove_course_user);

        if($result){
            $_SESSION['status'] = 'successs';
            $_SESSION['message'] = 'Successfully updated course';
            header('Location: students.php'); // Сәтті жаңартылғаннан кейін қайта бағыттау
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = 'Failed to update course';
            header('Location: students.php'); // Қате жағдайда қайта бағыттау
        }
    }
}
