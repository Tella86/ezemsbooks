<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Payroll</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Generate Payroll</h2>
        <form action="includes/process_generate_payroll.php" method="POST">
            <div class="form-group">
                <label for="payPeriodStart">Pay Period Start</label>
                <input type="date" class="form-control" id="payPeriodStart" name="payPeriodStart" required>
            </div>
            <div class="form-group">
                <label for="payPeriodEnd">Pay Period End</label>
                <input type="date" class="form-control" id="payPeriodEnd" name="payPeriodEnd" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Generate Payroll</button>
        </form>
    </div>
</body>
</html>
