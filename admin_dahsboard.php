<?php
session_start();
require 'includes/db.php';
include 'includes/get_dashboard_data.php';

// Sample role determination - replace this with actual session data or a database lookup
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/theme.js"></script>
</head>
<body>

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">MyApp Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarTheme" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Theme
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarTheme">
                    <select id="themeSelector" class="dropdown-item form-control">
                        <option value="">Default</option>
                        <option value="dark-theme">Dark</option>
                        <option value="light-theme">Light</option>
                    </select>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Sidebar and Content -->
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="list-group">
                <a href="dashboard.php" class="list-group-item list-group-item-action">Dashboard</a>
                <a href="invoicing.php" class="list-group-item list-group-item-action">Invoicing</a>
                <a href="expenses.php" class="list-group-item list-group-item-action">Expenses</a>
                <a href="inventory.php" class="list-group-item list-group-item-action">Inventory</a>
                <a href="projects.php" class="list-group-item list-group-item-action">Projects</a>
                <?php if ($isAdmin): ?>
                    <a href="payroll.php" class="list-group-item list-group-item-action">Payroll</a>
                    <a href="settings.php" class="list-group-item list-group-item-action">Settings</a>
                <?php endif; ?>
            </div>
        </nav>

        <!-- Main Content Area -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <h1 class="mt-4">Welcome, <?php echo $isAdmin ? "Admin" : "User"; ?></h1>
            <p>Quick overview of financial data or other dashboard KPIs will go here.</p>

            <div class="row">
                <?php if ($isAdmin): ?>
                    <!-- Admin-specific content -->
                    <div class="col-md-4">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Total Revenue</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-body">Pending Payrolls</div>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- User-specific content -->
                    <div class="col-md-4">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">Assigned Projects</div>
                        </div>
                    </div>
                <?php endif; ?>
                <!-- Common content for both roles -->
                <div class="col-md-4">
                    <div class="card bg-info text-white mb-4">
                        <div class="card-body">Upcoming Deadlines</div>
                    </div>
                </div>
            </div>

            <!-- Additional KPIs -->
            <div class="row">
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
                            <h2>Ksh.<?= number_format($totalExpenses, 2) ?></h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row text-center mt-4">
                <div class="col-md-4">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5>Paid</h5>
                            <h2>Ksh.<?= number_format($totalPaid, 2) ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <h5>Unpaid</h5>
                            <h2>Ksh.<?= number_format($totalUnpaid, 2) ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Bootstrap and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
