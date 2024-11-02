<?php
session_start();
// require 'includes/db.php';
// include 'includes/get_dashboard_data.php';

// Sample role determination - replace this with actual session data or a database lookup
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Invoice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <!-- Main container with sidebar -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="list-group">
                    <a href="admin_dahsboard.php" class="list-group-item list-group-item-action">Dashboard</a>
                    <a href="create_invoice.php" class="list-group-item list-group-item-action">Invoicing</a>
                    <a href="expenses.php" class="list-group-item list-group-item-action">Expenses</a>
                    <a href="inventory.php" class="list-group-item list-group-item-action">Inventory</a>
                    <a href="projects.php" class="list-group-item list-group-item-action">Projects</a>
                    <a href="view_invoices.php" class="list-group-item list-group-item-action">Views Invoices</a>
                    <?php if ($isAdmin): ?>
                        <a href="payroll.php" class="list-group-item list-group-item-action">Payroll</a>
                        <a href="settings.php" class="list-group-item list-group-item-action">Settings</a>
                    <?php endif; ?>
                </div>
            </nav>

            <!-- Content area -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="container mt-5">
                    <h2>Create Invoice</h2>
                    <form id="invoiceForm" action="includes/process_invoice.php" method="POST">
                        <!-- Customer Information -->
                        <div class="form-group">
                            <label for="customerName">Customer Name</label>
                            <input type="text" class="form-control" id="customerName" name="customerName" required>
                        </div>
                        <div class="form-group">
                            <label for="customerEmail">Customer Email</label>
                            <input type="email" class="form-control" id="customerEmail" name="customerEmail" required>
                        </div>
                        <div class="form-group">
                            <label for="invoiceDate">Invoice Date</label>
                            <input type="date" class="form-control" id="invoiceDate" name="invoiceDate" required>
                        </div>
                        <div class="form-group">
                            <label for="dueDate">Due Date</label>
                            <input type="date" class="form-control" id="dueDate" name="dueDate" required>
                        </div>

                        <!-- Line Items -->
                        <h4>Items</h4>
                        <table class="table" id="itemsTable">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" class="form-control" name="itemDescription[]" required></td>
                                    <td><input type="number" class="form-control" name="itemQuantity[]" min="1" required></td>
                                    <td><input type="number" class="form-control" name="itemUnitPrice[]" min="0" step="0.01" required></td>
                                    <td class="itemAmount">Ksh. 0.00</td>
                                    <td><button type="button" class="btn btn-danger btn-sm removeItem">Remove</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-secondary" id="addItem">Add Item</button>

                        <!-- Total Amount -->
                        <div class="mt-3">
                            <h4>Total: <span id="totalAmount">$0.00</span></h4>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Create Invoice</button>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <!-- JavaScript for the form functionality -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="assets/js/invoice.js"></script>
</body>
</html>
