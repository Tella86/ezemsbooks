<?php
require 'db.php';

$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';
$paymentStatusFilter = isset($_GET['payment_status']) ? $_GET['payment_status'] : '';

$query = "SELECT expenses.id, expense_date, amount, description, payment_status, category_name
          FROM expenses
          JOIN expense_categories ON expenses.category_id = expense_categories.id";
          
if ($categoryFilter || $paymentStatusFilter) {
    $query .= " WHERE ";
    $conditions = [];
    if ($categoryFilter) {
        $conditions[] = "category_id = '$categoryFilter'";
    }
    if ($paymentStatusFilter) {
        $conditions[] = "payment_status = '$paymentStatusFilter'";
    }
    $query .= implode(' AND ', $conditions);
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Summary</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Expense Summary</h2>

        <!-- Filter Form -->
        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <label for="category">Filter by Category</label>
                    <select class="form-control" id="category" name="category">
                        <option value="">All</option>
                        <?php
                        $categories = $conn->query("SELECT * FROM expense_categories");
                        while ($row = $categories->fetch_assoc()) {
                            $selected = $row['id'] == $categoryFilter ? 'selected' : '';
                            echo "<option value='{$row['id']}' $selected>{$row['category_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="payment_status">Filter by Payment Status</label>
                    <select class="form-control" id="payment_status" name="payment_status">
                        <option value="">All</option>
                        <option value="Paid" <?= $paymentStatusFilter == 'Paid' ? 'selected' : '' ?>>Paid</option>
                        <option value="Unpaid" <?= $paymentStatusFilter == 'Unpaid' ? 'selected' : '' ?>>Unpaid</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary mt-4">Apply Filters</button>
                </div>
            </div>
        </form>

        <!-- Expenses Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Payment Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $row['expense_date'] ?></td>
                        <td><?= $row['description'] ?></td>
                        <td><?= $row['category_name'] ?></td>
                        <td>$<?= number_format($row['amount'], 2) ?></td>
                        <td><?= $row['payment_status'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
