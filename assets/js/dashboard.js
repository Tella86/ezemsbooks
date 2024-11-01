// Sample data (in a real setup, this data should be fetched from the server)
const dashboardData = {
    revenue: 50000,
    expenses: 20000,
    invoices: 45,
    recentTransactions: [
        { date: '2024-10-01', description: 'Invoice Payment', category: 'Revenue', amount: 1200 },
        { date: '2024-10-03', description: 'Office Supplies', category: 'Expense', amount: -250 },
        { date: '2024-10-05', description: 'Service Payment', category: 'Revenue', amount: 3000 },
        { date: '2024-10-07', description: 'Utility Bill', category: 'Expense', amount: -400 },
    ]
};

// Update KPIs
document.getElementById('totalRevenue').textContent = `$${dashboardData.revenue}`;
document.getElementById('totalExpenses').textContent = `$${dashboardData.expenses}`;
document.getElementById('netProfit').textContent = `$${dashboardData.revenue - dashboardData.expenses}`;
document.getElementById('totalInvoices').textContent = dashboardData.invoices;

// Render recent transactions table
const transactionsTable = document.getElementById('transactionsTable');
dashboardData.recentTransactions.forEach(transaction => {
    const row = `<tr>
        <td>${transaction.date}</td>
        <td>${transaction.description}</td>
        <td>${transaction.category}</td>
        <td>${transaction.amount > 0 ? '$' + transaction.amount : '-$' + Math.abs(transaction.amount)}</td>
    </tr>`;
    transactionsTable.insertAdjacentHTML('beforeend', row);
});

// Revenue Chart
const revenueCtx = document.getElementById('revenueChart').getContext('2d');
new Chart(revenueCtx, {
    type: 'bar',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May'],
        datasets: [{
            label: 'Monthly Revenue',
            data: [12000, 15000, 10000, 20000, 17000],
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: { beginAtZero: true }
        }
    }
});

// Expense Chart
const expenseCtx = document.getElementById('expenseChart').getContext('2d');
new Chart(expenseCtx, {
    type: 'pie',
    data: {
        labels: ['Rent', 'Utilities', 'Supplies', 'Salaries', 'Other'],
        datasets: [{
            label: 'Expense Breakdown',
            data: [5000, 2000, 1500, 8000, 3500],
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    }
});
