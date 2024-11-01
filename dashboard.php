<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    echo "Access denied. Admins only.";
    exit();
}

// Admin-only content goes here
echo "Welcome, admin!";
include 'includes/get_dashboard_data.php';
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
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5>Total Revenue</h5>
                        <h2 id="totalRevenue">$0</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5>Total Expenses</h5>
                        <h2 id="totalExpenses">$0</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5>Net Profit</h5>
                        <h2 id="netProfit">$0</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5>Total Invoices</h5>
                        <h2 id="totalInvoices">0</h2>
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
                <table class="table table-striped">
                    <thead>
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
