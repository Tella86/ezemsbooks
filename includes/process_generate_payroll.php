<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $payPeriodStart = $_POST['payPeriodStart'];
    $payPeriodEnd = $_POST['payPeriodEnd'];
    $taxRate = 0.2; // 20% tax deduction

    $query = "
        SELECT e.id, e.hourly_rate, SUM(h.hours_worked) AS total_hours
        FROM employees e
        JOIN employee_hours h ON e.id = h.employee_id
        WHERE h.work_date BETWEEN ? AND ?
        GROUP BY e.id
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $payPeriodStart, $payPeriodEnd);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $employeeId = $row['id'];
        $totalHours = $row['total_hours'];
        $hourlyRate = $row['hourly_rate'];
        
        $grossPay = $totalHours * $hourlyRate;
        $taxDeductions = $grossPay * $taxRate;
        $netPay = $grossPay - $taxDeductions;

        $payrollStmt = $conn->prepare("INSERT INTO payroll (employee_id, pay_period_start, pay_period_end, gross_pay, tax_deductions, net_pay) VALUES (?, ?, ?, ?, ?, ?)");
        $payrollStmt->bind_param("issddd", $employeeId, $payPeriodStart, $payPeriodEnd, $grossPay, $taxDeductions, $netPay);
        $payrollStmt->execute();
    }

    echo "Payroll generated successfully!";
    header("Location: view_payroll.php");

    $stmt->close();
    $conn->close();
}
?>
