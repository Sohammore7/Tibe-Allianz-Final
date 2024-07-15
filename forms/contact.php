<?php
    $conn = new mysqli('localhost','root','','test1');
  if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
  }else{
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $YourName = $_POST['name'];
    $YourEmail = $_POST['email'];
    $Subject = $_POST['subject'];
    $Message = $_POST['message'];  

    $sql = "INSERT INTO registration (Your_Name, Your_Email, Subject, Message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss",$YourName, $YourEmail, $Subject, $Message);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Message sent successfully.";
        } else {
            $_SESSION['message'] = "Error sending message: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['message'] = "All fields are required.";
    }

    header("Location: ../index.html");
    exit();
}
?>