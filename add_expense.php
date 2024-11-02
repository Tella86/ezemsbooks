<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Expense</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add Expense</h2>
        <form action="includes/process_expense.php" method="POST">
            <!-- Expense Information -->
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category" required>
                    <?php
                    require 'db.php';
                    $result = $conn->query("SELECT * FROM expense_categories");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['category_name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="expenseDate">Expense Date</label>
                <input type="date" class="form-control" id="expenseDate" name="expenseDate" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" class="form-control" id="amount" name="amount" step="0.01" min="0" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>
            <div class="form-group">
                <label for="paymentStatus">Payment Status</label>
                <select class="form-control" id="paymentStatus" name="paymentStatus" required>
                    <option value="Paid">Paid</option>
                    <option value="Unpaid">Unpaid</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Add Expense</button>
        </form>
    </div>
</body>
</html>
