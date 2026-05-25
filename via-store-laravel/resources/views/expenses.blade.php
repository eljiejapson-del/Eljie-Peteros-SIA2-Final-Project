<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Via Store | Expense Tracking</title>
    <!-- Frameworks & Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- PDF Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
    
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
            <a href="/expenses" class="nav-link active">
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
            <div class="font-bold text-white tracking-widest uppercase">Expenses</div>
            <button onclick="openExpModal()" class="w-10 h-10 rounded-lg bg-indigo-500/20 text-indigo-400 flex items-center justify-center">
                <i class="fas fa-plus"></i>
            </button>
        </div>

        <header class="flex flex-col md:flex-row md:justify-between md:items-center mb-10 gap-6">
            <div>
                <h1 class="text-3xl font-bold text-white">Expense Tracking</h1>
                <p class="text-slate-400">Manage and monitor store spending.</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <div class="glass-card !px-6 !py-3 border-rose-500/30 flex flex-col items-center md:items-end">
                    <p class="text-[10px] text-slate-500 uppercase font-black tracking-widest mb-1">Monthly Total</p>
                    <h2 id="totalExpenseVal" class="text-2xl font-black text-rose-400">₱0.00</h2>
                </div>
                <button onclick="printExpensesPDF()" class="glass-card !p-4 hover:bg-white/10 transition text-slate-300">
                    <i class="fas fa-file-pdf mr-2"></i> Report
                </button>
                <button class="flex items-center bg-indigo-600 text-white px-6 py-4 rounded-2xl font-bold hover:bg-indigo-500 transition shadow-lg shadow-indigo-900/20" onclick="openExpModal()">
                    <i class="fas fa-plus mr-2"></i> Record Expense
                </button>
            </div>
        </header>

        <!-- Expenses Table Container -->
        <div class="glass-card !p-0 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-white/5 border-b border-white/10">
                        <tr>
                            <th class="p-5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">ID</th>
                            <th class="p-5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Description</th>
                            <th class="p-5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Amount</th>
                            <th class="p-5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Category</th>
                            <th class="p-5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Date Added</th>
                            <th class="p-5 text-center text-xs font-bold text-slate-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="expenseTableBody" class="text-slate-300">
                        <!-- Content loaded by JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Expense Modal -->
    <div id="expModal" class="hidden fixed inset-0 z-[2000] flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-md">
        <div class="glass-card w-full max-w-md shadow-2xl border-indigo-500/20">
            <div class="flex justify-between items-center mb-6">
                <h2 id="modalTitle" class="text-2xl font-bold text-white">Add New Expense</h2>
                <button onclick="closeExpModal()" class="text-slate-400 hover:text-white"><i class="fas fa-times text-xl"></i></button>
            </div>
            <form id="expForm" class="space-y-5">
                <input type="hidden" id="editId">
                <div>
                    <label class="text-[10px] font-extrabold text-slate-500 ml-1 mb-2 block uppercase tracking-tighter">Description</label>
                    <input type="text" id="eDesc" placeholder="e.g. Electricity Bill" class="w-full p-4 border border-white/10 rounded-2xl bg-white/5 text-white outline-none focus:ring-2 ring-indigo-500/50 transition-all" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-[10px] font-extrabold text-slate-500 ml-1 mb-2 block uppercase tracking-tighter">Amount (₱)</label>
                        <input type="number" id="eAmount" placeholder="0.00" step="0.01" class="w-full p-4 border border-white/10 rounded-2xl bg-white/5 text-white outline-none focus:ring-2 ring-indigo-500/50 transition-all" required>
                    </div>
                    <div>
                        <label class="text-[10px] font-extrabold text-slate-500 ml-1 mb-2 block uppercase tracking-tighter">Category</label>
                        <select id="eCat" class="w-full p-4 border border-white/10 rounded-2xl bg-slate-900 text-white outline-none focus:ring-2 ring-indigo-500/50 transition-all appearance-none">
                            <option value="Supplies">Supplies</option>
                            <option value="Utilities">Utilities</option>
                            <option value="Rent">Rent</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="button" class="flex-1 p-4 bg-white/10 rounded-2xl font-bold text-slate-300 hover:bg-white/20 transition" onclick="closeExpModal()">Cancel</button>
                    <button type="submit" class="flex-1 p-4 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-500 shadow-lg shadow-indigo-900/20 transition">Save Record</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let allExpenses = [];

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
        async function fetchExpenses() {
            const tbody = document.getElementById('expenseTableBody');
            tbody.innerHTML = `<tr><td colspan="6" class="p-10 text-center"><div class="animate-pulse text-slate-500">Loading expenses...</div></td></tr>`;
            
            try {
                const res = await fetch('/api/expenses');
                if (res.status === 401 || res.status === 403) {
                    window.location.href = '/index';
                    return;
                }
                if (!res.ok) throw new Error('Database fetch failed');
                
                allExpenses = await res.json();
                renderTable();
            } catch (err) {
                console.error("API Error:", err.message);
                tbody.innerHTML = `<tr><td colspan="6" class="p-10 text-center text-rose-400 font-bold">Error connecting to database.</td></tr>`;
            }
        }

        function renderTable() {
            let total = 0;
            const tbody = document.getElementById('expenseTableBody');
            
            if (allExpenses.length === 0) {
                tbody.innerHTML = `<tr><td colspan="6" class="p-20 text-center text-slate-500 font-bold uppercase tracking-widest">No records found</td></tr>`;
                document.getElementById('totalExpenseVal').innerText = '₱0.00';
                return;
            }

            tbody.innerHTML = allExpenses.map(exp => {
                const amount = parseFloat(exp.amount) || 0;
                total += amount;
                const date = new Date(exp.date_added).toLocaleDateString('en-PH', {
                    month: 'short', day: 'numeric', year: 'numeric'
                });

                return `
                    <tr class="border-b border-white/5 hover:bg-white/5 transition-colors group">
                        <td class="p-5 font-mono text-slate-500 text-sm">#${exp.id}</td>
                        <td class="p-5 font-bold text-white">${exp.description}</td>
                        <td class="p-5 font-black text-rose-400 text-lg">₱${amount.toLocaleString(undefined, {minimumFractionDigits: 2})}</td>
                        <td class="p-5">
                            <span class="bg-indigo-500/10 text-indigo-400 px-3 py-1.5 rounded-lg text-[10px] font-extrabold uppercase tracking-widest border border-indigo-500/20">
                                ${exp.category}
                            </span>
                        </td>
                        <td class="p-5 text-slate-400 text-sm font-medium">${date}</td>
                        <td class="p-5 text-center">
                            <div class="flex justify-center gap-3">
                                <button onclick="editExp(${exp.id})" class="w-9 h-9 flex items-center justify-center rounded-xl bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-white transition-all">
                                    <i class="fas fa-edit text-xs"></i>
                                </button>
                                <button onclick="deleteExp(${exp.id})" class="w-9 h-9 flex items-center justify-center rounded-xl bg-rose-500/10 text-rose-400 hover:bg-rose-500 hover:text-white transition-all">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </button>
                            </div>
                        </td>
                    </tr>`;
            }).join('');

            document.getElementById('totalExpenseVal').innerText = '₱' + total.toLocaleString(undefined, {
                minimumFractionDigits: 2, maximumFractionDigits: 2
            });
        }

        // CRUD ACTIONS
        document.getElementById('expForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const id = document.getElementById('editId').value;
            const expenseData = {
                description: document.getElementById('eDesc').value,
                amount: document.getElementById('eAmount').value,
                category: document.getElementById('eCat').value
            };

            try {
                let res;
                if (id) {
                    res = await fetch(`/api/expenses/${id}`, {
                        method: 'PUT',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(expenseData)
                    });
                } else {
                    res = await fetch('/api/expenses', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(expenseData)
                    });
                }

                if (res.ok) {
                    closeExpModal();
                    fetchExpenses();
                } else {
                    alert("Failed to save to database");
                }
            } catch (err) {
                alert("Network error.");
            }
        });

        async function deleteExp(id) {
            if (confirm("Permanently delete this record?")) {
                try {
                    const res = await fetch(`/api/expenses/${id}`, { method: 'DELETE' });
                    if (res.ok) fetchExpenses();
                } catch (err) { console.error(err); }
            }
        }

        // PDF GENERATION
        function printExpensesPDF() {
            const { jsPDF } = window.jspdf;
            const doc = jsPDF();
            const storeName = localStorage.getItem('storeName') || 'VIA STORE';
            
            doc.setFontSize(22);
            doc.setTextColor(79, 70, 229);
            doc.text(storeName.toUpperCase(), 14, 20);
            
            doc.setFontSize(12);
            doc.setTextColor(100);
            doc.text("Official Expense Report", 14, 28);

            const rows = allExpenses.map(exp => [
                `#${exp.id}`,
                exp.description,
                `PHP ${parseFloat(exp.amount).toFixed(2)}`,
                exp.category,
                new Date(exp.date_added).toLocaleDateString()
            ]);

            doc.autoTable({
                startY: 45,
                head: [['ID', 'Description', 'Amount', 'Category', 'Date']],
                body: rows,
                theme: 'striped',
                headStyles: { fillColor: [79, 70, 229] }
            });

            doc.save(`Expense_Report.pdf`);
        }

        // MODAL LOGIC
        function editExp(id) {
            const exp = allExpenses.find(e => e.id === id);
            if (!exp) return;
            document.getElementById('editId').value = exp.id;
            document.getElementById('eDesc').value = exp.description;
            document.getElementById('eAmount').value = exp.amount;
            document.getElementById('eCat').value = exp.category;
            document.getElementById('modalTitle').innerText = "Update Record";
            openExpModal();
        }

        function openExpModal() { 
            document.getElementById('expModal').classList.remove('hidden'); 
        }

        function closeExpModal() { 
            document.getElementById('expModal').classList.add('hidden'); 
            document.getElementById('expForm').reset();
            document.getElementById('editId').value = "";
            document.getElementById('modalTitle').innerText = "Add New Expense";
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
            fetchExpenses();
        };
    </script>
</body>
</html>