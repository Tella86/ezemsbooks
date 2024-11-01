// get_dashboard_data.php
<?php
header('Content-Type: application/json');
require 'db.php';

// Fetch KPI values and recent transactions
$kpiData = [
    'revenue' => 50000, // Replace with SQL query
    'expenses' => 20000, // Replace with SQL query
    'invoices' => 45 // Replace with SQL query
];

$recentTransactions = [
    ['date' => '2024-10-01', 'description' => 'Invoice Payment', 'category' => 'Revenue', 'amount' => 1200],
    ['date' => '2024-10-03', 'description' => 'Office Supplies', 'category' => 'Expense', 'amount' => -250],
    // Add more transactions from the database here
];

echo json_encode(['kpiData' => $kpiData, 'recentTransactions' => $recentTransactions]);
?>
