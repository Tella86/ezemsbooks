<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category = $_POST['category'];
    $expenseDate = $_POST['expenseDate'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $paymentStatus = $_POST['paymentStatus'];

    // Insert expense
    $stmt = $conn->prepare("INSERT INTO expenses (category_id, expense_date, amount, description, payment_status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isdss", $category, $expenseDate, $amount, $description, $paymentStatus);

    if ($stmt->execute()) {
        echo "Expense added successfully!";
        header("Location: view_expenses.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
