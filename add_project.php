<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Project</h2>
        <form action="includes/process_add_project.php" method="POST">
            <div class="form-group">
                <label for="projectName">Project Name</label>
                <input type="text" class="form-control" id="projectName" name="projectName" required>
            </div>
            <div class="form-group">
                <label for="projectDescription">Description</label>
                <textarea class="form-control" id="projectDescription" name="projectDescription"></textarea>
            </div>
            <div class="form-group">
                <label for="startDate">Start Date</label>
                <input type="date" class="form-control" id="startDate" name="startDate" required>
            </div>
            <div class="form-group">
                <label for="endDate">End Date</label>
                <input type="date" class="form-control" id="endDate" name="endDate">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Project</button>
        </form>
    </div>
</body>
</html>
