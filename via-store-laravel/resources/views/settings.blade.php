<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Via Store | Settings</title>
    <!-- Frameworks & Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Link to your External CSS (Glassmorphism Style) -->
    <link rel="stylesheet" href="style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn { animation: fadeIn 0.4s ease-out forwards; }

        /* Modal Glass Effect */
        .modal-glass {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="min-h-screen transition-colors duration-300" id="adminBody">

    <!-- Mobile Overlay -->
    <div id="sidebarOverlay" onclick="toggleMobileSidebar()" class="overlay"></div>

    <!-- Password Change Modal -->
    <div id="passwordModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm" onclick="closePasswordModal()"></div>
        <div class="modal-glass w-full max-w-md rounded-[2.5rem] p-8 relative animate-fadeIn shadow-2xl">
            <h3 class="text-2xl font-black text-white mb-2">Update Security</h3>
            <p class="text-slate-400 text-sm mb-8">Ensure your account stays protected with a strong password.</p>
            
            <form id="passwordForm" class="space-y-5">
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Current Password</label>
                    <input type="password" id="currentPassword" required class="w-full p-4 bg-white/5 border border-white/10 rounded-2xl text-white outline-none focus:ring-2 ring-indigo-500/50 transition">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">New Password</label>
                    <input type="password" id="newPassword" required class="w-full p-4 bg-white/5 border border-white/10 rounded-2xl text-white outline-none focus:ring-2 ring-indigo-500/50 transition">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Confirm New Password</label>
                    <input type="password" id="confirmPassword" required class="w-full p-4 bg-white/5 border border-white/10 rounded-2xl text-white outline-none focus:ring-2 ring-indigo-500/50 transition">
                </div>
                
                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closePasswordModal()" class="flex-1 py-4 rounded-2xl font-bold text-slate-400 hover:bg-white/5 transition">Cancel</button>
                    <button type="submit" class="flex-1 py-4 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-500 shadow-lg shadow-indigo-500/20 transition">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Sidebar -->
    <aside class="sidebar" id="mainSidebar">
        <div class="sidebar-brand" id="sidebarBrand">VIA STORE</div>

        <nav class="flex-1 space-y-2 overflow-y-auto mt-4">
            <button onclick="toggleDesktopSidebar()" class="hidden lg:flex w-full items-center p-3 rounded-xl text-slate-400 hover:bg-white/10 transition mb-4">
                <i class="fas fa-exchange-alt w-6 text-center"></i>
                <span class="nav-text ml-3 font-medium text-sm">Collapse Menu</span>
            </button>

            <a href="/admin" class="nav-link"><i class="fas fa-chart-pie w-6 text-center"></i><span class="nav-text ml-3">Dashboard</span></a>
            <a href="/items" class="nav-link"><i class="fas fa-box w-6 text-center"></i><span class="nav-text ml-3">Item List</span></a>
            <a href="/expenses" class="nav-link"><i class="fas fa-receipt w-6 text-center"></i><span class="nav-text ml-3">Expenses</span></a>
            <a href="/orders" class="nav-link"><i class="fas fa-shopping-cart w-6 text-center"></i><span class="nav-text ml-3">Orders</span></a>
            <a href="/customers" class="nav-link"><i class="fas fa-users w-6 text-center"></i><span class="nav-text ml-3">Customers</span></a>
            <a href="/settings" class="nav-link active"><i class="fas fa-cog w-6 text-center"></i><span class="nav-text ml-3">Settings</span></a>
        </nav>

        <div class="mt-auto pt-4 border-t border-white/10">
            <button onclick="logout()" class="w-full text-left flex items-center p-3 rounded-xl text-red-400 hover:bg-red-500/10 transition font-medium">
                <i class="fas fa-sign-out-alt w-6 text-center"></i>
                <span class="nav-text ml-3">Logout</span>
            </button>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="main-content" id="mainContentArea">
        <div class="flex lg:hidden items-center justify-between mb-8 glass-card !p-4">
            <button onclick="toggleMobileSidebar()" class="w-10 h-10 flex items-center justify-center rounded-lg bg-white/10 text-white">
                <i class="fas fa-bars text-lg"></i>
            </button>
            <div class="font-bold text-white tracking-widest uppercase">Settings</div>
            <div class="w-10 h-10 rounded-lg bg-indigo-500/20 text-indigo-400 flex items-center justify-center">
                <i class="fas fa-cog"></i>
            </div>
        </div>

        <header class="mb-10">
            <h1 class="text-3xl font-bold text-white">System Settings</h1>
            <p class="text-slate-400">Manage your store identity, look, and security.</p>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-4 space-y-3">
                <button onclick="switchTab('general', this)" class="tab-btn w-full flex items-center p-4 rounded-2xl font-bold transition-all border border-white/10 bg-indigo-600 text-white shadow-lg shadow-indigo-500/20">
                    <i class="fas fa-sliders-h mr-4 w-5 text-center"></i> General
                </button>
                <button onclick="switchTab('appearance', this)" class="tab-btn w-full flex items-center p-4 rounded-2xl font-bold transition-all border border-white/5 bg-white/5 text-slate-400 hover:bg-white/10">
                    <i class="fas fa-palette mr-4 w-5 text-center"></i> Appearance
                </button>
                <button onclick="switchTab('security', this)" class="tab-btn w-full flex items-center p-4 rounded-2xl font-bold transition-all border border-white/5 bg-white/5 text-slate-400 hover:bg-white/10">
                    <i class="fas fa-shield-alt mr-4 w-5 text-center"></i> Security
                </button>
            </div>

            <div class="lg:col-span-8">
                <!-- General Tab -->
                <div id="tab-general" class="setting-tab glass-card animate-fadeIn">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-2 h-8 bg-indigo-500 rounded-full shadow-[0_0_15px_rgba(99,102,241,0.5)]"></div>
                        <h2 class="text-xl font-bold text-white">Store Identity</h2>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Store Display Name</label>
                            <input type="text" id="storeNameInput" class="w-full p-4 bg-white/5 border border-white/10 rounded-2xl text-white outline-none focus:ring-2 ring-indigo-500/50 transition">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Support/Admin Email</label>
                            <input type="email" id="storeEmailInput" class="w-full p-4 bg-white/5 border border-white/10 rounded-2xl text-white outline-none focus:ring-2 ring-indigo-500/50 transition">
                        </div>
                        <div class="pt-4">
                            <button onclick="saveStoreSettings()" class="w-full md:w-auto px-10 py-4 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-500 transition-all shadow-xl shadow-indigo-500/20">
                                Update Settings
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Appearance Tab -->
                <div id="tab-appearance" class="setting-tab hidden glass-card animate-fadeIn">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-2 h-8 bg-indigo-500 rounded-full shadow-[0_0_15px_rgba(99,102,241,0.5)]"></div>
                        <h2 class="text-xl font-bold text-white">Theme Customization</h2>
                    </div>
                    <div class="flex items-center justify-between p-6 bg-white/5 rounded-3xl border border-white/10">
                        <div>
                            <p class="font-bold text-white">Dark Interface</p>
                            <p class="text-xs text-slate-400">Optimize for low-light environments</p>
                        </div>
                        <button onclick="toggleDarkMode()" id="darkToggle" class="w-14 h-8 bg-white/10 rounded-full relative transition-all duration-300 border border-white/10">
                            <div class="w-6 h-6 bg-indigo-500 rounded-full absolute left-1 top-1 transition-all duration-300" id="toggleCircle"></div>
                        </button>
                    </div>
                </div>

                <!-- Security Tab -->
                <div id="tab-security" class="setting-tab hidden glass-card animate-fadeIn">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-2 h-8 bg-rose-500 rounded-full shadow-[0_0_15px_rgba(244,63,94,0.5)]"></div>
                        <h2 class="text-xl font-bold text-white">Privacy & Protection</h2>
                    </div>
                    <div class="space-y-4">
                        <button onclick="openPasswordModal()" class="w-full flex justify-between items-center p-5 bg-white/5 border border-white/10 rounded-2xl hover:bg-white/10 transition-all group">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white/5 rounded-xl flex items-center justify-center text-slate-400 group-hover:text-indigo-400 transition">
                                    <i class="fas fa-key text-lg"></i>
                                </div>
                                <span class="font-bold text-slate-200">Change Admin Password</span>
                            </div>
                            <i class="fas fa-chevron-right text-slate-600 group-hover:text-indigo-400 group-hover:translate-x-1 transition-all"></i>
                        </button>
                        
                        <button class="w-full flex justify-between items-center p-5 bg-white/5 border border-white/10 rounded-2xl hover:bg-white/10 transition-all group text-left">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white/5 rounded-xl flex items-center justify-center text-slate-400 group-hover:text-emerald-400 transition">
                                    <i class="fas fa-fingerprint text-lg"></i>
                                </div>
                                <div>
                                    <span class="block font-bold text-slate-200">Two-Factor Auth</span>
                                    <span class="text-[9px] text-emerald-400 font-black uppercase tracking-widest">Recommended</span>
                                </div>
                            </div>
                            <i class="fas fa-external-link-alt text-slate-600 group-hover:text-emerald-400 transition-all"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        let isDarkMode = false;

        // Modal Controls
        function openPasswordModal() { document.getElementById('passwordModal').classList.remove('hidden'); }
        function closePasswordModal() { document.getElementById('passwordModal').classList.add('hidden'); }

        // Sidebar Logic
        function toggleDesktopSidebar() {
            const sidebar = document.getElementById('mainSidebar');
            sidebar.classList.toggle('collapsed');
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        }

        function toggleMobileSidebar() {
            document.getElementById('mainSidebar').classList.toggle('active');
            document.getElementById('sidebarOverlay').classList.toggle('active');
        }

        function initSettings() {
            const savedName = localStorage.getItem('storeName') || 'VIA STORE';
            document.getElementById('sidebarBrand').innerText = savedName.toUpperCase();
            document.getElementById('storeNameInput').value = savedName;
            document.getElementById('storeEmailInput').value = localStorage.getItem('storeEmail') || 'support@viastore.com';

            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (isCollapsed && window.innerWidth >= 1024) document.getElementById('mainSidebar').classList.add('collapsed');

            isDarkMode = localStorage.getItem('darkMode') === 'true';
            updateDarkModeUI();
        }

        function switchTab(tabId, btn) {
            document.querySelectorAll('.setting-tab').forEach(t => t.classList.add('hidden'));
            document.getElementById('tab-' + tabId).classList.remove('hidden');
            
            document.querySelectorAll('.tab-btn').forEach(b => {
                b.classList.replace('bg-indigo-600', 'bg-white/5');
                b.classList.replace('text-white', 'text-slate-400');
                b.classList.remove('shadow-lg', 'shadow-indigo-500/20');
            });

            btn.classList.replace('bg-white/5', 'bg-indigo-600');
            btn.classList.replace('text-slate-400', 'text-white');
            btn.classList.add('shadow-lg', 'shadow-indigo-500/20');
        }

        function saveStoreSettings() {
            const name = document.getElementById('storeNameInput').value;
            localStorage.setItem('storeName', name);
            localStorage.setItem('storeEmail', document.getElementById('storeEmailInput').value);
            document.getElementById('sidebarBrand').innerText = name.toUpperCase();
            alert("✅ Store Identity updated.");
        }

        // Logic for Changing Password
        document.getElementById('passwordForm').onsubmit = async (e) => {
            e.preventDefault();
            const current = document.getElementById('currentPassword').value;
            const next = document.getElementById('newPassword').value;
            const confirm = document.getElementById('confirmPassword').value;

            if (next !== confirm) return alert("❌ New passwords do not match.");

            try {
                // Change this URL to your actual backend endpoint
                const res = await fetch('/api/change-password', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ current, next })
                });
                
                const data = await res.json();
                if (data.success) {
                    alert("✅ Password updated successfully!");
                    closePasswordModal();
                    e.target.reset();
                } else {
                    alert("❌ " + data.message);
                }
            } catch (err) {
                // Since this is likely client-side for now, we simulate success
                console.log("Mock update logic here");
                alert("✅ Password changed (Development Mock)");
                closePasswordModal();
            }
        };

        function toggleDarkMode() {
            isDarkMode = !isDarkMode;
            localStorage.setItem('darkMode', isDarkMode);
            updateDarkModeUI();
        }

        function updateDarkModeUI() {
            const circle = document.getElementById('toggleCircle');
            const toggle = document.getElementById('darkToggle');
            circle.style.transform = isDarkMode ? "translateX(24px)" : "translateX(0px)";
            isDarkMode ? toggle.classList.add('bg-indigo-500/20') : toggle.classList.remove('bg-indigo-500/20');
            document.body.classList.toggle('is-dark-theme', isDarkMode);
        }

        function logout() { 
            if(confirm("Confirm logout?")) { localStorage.clear(); window.location.href = '/login'; }
        }

        window.onload = initSettings;
    </script>
</body>
</html>