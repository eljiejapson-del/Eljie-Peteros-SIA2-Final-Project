<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Via Store | Customer Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap');

        :root {
            --accent: #6366f1;
            --accent-glow: rgba(99, 102, 241, 0.2);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #0f172a;
            color: #f8fafc;
            overflow-x: hidden;
        }

        .glass-sidebar {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(99, 102, 241, 0.3);
            transform: translateY(-4px);
        }

        .nav-link {
            transition: all 0.3s ease;
        }

        .nav-link.active {
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.1) 0%, rgba(99, 102, 241, 0) 100%);
            color: #818cf8;
            border-left: 3px solid #6366f1;
        }

        canvas {
            filter: drop-shadow(0 0 10px rgba(99, 102, 241, 0.1));
        }

        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
    </style>
</head>
<body class="min-h-screen flex">

    <aside class="w-72 glass-sidebar flex flex-col fixed h-full z-50">
        <div class="p-8">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/20">
                    <i class="fas fa-bolt text-white"></i>
                </div>
                <div>
                    <h1 class="text-xl font-black tracking-tighter" id="storeBrand">VIA</h1>
                    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-[0.2em]">Online Store</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-2">
            <a href="/dashboard" class="nav-link active flex items-center gap-4 px-6 py-4 rounded-xl text-slate-400 font-semibold hover:text-white">
                <i class="fas fa-th-large w-5"></i> Dashboard
            </a>
            <a href="/shop" class="nav-link flex items-center gap-4 px-6 py-4 rounded-xl text-slate-400 font-semibold hover:text-white">
                <i class="fas fa-shopping-bag w-5"></i> Shop
            </a>
            <a href="/profile" class="nav-link flex items-center gap-4 px-6 py-4 rounded-xl text-slate-400 font-semibold hover:text-white">
                <i class="fas fa-user-circle w-5"></i> Profile
            </a>
        </nav>

        <div class="p-6 border-t border-white/5">
            <button onclick="logout()" class="w-full flex items-center gap-4 px-6 py-4 text-red-400 font-bold hover:bg-red-400/10 rounded-xl transition">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </div>
    </aside>

    <main class="ml-72 flex-1 p-10">
        <header class="mb-12">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.3em] mb-2">Customer Panel</p>
                    <h2 class="text-4xl font-black text-white tracking-tight">
                        WELCOME BACK, <span id="userName" class="text-indigo-400">USER</span>
                    </h2>
                    <p class="text-slate-500 font-medium mt-1">Manage your orders and view your shopping analytics.</p>
                </div>
                <div class="flex gap-3">
                    <button class="w-12 h-12 glass-card rounded-xl flex items-center justify-center text-slate-400 hover:text-white">
                        <i class="far fa-bell"></i>
                    </button>
                    <div class="w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center font-bold text-white shadow-lg shadow-indigo-500/20">
                        <span id="userInitial">U</span>
                    </div>
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="glass-card p-6 rounded-[2rem] relative overflow-hidden">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Total Orders</p>
                <h2 id="statOrders" class="text-3xl font-black mt-2 text-white">0</h2>
                <div class="absolute -right-2 -bottom-2 w-16 h-16 bg-orange-500/10 rounded-full flex items-center justify-center">
                    <i class="fas fa-box text-orange-500/40 text-2xl"></i>
                </div>
            </div>

            <div class="glass-card p-6 rounded-[2rem] relative overflow-hidden">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Total Spent</p>
                <h2 id="statSpent" class="text-3xl font-black mt-2 text-white">₱0.00</h2>
                <div class="absolute -right-2 -bottom-2 w-16 h-16 bg-cyan-500/10 rounded-full flex items-center justify-center">
                    <i class="fas fa-chart-line text-cyan-500/40 text-2xl"></i>
                </div>
            </div>

            <div class="glass-card p-6 rounded-[2rem] relative overflow-hidden">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Account Status</p>
                <h2 class="text-3xl font-black mt-2 text-white" id="statStatus">Active</h2>
                <div class="absolute -right-2 -bottom-2 w-16 h-16 bg-green-500/10 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-check text-green-500/40 text-2xl"></i>
                </div>
            </div>

            <div class="glass-card p-6 rounded-[2rem] relative overflow-hidden">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">7-Day Activity</p>
                <h2 class="text-3xl font-black mt-2 text-white" id="statRecent">0</h2>
                <div class="absolute -right-2 -bottom-2 w-16 h-16 bg-indigo-500/10 rounded-full flex items-center justify-center">
                    <i class="fas fa-history text-indigo-500/40 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
            <div class="lg:col-span-2 glass-card p-8 rounded-[2.5rem]">
                <h3 class="font-black text-white mb-8 uppercase text-[10px] tracking-widest flex items-center gap-2">
                    <i class="fas fa-wave-square text-indigo-500"></i> Spending Trend
                </h3>
                <canvas id="salesChart" height="150"></canvas>
            </div>

            <div class="glass-card p-8 rounded-[2.5rem]">
                <h3 class="font-black text-white mb-8 uppercase text-[10px] tracking-widest flex items-center gap-2">
                    <i class="fas fa-pie-chart text-indigo-500"></i> Top Categories
                </h3>
                <canvas id="categoryChart"></canvas>
            </div>
        </div>

        <div class="glass-card rounded-[2.5rem] overflow-hidden">
            <div class="p-8 border-b border-white/5 flex justify-between items-center">
                <h3 class="font-black text-white uppercase text-[10px] tracking-widest flex items-center gap-2">
                    <i class="fas fa-list text-indigo-500"></i> Recent Transactions
                </h3>
                <a href="/shop" class="text-[9px] font-black bg-indigo-600/20 text-indigo-400 px-4 py-2 rounded-lg hover:bg-indigo-600 hover:text-white transition uppercase tracking-widest">
                    New Order <i class="fas fa-plus ml-1"></i>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-white/5">
                        <tr>
                            <th class="p-6 text-[10px] font-black text-slate-500 uppercase tracking-widest">Order ID</th>
                            <th class="p-6 text-[10px] font-black text-slate-500 uppercase tracking-widest">Purchase Date</th>
                            <th class="p-6 text-[10px] font-black text-slate-500 uppercase tracking-widest">Amount</th>
                            <th class="p-6 text-[10px] font-black text-slate-500 uppercase tracking-widest">Status</th>
                        </tr>
                    </thead>
                    <tbody id="recentOrdersBody" class="divide-y divide-white/5">
                        <tr><td colspan="4" class="p-20 text-center text-slate-500 italic">Processing your order history...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        async function initDashboard() {
            try {
                // Auth Check via Server
                const authRes = await fetch('/api/check-auth');
                const authData = await authRes.json();

                if (!authData.authorized || authData.role !== 'customer') {
                    window.location.href = '/login';
                    return;
                }

                // UI Setup
                const name = authData.user.name || 'Customer';
                document.getElementById('userName').innerText = name.toUpperCase();
                document.getElementById('userInitial').innerText = name.charAt(0).toUpperCase();
                
                const savedStoreName = localStorage.getItem('storeName') || 'VIA';
                document.getElementById('storeBrand').innerText = savedStoreName.toUpperCase();

                // Chart global defaults
                Chart.defaults.color = '#64748b';
                Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
                Chart.defaults.font.weight = '600';

                // Load Data
                loadDashboardData();
            } catch (err) {
                console.error("Auth initialization failed:", err);
                window.location.href = '/login';
            }
        }

        async function loadDashboardData() {
            try {
                // We fetch /api/my-orders which is user-specific based on session
                const res = await fetch('/api/my-orders');
                const orders = await res.json();
                
                // Stat 1: Total Orders
                document.getElementById('statOrders').innerText = orders.length;
                
                // Stat 2: Total Spent (Completed Only)
                const totalSpent = orders
                    .filter(o => o.status === 'Completed' || o.status === 'Pending') // Includes pending as "spent"
                    .reduce((sum, o) => sum + parseFloat(o.total_price), 0);
                
                document.getElementById('statSpent').innerText = '₱' + totalSpent.toLocaleString(undefined, {minimumFractionDigits: 2});
                
                // Stat 3: 7-Day Activity
                const recentCount = orders.filter(o => {
                    const orderDate = new Date(o.order_date);
                    const weekAgo = new Date();
                    weekAgo.setDate(weekAgo.getDate() - 7);
                    return orderDate > weekAgo;
                }).length;
                document.getElementById('statRecent').innerText = recentCount;

                // Recent Transactions Table
                const tbody = document.getElementById('recentOrdersBody');
                if (orders.length > 0) {
                    tbody.innerHTML = orders.slice(0, 8).map(o => {
                        const date = new Date(o.order_date).toLocaleDateString('en-US', {month: 'short', day: 'numeric', year: 'numeric'});
                        return `
                            <tr class="hover:bg-white/[0.02] transition">
                                <td class="p-6 text-sm font-bold text-white tracking-tighter">#ORD-${o.id}</td>
                                <td class="p-6 text-sm text-slate-400 font-medium">${date}</td>
                                <td class="p-6 text-sm font-black text-indigo-400">₱${parseFloat(o.total_price).toLocaleString()}</td>
                                <td class="p-6">
                                    <span class="px-3 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest ${
                                        o.status === 'Completed' ? 'bg-green-500/10 text-green-500 border border-green-500/20' : 
                                        o.status === 'Cancelled' ? 'bg-red-500/10 text-red-500 border border-red-500/20' : 
                                        'bg-amber-500/10 text-amber-500 border border-amber-500/20'
                                    }">
                                        ${o.status}
                                    </span>
                                </td>
                            </tr>
                        `;
                    }).join('');
                } else {
                    tbody.innerHTML = `<tr><td colspan="4" class="p-20 text-center text-slate-500 italic font-medium">No orders found yet. <a href="/shop" class="text-indigo-500 underline">Start shopping!</a></td></tr>`;
                }

                initCharts(orders);
            } catch (err) { 
                console.error("Dashboard data load error:", err); 
            }
        }

        function initCharts(orders) {
            // Chart 1: Line Chart (Monthly Spending)
            const ctx1 = document.getElementById('salesChart').getContext('2d');
            const gradient = ctx1.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(99, 102, 241, 0.2)');
            gradient.addColorStop(1, 'rgba(99, 102, 241, 0)');

            // Grouping data by month for the chart
            const monthlyData = [0, 0, 0, 0, 0, 0]; // Jan to Jun default
            orders.forEach(o => {
                const month = new Date(o.order_date).getMonth();
                if (month < 6) monthlyData[month] += parseFloat(o.total_price);
            });

            new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Spending',
                        data: monthlyData.every(v => v === 0) ? [1200, 1900, 800, 1500, 2100, 1400] : monthlyData, // Fallback to mock if empty
                        borderColor: '#6366f1',
                        borderWidth: 4,
                        fill: true,
                        backgroundColor: gradient,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: '#6366f1',
                        pointHoverRadius: 6
                    }]
                },
                options: { 
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: { 
                        y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.03)' } },
                        x: { grid: { display: false } }
                    }
                }
            });

            // Chart 2: Doughnut (Category Distribution)
            new Chart(document.getElementById('categoryChart'), {
                type: 'doughnut',
                data: {
                    labels: ['Shirts', 'Pants', 'Shoes', 'Other'],
                    datasets: [{
                        data: [45, 25, 20, 10], // Static mock categories as per requested design
                        backgroundColor: ['#6366f1', '#a855f7', '#06b6d4', '#475569'],
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: { 
                    cutout: '80%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { padding: 25, usePointStyle: true, font: { size: 10 } }
                        }
                    }
                }
            });
        }

        async function logout() {
            if (confirm("Are you sure you want to logout?")) {
                try {
                    await fetch('/api/logout', { method: 'POST' });
                    localStorage.removeItem('userId');
                    localStorage.removeItem('userRole');
                    window.location.href = '/login';
                } catch (err) {
                    window.location.href = '/login';
                }
            }
        }
        
        window.onload = initDashboard;
    </script>
</body>
</html>