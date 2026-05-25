<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Via Store | Manage Orders</title>
    <!-- Frameworks & Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Link sa iyong External CSS (Glassmorphism Style) -->
    <link rel="stylesheet" href="style.css">
</head>
<body class="min-h-screen" id="adminBody">

    <!-- Mobile Overlay -->
    <div id="sidebarOverlay" onclick="toggleMobileSidebar()" class="overlay"></div>

    <!-- Sidebar (Futuristic Glass Version) -->
    <aside class="sidebar" id="mainSidebar">
        <div class="sidebar-brand" id="sidebarBrand">VIA STORE</div>

        <nav class="flex-1 space-y-2 overflow-y-auto mt-4">
            <!-- Collapse Button (Desktop) -->
            <button onclick="toggleDesktopSidebar()" class="hidden lg:flex w-full items-center p-3 rounded-xl text-slate-400 hover:bg-white/10 transition mb-4">
                <i class="fas fa-exchange-alt w-6 text-center"></i>
                <span class="nav-text ml-3 font-medium text-sm">Collapse Menu</span>
            </button>

            <a href="/admin" class="nav-link">
                <i class="fas fa-chart-pie w-6 text-center"></i>
                <span class="nav-text ml-3">Dashboard</span>
            </a>
            <a href="/items" class="nav-link">
                <i class="fas fa-box w-6 text-center"></i>
                <span class="nav-text ml-3">Item List</span>
            </a>
            <a href="/expenses" class="nav-link">
                <i class="fas fa-receipt w-6 text-center"></i>
                <span class="nav-text ml-3">Expenses</span>
            </a>
            <a href="/orders" class="nav-link active">
                <i class="fas fa-shopping-cart w-6 text-center"></i>
                <span class="nav-text ml-3">Orders</span>
            </a>
            <a href="/customers" class="nav-link">
                <i class="fas fa-users w-6 text-center"></i>
                <span class="nav-text ml-3">Customers</span>
            </a>
            <a href="/settings" class="nav-link">
                <i class="fas fa-cog w-6 text-center"></i>
                <span class="nav-text ml-3">Settings</span>
            </a>
        </nav>

        <!-- Logout Section -->
        <div class="mt-auto pt-4 border-t border-white/10">
            <button onclick="logout()" class="w-full text-left flex items-center p-3 rounded-xl text-red-400 hover:bg-red-500/10 transition font-medium">
                <i class="fas fa-sign-out-alt w-6 text-center"></i>
                <span class="nav-text ml-3">Logout</span>
            </button>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="main-content" id="mainContentArea">
        
        <!-- Mobile Header Navigation -->
        <div class="flex lg:hidden items-center justify-between mb-8 glass-card !p-4">
            <button onclick="toggleMobileSidebar()" class="w-10 h-10 flex items-center justify-center rounded-lg bg-white/10 text-white">
                <i class="fas fa-bars text-lg"></i>
            </button>
            <div class="font-bold text-white tracking-widest">ORDER LOGS</div>
            <div class="w-10 h-10 rounded-lg bg-indigo-500/20 text-indigo-400 flex items-center justify-center">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>

        <header class="flex flex-col md:flex-row md:justify-between md:items-center mb-10 gap-6">
            <div>
                <h1 class="text-3xl font-bold text-white">Order Logs</h1>
                <p class="text-slate-400">Manage and track your store sales in real-time.</p>
            </div>
            <div class="glass-card !px-8 !py-4 flex flex-col items-center md:items-end border-indigo-500/30">
                <p class="text-[10px] text-slate-500 uppercase font-black tracking-widest mb-1">Total Revenue (Completed)</p>
                <h2 id="totalRevenue" class="text-3xl font-black text-indigo-400">₱0.00</h2>
            </div>
        </header>

        <!-- Orders Table Container -->
        <div class="glass-card !p-0 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-white/5 border-b border-white/10">
                        <tr>
                            <th class="p-5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Order ID</th>
                            <th class="p-5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Customer & Product</th>
                            <th class="p-5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Qty / Price</th>
                            <th class="p-5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                            <th class="p-5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Order Date</th>
                            <th class="p-5 text-center text-xs font-bold text-slate-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="orderTableBody" class="text-slate-300">
                        <tr>
                            <td colspan="6" class="p-10 text-center">
                                <div class="animate-pulse text-slate-500 font-bold uppercase tracking-widest">
                                    <i class="fas fa-spinner fa-spin mr-2"></i> Loading logs...
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        // --- AUTH CHECK ---
        async function checkAuth() {
            try {
                const res = await fetch('/api/check-auth');
                const data = await res.json();
                if (!data.authorized || data.role !== 'admin') {
                    window.location.href = '/login';
                }
            } catch (err) {
                window.location.href = '/login';
            }
        }

        // --- UI LOGIC ---
        function toggleDesktopSidebar() {
            const sidebar = document.getElementById('mainSidebar');
            sidebar.classList.toggle('collapsed');
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        }

        function toggleMobileSidebar() {
            const sidebar = document.getElementById('mainSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        function initSettings() {
            const savedName = localStorage.getItem('storeName') || 'VIA STORE';
            document.getElementById('sidebarBrand').innerText = savedName.toUpperCase();
            
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (isCollapsed && window.innerWidth >= 1024) {
                document.getElementById('mainSidebar').classList.add('collapsed');
            }
        }

        // --- DATA LOGIC ---
        async function fetchOrders() {
            try {
                // Pinapasa natin ang current timestamp para iwas sa browser cache
                const res = await fetch(`/api/orders?t=${Date.now()}`);
                if (!res.ok) throw new Error("Fetch failed");
                const orders = await res.json();
                
                const tbody = document.getElementById('orderTableBody');
                let revenue = 0;

                if (!orders || orders.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="6" class="p-20 text-center text-slate-500 font-bold uppercase tracking-widest">No orders found.</td></tr>`;
                    document.getElementById('totalRevenue').innerText = '₱0.00';
                    return;
                }

                tbody.innerHTML = orders.map(order => {
                    if (order.status === 'Completed') revenue += parseFloat(order.total_price || 0);
                    
                    const date = order.order_date ? new Date(order.order_date).toLocaleString() : 'N/A';
                    
                    // Glassmorphism-style status colors logic
                    let statusClass = 'bg-slate-500/10 text-slate-400 border-slate-500/20';
                    if (order.status === 'Pending') statusClass = 'bg-amber-500/10 text-amber-400 border-amber-500/20';
                    if (order.status === 'Completed') statusClass = 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20';
                    if (order.status === 'Cancelled') statusClass = 'bg-rose-500/10 text-rose-400 border-rose-500/20';

                    return `
                        <tr class="border-b border-white/5 hover:bg-white/5 transition-colors group">
                            <td class="p-5 font-mono text-slate-500 text-sm">#${order.id}</td>
                            <td class="p-5">
                                <div class="flex flex-col">
                                    <span class="font-bold text-white text-sm">${order.customer_name || 'Guest User'}</span>
                                    <span class="text-xs text-indigo-300/70 italic">${order.product_name || 'Deleted Product'}</span>
                                </div>
                            </td>
                            <td class="p-5">
                                <div class="flex flex-col">
                                    <span class="font-black text-indigo-400 text-lg">₱${parseFloat(order.total_price).toLocaleString()}</span>
                                    <span class="text-[10px] text-slate-500 font-bold uppercase">Qty: ${order.quantity}</span>
                                </div>
                            </td>
                            <td class="p-5">
                                <select onchange="updateStatus(${order.id}, this.value)" 
                                    class="${statusClass} border px-3 py-1.5 rounded-xl text-[10px] font-black uppercase cursor-pointer outline-none bg-slate-900">
                                    <option value="Pending" ${order.status === 'Pending' ? 'selected' : ''}>Pending</option>
                                    <option value="Completed" ${order.status === 'Completed' ? 'selected' : ''}>Completed</option>
                                    <option value="Cancelled" ${order.status === 'Cancelled' ? 'selected' : ''}>Cancelled</option>
                                </select>
                            </td>
                            <td class="p-5 text-slate-400 text-[11px] font-medium leading-tight">${date}</td>
                            <td class="p-5 text-center">
                                <button onclick="deleteOrder(${order.id})" class="w-9 h-9 flex items-center justify-center rounded-xl bg-rose-500/10 text-rose-400 hover:bg-rose-500 hover:text-white transition-all mx-auto">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </button>
                            </td>
                        </tr>`;
                }).join('');

                document.getElementById('totalRevenue').innerText = '₱' + revenue.toLocaleString(undefined, {minimumFractionDigits: 2});
            } catch (err) {
                console.error(err);
                document.getElementById('orderTableBody').innerHTML = `<tr><td colspan="6" class="p-10 text-center text-rose-400 font-bold uppercase tracking-widest">⚠️ Database Connection Error</td></tr>`;
            }
        }

        async function updateStatus(id, newStatus) {
            try {
                const res = await fetch(`/api/orders/${id}`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ status: newStatus })
                });
                if (res.ok) fetchOrders();
                else alert("Failed to update status");
            } catch (err) { alert("Update failed"); }
        }

        async function deleteOrder(id) {
            if (!confirm("Remove this order record permanently?")) return;
            try {
                const res = await fetch(`/api/orders/${id}`, { method: 'DELETE' });
                if (res.ok) fetchOrders();
                else alert("Failed to delete record");
            } catch (err) { console.error(err); }
        }

        async function logout() {
            if (confirm("Are you sure you want to logout?")) {
                await fetch('/api/logout', { method: 'POST' });
                localStorage.clear();
                window.location.href = '/login';
            }
        }

        window.onload = () => {
            checkAuth();
            initSettings();
            fetchOrders();
        };
    </script>
</body>
</html>