async function loadDashboardData() {
    try {
        // Fetch everything in one single network request to your new Laravel endpoint
        const response = await fetch('/api/dashboard/stats');
        const data = await response.json();

        // Dynamically inject data directly into your existing HTML element IDs
        document.getElementById('totalProducts').innerText = data.totalProducts;
        document.getElementById('pendingOrders').innerText = data.pendingOrders;
        document.getElementById('totalCustomers').innerText = data.totalCustomers;
        
        // Format and display the total expenses using your local currency format
        document.getElementById('totalExpenses').innerText = 'P ' + data.totalExpenses.toLocaleString(undefined, {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });

    } catch (err) {
        console.error("Dashboard Load Error:", err);
    }
}

// Call the function when your admin dashboard loads
document.addEventListener('DOMContentLoaded', loadDashboardData);