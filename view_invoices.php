<?php
require 'includes/db.php';
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
$result = $conn->query("SELECT * FROM invoices");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoices</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <!-- Navbar -->
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

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="list-group">
                    <a href="dashboard.php" class="list-group-item list-group-item-action">Dashboard</a>
                    <a href="create_invoice.php" class="list-group-item list-group-item-action">Invoicing</a>
                    <a href="expenses.php" class="list-group-item list-group-item-action">Expenses</a>
                    <a href="inventory.php" class="list-group-item list-group-item-action">Inventory</a>
                    <a href="projects.php" class="list-group-item list-group-item-action">Projects</a>
                    <?php if ($isAdmin): ?>
                        <a href="payroll.php" class="list-group-item list-group-item-action">Payroll</a>
                        <a href="settings.php" class="list-group-item list-group-item-action">Settings</a>
                    <?php endif; ?>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="container mt-5">
                    <h2 class="mb-4">Invoices</h2>
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Invoice Date</th>
                                <th>Due Date</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['customer_name']; ?></td>
                                    <td><?php echo $row['customer_email']; ?></td>
                                    <td><?php echo $row['invoice_date']; ?></td>
                                    <td><?php echo $row['due_date']; ?></td>
                                    <td>$<?php echo number_format($row['total_amount'], 2); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
