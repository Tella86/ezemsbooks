<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $projectName = $_POST['projectName'];
    $projectDescription = $_POST['projectDescription'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    $stmt = $conn->prepare("INSERT INTO projects (project_name, project_description, start_date, end_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $projectName, $projectDescription, $startDate, $endDate);

    if ($stmt->execute()) {
        echo "Project added successfully!";
        header("Location: view_projects.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
