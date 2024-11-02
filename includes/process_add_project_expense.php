<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $projectId = $_POST['project_id'];
    $expenseDescription = $_POST['expenseDescription'];
    $expenseDate = $_POST['expenseDate'];
    $amount = $_POST['amount'];

    $stmt = $conn->prepare("INSERT INTO project_expenses (project_id, expense_description, expense_date, amount) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issd", $projectId, $expenseDescription, $expenseDate, $amount);

    if ($stmt->execute()) {
        echo "Expense added successfully!";
        header("Location: view_project_expenses.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
