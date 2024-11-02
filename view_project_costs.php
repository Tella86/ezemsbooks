<?php
require 'db.php';

$query = "
    SELECT projects.id, project_name, start_date, end_date,
           SUM(project_expenses.amount) AS total_cost
    FROM projects
    LEFT JOIN project_expenses ON projects.id = project_expenses.project_id
    GROUP BY projects.id
";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Cost Summary</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Project Cost Summary</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Cost</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $row['project_name'] ?></td>
                        <td><?= $row['start_date'] ?></td>
                        <td><?= $row['end_date'] ?></td>
                        <td>$<?= number_format($row['total_cost'], 2) ?></td>
                        <td><a href="view_project_expenses.php?project_id=<?= $row['id'] ?>" class="btn btn-info btn-sm">View Expenses</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
