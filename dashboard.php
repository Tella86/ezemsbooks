<?php
session_start();
require 'includes/db.php';
include 'includes/get_dashboard_data.php';
// Uncomment if you need to check user role and session status
// if (!isset($_SESSION['user_id'])) {
//     header("Location: auth/login.php");
//     exit();
// }
// if ($_SESSION['role'] !== 'admin') {
//     echo "Access denied. Admins only.";
//     exit();
// }

echo "Welcome, admin!";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Dashboard</h1>
        
        <!-- KPIs Section -->
        <div class="row text-center mt-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5>Total Revenue</h5>
                        <h2 id="totalRevenue">$0</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5>Total Invoices</h5>
                        <h2 id="totalInvoices"><?php echo $totalInvoices; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5>Total Expenses</h5>
                        <h2>$<?= number_format($totalExpenses, 2) ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row text-center mt-4">
            <div class="col-md-6">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5>Paid</h5>
                        <h2>$<?= number_format($totalPaid, 2) ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5>Unpaid</h5>
                        <h2>$<?= number_format($totalUnpaid, 2) ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row mt-5">
            <div class="col-md-6">
                <canvas id="revenueChart"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="expenseChart"></canvas>
            </div>
        </div>

        <!-- Table Section -->
        <div class="row mt-5">
            <div class="col-md-12">
                <h3>Recent Transactions</h3>
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody id="transactionsTable">
                        <!-- Recent transactions will be displayed here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="assets/js/dashboard.js"></script>
</body>
</html>
