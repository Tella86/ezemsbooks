<?php
$result = $conn->query("SELECT COUNT(*) AS total_invoices FROM invoices");
$totalInvoices = $result->fetch_assoc()['total_invoices'];

$totalExpenses = $conn->query("SELECT SUM(amount) AS total FROM expenses")->fetch_assoc()['total'];
$totalPaid = $conn->query("SELECT SUM(amount) AS total FROM expenses WHERE payment_status = 'Paid'")->fetch_assoc()['total'];
$totalUnpaid = $conn->query("SELECT SUM(amount) AS total FROM expenses WHERE payment_status = 'Unpaid'")->fetch_assoc()['total'];
