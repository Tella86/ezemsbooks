<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Employee</h2>
        <form action="includes/process_add_employee.php" method="POST">
            <div class="form-group">
                <label for="employeeName">Employee Name</label>
                <input type="text" class="form-control" id="employeeName" name="employeeName" required>
            </div>
            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" class="form-control" id="position" name="position">
            </div>
            <div class="form-group">
                <label for="hourlyRate">Hourly Rate</label>
                <input type="number" class="form-control" id="hourlyRate" name="hourlyRate" step="0.01" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Employee</button>
        </form>
    </div>
</body>
</html>
