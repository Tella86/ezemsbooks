<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Hours Worked</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Record Hours Worked</h2>
        <form action="includes/process_record_hours.php" method="POST">
            <div class="form-group">
                <label for="employee">Select Employee</label>
                <select class="form-control" id="employee" name="employee_id" required>
                    <?php
                    require 'db.php';
                    $result = $conn->query("SELECT * FROM employees");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['employee_name']} - {$row['position']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="workDate">Work Date</label>
                <input type="date" class="form-control" id="workDate" name="workDate" required>
            </div>
            <div class="form-group">
                <label for="hoursWorked">Hours Worked</label>
                <input type="number" class="form-control" id="hoursWorked" name="hoursWorked" step="0.01" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Record Hours</button>
        </form>
    </div>
</body>
</html>
