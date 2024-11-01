<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customerName = $_POST['customerName'];
    $customerEmail = $_POST['customerEmail'];
    $invoiceDate = $_POST['invoiceDate'];
    $dueDate = $_POST['dueDate'];
    $itemDescriptions = $_POST['itemDescription'];
    $itemQuantities = $_POST['itemQuantity'];
    $itemUnitPrices = $_POST['itemUnitPrice'];
    
    $totalAmount = 0;

    // Start transaction
    $conn->begin_transaction();

    try {
        // Insert invoice
        $stmt = $conn->prepare("INSERT INTO invoices (customer_name, customer_email, invoice_date, due_date, total_amount) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssd", $customerName, $customerEmail, $invoiceDate, $dueDate, $totalAmount);
        $stmt->execute();
        $invoiceId = $stmt->insert_id;

        // Insert line items
        $stmt = $conn->prepare("INSERT INTO invoice_items (invoice_id, description, quantity, unit_price) VALUES (?, ?, ?, ?)");
        for ($i = 0; $i < count($itemDescriptions); $i++) {
            $description = $itemDescriptions[$i];
            $quantity = $itemQuantities[$i];
            $unitPrice = $itemUnitPrices[$i];
            $totalAmount += $quantity * $unitPrice;
            $stmt->bind_param("isid", $invoiceId, $description, $quantity, $unitPrice);
            $stmt->execute();
        }

        // Update total amount in invoice
        $updateStmt = $conn->prepare("UPDATE invoices SET total_amount = ? WHERE id = ?");
        $updateStmt->bind_param("di", $totalAmount, $invoiceId);
        $updateStmt->execute();

        // Commit transaction
        $conn->commit();

        echo "Invoice created successfully!";
        header("Location: view_invoices.php");
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }

    $stmt->close();
    $conn->close();
}
?>
