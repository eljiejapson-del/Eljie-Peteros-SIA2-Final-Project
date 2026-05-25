<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Via Store Admin</title>
    <!-- Frameworks & Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Link sa iyong External CSS (Glassmorphism Style) -->
   <link rel="stylesheet" href="http://127.0.0.1:8000/style.css">

    <script>
        // Feature: Auth Protection (Original Feature)
        async function checkAuth() {
            try {
                const res = await fetch('/api/check-auth');
                const data = await res.json();
                if (!data.authorized) {
                    window.location.href = '/index';
                }
            } catch (err) {
                window.location.href = '/index';
            }
        }
        checkAuth();
    </script>
</head>
<body class="min-h-screen" id="adminBody">

    <!-- Mobile Overlay -->
    <div id="sidebarOverlay" onclick="toggleMobileSidebar()" class="overlay"></div>

    <!-- Sidebar (Futuristic Glass Version) -->
    <aside class="sidebar" id="mainSidebar">
        <div class="sidebar-brand" id="sidebarBrand">VIA STORE</div>

        <nav class="flex-1 space-y-2 overflow-y-auto mt-4">
            <!-- Collapse Button (Desktop - Original Feature) -->
            <button onclick="toggleDesktopSidebar()" class="hidden lg:flex w-full items-center p-3 rounded-xl text-slate-400 hover:bg-white/10 transition mb-4">
                <i class="fas fa-exchange-alt w-6 text-center"></i>
                <span class="nav-text ml-3 font-medium text-sm">Collapse Menu</span>
            </button>

            <a href="/admin" class="nav-link active">
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
            <a href="/orders" class="nav-link">
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

        <!-- Logout Section (Original Feature) -->
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
                <i class="fas fa-bars"></i>
            </button>
            <div class="font-bold text-white tracking-widest">VIA STORE</div>
            <div class="w-10 h-10 rounded-full bg-cyan-500/20 flex items-center justify-center text-cyan-400">
                <i class="fas fa-user-shield"></i>
            </div>
        </div>

        <div id="section-dashboard">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-white">Store Overview</h1>
                    <p class="text-slate-400">Welcome back, <span id="adminName" class="font-bold text-cyan-400">Admin</span></p>
                </div>
                <button onclick="loadDashboard()" class="glass-card !p-3 hover:bg-white/10 transition active:scale-95 group">
                    <i class="fas fa-sync-alt text-cyan-400 group-hover:rotate-180 transition-transform duration-500"></i>
                </button>
            </div>
            
            <!-- Statistics Cards (Glass Style) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <div class="glass-card hover:translate-y-[-5px] transition-transform">
                    <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center mb-4 text-blue-400"><i class="fas fa-box"></i></div>
                    <p class="text-slate-400 text-sm font-medium">Total Products</p>
                    <h3 class="text-3xl font-bold text-white" id="totalProducts">0</h3>
                </div>
                <div class="glass-card hover:translate-y-[-5px] transition-transform">
                    <div class="w-10 h-10 bg-cyan-500/20 rounded-lg flex items-center justify-center mb-4 text-cyan-400"><i class="fas fa-shopping-bag"></i></div>
                    <p class="text-slate-400 text-sm font-medium">Pending Orders</p>
                    <h3 class="text-3xl font-bold text-cyan-400" id="pendingOrders">0</h3>
                </div>
                <div class="glass-card hover:translate-y-[-5px] transition-transform">
                    <div class="w-10 h-10 bg-emerald-500/20 rounded-lg flex items-center justify-center mb-4 text-emerald-400"><i class="fas fa-users"></i></div>
                    <p class="text-slate-400 text-sm font-medium">Total Customers</p>
                    <h3 class="text-3xl font-bold text-emerald-400" id="totalCustomers">0</h3>
                </div>
                <div class="glass-card hover:translate-y-[-5px] transition-transform">
                    <div class="w-10 h-10 bg-red-500/20 rounded-lg flex items-center justify-center mb-4 text-red-400"><i class="fas fa-receipt"></i></div>
                    <p class="text-slate-400 text-sm font-medium">Monthly Expenses</p>
                    <h3 class="text-3xl font-bold text-red-400" id="totalExpenses">₱0.00</h3>
                </div>
            </div>

            <!-- Visual Charts (Glass Panels) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="glass-card">
                    <h2 class="text-lg font-bold mb-6 text-white flex items-center gap-2">
                        <i class="fas fa-layer-group text-cyan-400"></i> Inventory Levels
                    </h2>
                    <div class="relative h-[300px] w-full">
                        <canvas id="inventoryChart"></canvas>
                    </div>
                </div>
                <div class="glass-card">
                    <h2 class="text-lg font-bold mb-6 text-white flex items-center gap-2">
                        <i class="fas fa-chart-pie text-pink-500"></i> Category Distribution
                    </h2>
                    <div class="relative h-[300px] w-full">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Logic Script (Preserved all original features) -->
    <script>
        let invChart, catChart;

        // Sidebar State Management (Desktop)
        function toggleDesktopSidebar() {
            const sidebar = document.getElementById('mainSidebar');
            sidebar.classList.toggle('collapsed');
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        }

        // Sidebar State Management (Mobile)
        function toggleMobileSidebar() {
            const sidebar = document.getElementById('mainSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        async function initSettings() {
            const savedName = localStorage.getItem('storeName') || 'VIA STORE';
            document.getElementById('sidebarBrand').innerText = savedName.toUpperCase();
            document.getElementById('adminName').innerText = localStorage.getItem('userName') || 'Admin';

            if (localStorage.getItem('sidebarCollapsed') === 'true' && window.innerWidth >= 1024) {
                document.getElementById('mainSidebar').classList.add('collapsed');
            }
        }

        async function loadDashboard() {
            try {
                const fetchSafe = async (url) => {
                    const r = await fetch(url + '?t=' + new Date().getTime());
                    return r.ok ? r.json() : [];
                };

                const [products, orders, expenses, customers] = await Promise.all([
                    fetchSafe('/api/products'),
                    fetchSafe('/api/orders'),
                    fetchSafe('/api/expenses'),
                    fetchSafe('/api/customers')
                ]);

                document.getElementById('totalProducts').innerText = products.length;
                document.getElementById('pendingOrders').innerText = orders.filter(o => o.status?.toLowerCase() === 'pending').length;
                document.getElementById('totalCustomers').innerText = customers.length;
                
                const totalExp = expenses.reduce((sum, e) => sum + parseFloat(e.amount || 0), 0);
                document.getElementById('totalExpenses').innerText = '₱' + totalExp.toLocaleString(undefined, {minimumFractionDigits: 2});

                renderCharts(products);
            } catch (err) { 
                console.error("Dashboard Load Error:", err); 
            }
        }

        function renderCharts(products) {
            // Updated colors for Glassmorphism
            Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
            Chart.defaults.color = '#94a3b8';
            
            if (invChart) invChart.destroy();
            const invCtx = document.getElementById('inventoryChart').getContext('2d');
            invChart = new Chart(invCtx, {
                type: 'bar',
                data: {
                    labels: products.slice(0, 8).map(p => p.name),
                    datasets: [{ 
                        label: 'Stock Amount', 
                        data: products.slice(0, 8).map(p => p.stock), 
                        backgroundColor: '#00f2ff', 
                        borderRadius: 8,
                        barThickness: 20
                    }]
                },
                options: { 
                    maintainAspectRatio: false, 
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.05)' }, border: { display: false } },
                        x: { grid: { display: false }, border: { display: false } }
                    }
                }
            });

            const counts = {};
            products.forEach(p => {
                const cat = p.category || 'Uncategorized';
                counts[cat] = (counts[cat] || 0) + 1;
            });
            
            if (catChart) catChart.destroy();
            const catCtx = document.getElementById('categoryChart').getContext('2d');
            catChart = new Chart(catCtx, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(counts),
                    datasets: [{ 
                        data: Object.values(counts), 
                        backgroundColor: ['#00f2ff', '#ec4899', '#10b981', '#f59e0b', '#8b5cf6'],
                        borderWidth: 0,
                    }]
                },
                options: { 
                    maintainAspectRatio: false, 
                    cutout: '75%',
                    plugins: { legend: { position: 'bottom', labels: { color: '#94a3b8', usePointStyle: true, padding: 20 } } }
                }
            });
        }

        async function logout() {
            if (confirm("Are you sure you want to logout?")) {
                await fetch('/api/logout', { method: 'POST' });
                localStorage.clear();
                window.location.href = '/login';
            }
        }

        window.onload = () => {
            initSettings();
            loadDashboard();
        };
    </script>
</body>
</html>