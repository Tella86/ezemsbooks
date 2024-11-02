<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employeeId = $_POST['employee_id'];
    $workDate = $_POST['workDate'];
    $hoursWorked = $_POST['hoursWorked'];

    $stmt = $conn->prepare("INSERT INTO employee_hours (employee_id, work_date, hours_worked) VALUES (?, ?, ?)");
    $stmt->bind_param("isd", $employeeId, $workDate, $hoursWorked);

    if ($stmt->execute()) {
        echo "Hours recorded successfully!";
        header("Location: view_hours.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

