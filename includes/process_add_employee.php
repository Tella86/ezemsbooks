<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employeeName = $_POST['employeeName'];
    $position = $_POST['position'];
    $hourlyRate = $_POST['hourlyRate'];

    $stmt = $conn->prepare("INSERT INTO employees (employee_name, position, hourly_rate) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $employeeName, $position, $hourlyRate);

    if ($stmt->execute()) {
        echo "Employee added successfully!";
        header("Location: view_employees.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

