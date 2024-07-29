<?php 
include './config/db.php';
header('Content-Type: application/json');

function studentLogin(){
    global $conn, $response;
     $user_name = $_POST['user_name'];
     $password = $_POST['pass_word'];
     if (empty($user_name) ) {
        $result = $response->error("Username required");
        return json_encode(['meta' => $result]);
    }

    if (empty($password) ) {
        $result = $response->error("Password required");
        return json_encode(['meta' => $result]);
    }

    $sql = "SELECT ul.user_name, ul.pass_word FROM user_login ul WHERE ul.user_name = '{$user_name}' AND ul.pass_word = MD5('{$password}') AND ul.is_deleted = 0";
    $result_data = mysqli_query($conn, $sql);

    if ($result_data && mysqli_num_rows($result_data) > 0) {
        $result = $response->success("Login successful");
        return json_encode(['success' => true, 'meta' => $result]);
    } else {
        $result = $response->error("Invalid username or password");
        return json_encode(['error' => false, 'meta' => $result]);
    }
}

function saveStudent() {
    global $conn, $response;
    $student_id = $_POST['student_data_id'] ?? 0;
    $student_name = $_POST['student_name'] ?? '';
    $subject_name = $_POST['subject_name'] ?? '';
    $marks = $_POST['marks'] ?? '';
    $is_deleted = $_POST['is_deleted'] ?? 0;

    if (empty($student_name) || empty($subject_name) || empty($marks)) {
        $result = $response->error("All fields are required");
        echo json_encode(['success' => false, 'meta' => $result]);
        return;
    }

    if ($student_id == 0) {
        $sql = "SELECT * FROM student_data WHERE student_name='$student_name' AND is_deleted = 0";
        $result_check = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result_check) > 0) {
            $result = $response->error("Student name already exists");
            echo json_encode(['success' => false, 'meta' => $result]);
            return;
        }
    }


    if ($student_id > 0) {
        $query = "UPDATE student_data SET student_name='$student_name', subject_name='$subject_name', marks='$marks', updated_on=NOW() WHERE student_data_id=$student_id";
       } else {
        $query = "INSERT INTO student_data (student_name, subject_name, marks) VALUES ('$student_name', '$subject_name', '$marks')";
    }

    if (mysqli_query($conn, $query)) {
         $result = $response->success( $student_id > 0 ? 'Data updated successfully' : 'Data saved successfully');
        echo json_encode(['success' => true, 'meta' => $result]);
    } else {
        $result = $response->error("Error occurred: " . mysqli_error($conn));
        echo json_encode(['error' => false, 'meta' => $result]);
    }
}



function getStudent() {
    global $conn; 
    
    $sql = "SELECT student_data_id, student_name, subject_name, marks FROM student_data WHERE is_deleted = 0 ORDER BY student_data_id DESC";
    $result = $conn->query($sql);
    
    $students =array();
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
    } else {
        return array("message" => "No results found");
    }
    
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'meta' => $students]);
}


function deleteStudent() {
    global $conn, $response;
    $student_id = $_POST['student_data_id'];
    $sql = "UPDATE student_data SET is_deleted = 1, updated_on = now() WHERE student_data_id = $student_id";
    if (mysqli_query($conn, $sql)) {
        $result = $response->success("Data deleted successfully");
        echo json_encode(['success' => true, 'meta' => $result]);
    }else{
        $result = $response->error("Nothing to delete");
        echo json_encode(['error' => false, 'meta' => $result]);
    }
}