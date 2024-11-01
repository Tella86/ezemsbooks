<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Invoice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Create Invoice</h2>
        <form id="invoiceForm" action="process_invoice.php" method="POST">
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
                        <td class="itemAmount">$0.00</td>
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

    <script src="assets/js/invoice.js"></script>
</body>
</html>
