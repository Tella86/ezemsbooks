document.addEventListener('DOMContentLoaded', () => {
    const itemsTable = document.querySelector('#itemsTable tbody');
    const totalAmountDisplay = document.getElementById('totalAmount');

    // Function to calculate total amount
    function calculateTotal() {
        let total = 0;
        itemsTable.querySelectorAll('tr').forEach(row => {
            const quantity = row.querySelector('[name="itemQuantity[]"]').value;
            const unitPrice = row.querySelector('[name="itemUnitPrice[]"]').value;
            const amount = quantity * unitPrice;
            row.querySelector('.itemAmount').textContent = `$${amount.toFixed(2)}`;
            total += amount;
        });
        totalAmountDisplay.textContent = `$${total.toFixed(2)}`;
    }

    // Add new item row
    document.getElementById('addItem').addEventListener('click', () => {
        const newRow = `
            <tr>
                <td><input type="text" class="form-control" name="itemDescription[]" required></td>
                <td><input type="number" class="form-control" name="itemQuantity[]" min="1" required></td>
                <td><input type="number" class="form-control" name="itemUnitPrice[]" min="0" step="0.01" required></td>
                <td class="itemAmount">$0.00</td>
                <td><button type="button" class="btn btn-danger btn-sm removeItem">Remove</button></td>
            </tr>`;
        itemsTable.insertAdjacentHTML('beforeend', newRow);
    });

    // Remove item row
    itemsTable.addEventListener('click', (event) => {
        if (event.target.classList.contains('removeItem')) {
            event.target.closest('tr').remove();
            calculateTotal();
        }
    });

    // Calculate total on quantity or price change
    itemsTable.addEventListener('input', (event) => {
        if (event.target.matches('[name="itemQuantity[]"], [name="itemUnitPrice[]"]')) {
            calculateTotal();
        }
    });
});
