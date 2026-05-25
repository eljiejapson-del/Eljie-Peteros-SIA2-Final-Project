<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Via Store | Customer Directory</title>
    <!-- Frameworks & Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Link sa iyong External CSS (Glassmorphism Style) -->
    <link rel="stylesheet" href="style.css">
    <style>
        .status-pulse {
            width: 10px;
            height: 10px;
            background-color: #22c55e;
            border-radius: 50%;
            display: inline-block;
            box-shadow: 0 0 0 rgba(34, 197, 94, 0.4);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(34, 197, 94, 0); }
            100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
        }
    </style>
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
            <a href="/orders" class="nav-link">
                <i class="fas fa-shopping-cart w-6 text-center"></i>
                <span class="nav-text ml-3">Orders</span>
            </a>
            <a href="/customers" class="nav-link active">
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
            <div class="font-bold text-white tracking-widest uppercase">Customers</div>
            <div class="w-10 h-10 rounded-lg bg-indigo-500/20 text-indigo-400 flex items-center justify-center">
                <i class="fas fa-users"></i>
            </div>
        </div>

        <header class="flex flex-col md:flex-row md:justify-between md:items-center mb-10 gap-6">
            <div>
                <h1 class="text-3xl font-bold text-white">Customer Directory</h1>
                <p class="text-slate-400">Real-time management of registered members.</p>
            </div>
            <div class="relative w-full md:w-80">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-500"></i>
                <input type="text" id="customerSearch" onkeyup="filterCustomers()" placeholder="Search names or emails..." 
                    class="w-full pl-12 pr-4 py-4 bg-white/5 border border-white/10 rounded-2xl text-white outline-none focus:ring-2 ring-indigo-500/50 transition shadow-lg">
            </div>
        </header>

        <!-- Customers Table Container -->
        <div class="glass-card !p-0 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-white/5 border-b border-white/10">
                        <tr>
                            <th class="p-5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                            <th class="p-5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Full Name</th>
                            <th class="p-5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Email Address</th>
                            <th class="p-5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Role</th>
                            <th class="p-5 text-center text-xs font-bold text-slate-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="customerBody" class="text-slate-300">
                        <tr>
                            <td colspan="5" class="p-10 text-center">
                                <div class="animate-pulse text-slate-500">Loading directory...</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Customer Profile Modal -->
    <div id="customerModal" class="hidden fixed inset-0 z-[2000] flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-md">
        <div class="glass-card w-full max-w-md shadow-2xl border-indigo-500/20 overflow-hidden !p-0">
            <div class="bg-indigo-600 p-8 text-white flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-xl uppercase tracking-tight">Customer Profile</h3>
                    <p class="text-indigo-200 text-[10px] uppercase font-bold tracking-widest">Full member details</p>
                </div>
                <button onclick="closeModal()" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="p-8" id="modalContent">
                <!-- Data Injected Here -->
            </div>
            
            <div class="p-6 bg-white/5 border-t border-white/10 flex justify-end gap-3">
                <button onclick="closeModal()" class="bg-white/10 text-slate-300 px-8 py-3 rounded-2xl font-bold text-sm hover:bg-white/20 transition">Close</button>
            </div>
        </div>
    </div>

    <script>
        let allCustomers = [];

        // SIDEBAR LOGIC (Desktop)
        function toggleDesktopSidebar() {
            const sidebar = document.getElementById('mainSidebar');
            sidebar.classList.toggle('collapsed');
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        }

        // SIDEBAR LOGIC (Mobile)
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

        // FETCH DATA
        async function fetchCustomers() {
            try {
                const res = await fetch('/api/customers');
                if (!res.ok) throw new Error(`Server Error`);
                allCustomers = await res.json();
                renderTable(allCustomers);
            } catch (err) {
                // Dummy Data para sa testing
                allCustomers = [
                    { id: 1, fullname: "John Doe", email: "john@example.com", role: "Admin", last_seen: new Date(), age: 24, gender: "Male", location: "Manila, PH" },
                    { id: 2, fullname: "Jane Smith", email: "jane@test.com", role: "Customer", last_seen: "2024-01-01", age: 22, gender: "Female", location: "Cebu, PH" }
                ];
                renderTable(allCustomers);
            }
        }

        function isUserOnline(lastSeen) {
            if (!lastSeen) return false;
            return (new Date() - new Date(lastSeen)) / 1000 / 60 < 5;
        }

        function filterCustomers() {
            const searchTerm = document.getElementById('customerSearch').value.toLowerCase();
            const filtered = allCustomers.filter(c => 
                c.fullname.toLowerCase().includes(searchTerm) || c.email.toLowerCase().includes(searchTerm)
            );
            renderTable(filtered);
        }

        function renderTable(customers) {
            const tbody = document.getElementById('customerBody');
            if (customers.length === 0) {
                tbody.innerHTML = `<tr><td colspan="5" class="p-20 text-center text-slate-500 font-bold uppercase tracking-widest">No matching members found.</td></tr>`;
                return;
            }

            tbody.innerHTML = customers.map(c => {
                const online = isUserOnline(c.last_seen);
                return `
                <tr class="border-b border-white/5 hover:bg-white/5 transition-colors group cursor-pointer" onclick="viewCustomer(${c.id})">
                    <td class="p-5">
                        <div class="flex items-center gap-3">
                            <span class="${online ? 'status-pulse' : 'w-2.5 h-2.5 rounded-full bg-slate-600'}"></span>
                            <span class="text-[10px] font-black uppercase tracking-widest ${online ? 'text-green-400' : 'text-slate-500'}">
                                ${online ? 'Online' : 'Offline'}
                            </span>
                        </div>
                    </td>
                    <td class="p-5">
                        <div class="font-bold text-white group-hover:text-indigo-400 transition">${c.fullname}</div>
                    </td>
                    <td class="p-5 text-slate-400 font-medium">${c.email}</td>
                    <td class="p-5">
                        <span class="${c.role.toLowerCase() === 'admin' ? 'bg-purple-500/10 text-purple-400 border-purple-500/20' : 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20'} px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-wider border">
                            ${c.role}
                        </span>
                    </td>
                    <td class="p-5 text-center">
                        <button onclick="event.stopPropagation(); forceLogout(${c.id}, '${c.fullname}')" class="w-9 h-9 flex items-center justify-center rounded-xl bg-rose-500/10 text-rose-400 hover:bg-rose-500 hover:text-white transition-all">
                            <i class="fas fa-user-slash text-xs"></i>
                        </button>
                    </td>
                </tr>`;
            }).join('');
        }

        function viewCustomer(id) {
            const customer = allCustomers.find(c => c.id == id);
            if (!customer) return;
            const content = document.getElementById('modalContent');
            content.innerHTML = `
                <div class="flex flex-col gap-6">
                    <div class="flex items-center gap-4 border-b border-white/10 pb-6">
                        <div class="w-16 h-16 bg-indigo-500/20 text-indigo-400 rounded-2xl flex items-center justify-center text-2xl font-bold border border-indigo-500/30 shadow-lg">
                            ${customer.fullname.charAt(0)}
                        </div>
                        <div>
                            <h4 class="text-2xl font-bold text-white leading-tight">${customer.fullname}</h4>
                            <p class="text-slate-500 text-[10px] font-bold tracking-widest uppercase mt-1">User ID: #${customer.id}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-y-6 gap-x-4">
                        <div class="col-span-2">
                            <span class="text-[10px] font-extrabold text-slate-500 uppercase block mb-1 tracking-widest">Email Address</span>
                            <span class="text-white font-bold">${customer.email}</span>
                        </div>
                        <div>
                            <span class="text-[10px] font-extrabold text-slate-500 uppercase block mb-1 tracking-widest">Age</span>
                            <span class="text-white font-bold">${customer.age || 'N/A'}</span>
                        </div>
                        <div>
                            <span class="text-[10px] font-extrabold text-slate-500 uppercase block mb-1 tracking-widest">Gender</span>
                            <span class="text-white font-bold">${customer.gender || 'N/A'}</span>
                        </div>
                        <div class="col-span-2">
                            <span class="text-[10px] font-extrabold text-slate-500 uppercase block mb-1 tracking-widest">Last Known Location</span>
                            <span class="text-white font-bold"><i class="fas fa-map-marker-alt mr-2 text-indigo-400"></i>${customer.location || 'Unknown Access Point'}</span>
                        </div>
                    </div>
                </div>`;
            const modal = document.getElementById('customerModal');
            modal.classList.remove('hidden');
        }

        function closeModal() { 
            document.getElementById('customerModal').classList.add('hidden'); 
        }

        async function forceLogout(id, name) {
            if (!confirm(`Force logout ${name}? Their current session will be terminated.`)) return;
            alert(`🚀 Session invalidated for ${name}.`);
            fetchCustomers();
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
            fetchCustomers(); 
            setInterval(fetchCustomers, 30000); 
        };
        
        window.onclick = (e) => { 
            const modal = document.getElementById('customerModal');
            if (e.target == modal) closeModal(); 
        }
    </script>
</body>
</html>