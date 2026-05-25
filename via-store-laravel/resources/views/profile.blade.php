<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Via Store | My Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

        .nav-link.active {
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.1) 0%, rgba(99, 102, 241, 0) 100%);
            color: #818cf8;
            border-left: 3px solid #6366f1;
        }

        .status-completed { background: rgba(34, 197, 94, 0.1); color: #4ade80; }
        .status-pending { background: rgba(234, 179, 8, 0.1); color: #facc15; }
        .status-shipped { background: rgba(59, 130, 246, 0.1); color: #60a5fa; }

        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }

        .modal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 100;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(8px);
            align-items: center;
            justify-content: center;
        }
        .modal.active { display: flex; }
        
        input {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: white !important;
        }
    </style>
</head>
<body class="min-h-screen flex">

    <!-- SIDEBAR -->
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
            <a href="/dashboard" class="nav-link flex items-center gap-4 px-6 py-4 rounded-xl text-slate-400 font-semibold hover:text-white transition-all">
                <i class="fas fa-th-large w-5"></i> Dashboard
            </a>
            <a href="/shop" class="nav-link flex items-center gap-4 px-6 py-4 rounded-xl text-slate-400 font-semibold hover:text-white transition-all">
                <i class="fas fa-shopping-bag w-5"></i> Shop
            </a>
            <a href="/profile" class="nav-link active flex items-center gap-4 px-6 py-4 rounded-xl text-slate-400 font-semibold hover:text-white transition-all">
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
        <header class="mb-10">
            <div class="inline-block px-4 py-1.5 rounded-full bg-indigo-500/10 text-[10px] font-black text-indigo-400 uppercase tracking-[0.3em] mb-4 border border-indigo-500/20">
                Member Center
            </div>
            <h2 class="text-4xl font-black text-white tracking-tight uppercase">My Profile</h2>
            <p class="text-slate-500 font-medium mt-1">Manage your identity and purchase security.</p>
        </header>

        <div class="max-w-5xl space-y-8">
            <!-- PROFILE HERO -->
            <div class="glass-card rounded-[2.5rem] p-12 relative overflow-hidden">
                <div class="relative z-10 flex flex-col items-center text-center">
                    <div class="relative mb-6">
                        <div class="w-32 h-32 bg-indigo-600 rounded-full flex items-center justify-center text-5xl font-black shadow-2xl shadow-indigo-500/30 border-4 border-white/10">
                            <span id="nameInitial">U</span>
                        </div>
                        <div class="absolute bottom-1 right-1 w-8 h-8 bg-green-500 border-4 border-[#0f172a] rounded-full"></div>
                    </div>
                    
                    <h2 id="displayUserName" class="text-4xl font-black text-white italic tracking-tight">User Name</h2>
                    <p id="displayEmailHead" class="text-indigo-400 font-bold text-sm mt-2 tracking-[0.1em]">email@example.com</p>
                    
                    <div class="flex gap-4 mt-8">
                        <button onclick="openModal('editProfileModal')" class="bg-indigo-600 hover:bg-indigo-500 text-white px-8 py-3.5 rounded-2xl text-[10px] font-black uppercase tracking-widest transition shadow-xl shadow-indigo-600/20 active:scale-95 flex items-center gap-3">
                            <i class="fas fa-pen-nib"></i> Update Profile
                        </button>
                        <button class="bg-white/5 hover:bg-white/10 text-white px-8 py-3.5 rounded-2xl text-[10px] font-black uppercase tracking-widest transition border border-white/10 active:scale-95">
                            Account Privacy
                        </button>
                    </div>
                </div>
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-indigo-600/10 blur-[100px] rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-8">
                    <div class="glass-card rounded-[2rem] p-8">
                        <h3 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-8 flex items-center gap-2">
                            <i class="fas fa-id-card text-indigo-400"></i> Identity Information
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-10 gap-x-8">
                            <div class="flex items-center gap-5">
                                <div class="w-12 h-12 bg-indigo-500/10 rounded-2xl flex items-center justify-center text-indigo-400 border border-indigo-500/20">
                                    <i class="far fa-envelope text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Email Address</p>
                                    <p id="infoEmail" class="font-bold text-white">Not Set</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-5">
                                <div class="w-12 h-12 bg-green-500/10 rounded-2xl flex items-center justify-center text-green-400 border border-green-500/20">
                                    <i class="fas fa-phone-alt text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Contact Number</p>
                                    <p id="infoPhone" class="font-bold text-white">Not Set</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-5 md:col-span-2">
                                <div class="w-12 h-12 bg-orange-500/10 rounded-2xl flex items-center justify-center text-orange-400 border border-orange-500/20">
                                    <i class="fas fa-map-marker-alt text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Primary Address</p>
                                    <p id="infoLocation" class="font-bold text-white">Not Set</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FIXED TRANSACTION LOG -->
                    <div class="glass-card rounded-[2rem] overflow-hidden">
                        <div class="p-8 border-b border-white/5 flex justify-between items-center bg-white/2">
                            <h3 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">Transaction Log</h3>
                            <span class="text-[9px] bg-indigo-500/10 px-3 py-1 rounded-lg font-black text-indigo-400 uppercase">Recent Orders</span>
                        </div>
                        <div class="p-8 space-y-4" id="historyList">
                            <div class="flex justify-center py-10">
                                <i class="fas fa-circle-notch fa-spin text-indigo-500 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="glass-card rounded-[2rem] p-8">
                        <h3 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-6">Security & Auth</h3>
                        <div class="space-y-3">
                            <button onclick="openModal('passwordModal')" class="w-full flex items-center justify-between px-6 py-4 bg-white/5 hover:bg-white/10 rounded-2xl font-bold text-white transition text-xs border border-white/5">
                                Change Password <i class="fas fa-shield-alt opacity-30"></i>
                            </button>
                            <div class="pt-4 mt-4 border-t border-white/5">
                                <button onclick="logout()" class="w-full flex items-center justify-center gap-3 px-6 py-4 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white rounded-2xl font-black transition-all text-[10px] uppercase tracking-[0.2em]">
                                    <i class="fas fa-power-off"></i> Terminate Session
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- MODALS -->
    <div id="editProfileModal" class="modal px-4">
        <div class="glass-card max-w-lg w-full rounded-[2.5rem] p-10">
            <h3 class="text-2xl font-black text-white italic mb-6">Edit Identity</h3>
            <div class="space-y-4">
                <div>
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-2 ml-1">Full Name</label>
                    <input type="text" id="editName" class="w-full px-6 py-4 rounded-2xl outline-none focus:border-indigo-500 transition">
                </div>
                <div>
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-2 ml-1">Phone Number</label>
                    <input type="text" id="editPhone" class="w-full px-6 py-4 rounded-2xl outline-none focus:border-indigo-500 transition">
                </div>
                <div>
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-2 ml-1">Address</label>
                    <input type="text" id="editLocation" class="w-full px-6 py-4 rounded-2xl outline-none focus:border-indigo-500 transition">
                </div>
            </div>
            <div class="flex gap-4 mt-8">
                <button onclick="saveProfile()" class="flex-1 bg-indigo-600 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-indigo-500 transition">Save Changes</button>
                <button onclick="closeModal('editProfileModal')" class="px-8 bg-white/5 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-white/10 hover:bg-white/10 transition">Cancel</button>
            </div>
        </div>
    </div>

    <div id="passwordModal" class="modal px-4">
        <div class="glass-card max-w-md w-full rounded-[2.5rem] p-10">
            <h3 class="text-2xl font-black text-white italic mb-6">Security Update</h3>
            <div class="space-y-4">
                <div>
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-2 ml-1">New Password</label>
                    <input type="password" id="newPass" class="w-full px-6 py-4 rounded-2xl outline-none focus:border-indigo-500 transition">
                </div>
                <div>
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-2 ml-1">Confirm Password</label>
                    <input type="password" id="confirmPass" class="w-full px-6 py-4 rounded-2xl outline-none focus:border-indigo-500 transition">
                </div>
            </div>
            <div class="flex gap-4 mt-8">
                <button onclick="savePassword()" class="flex-1 bg-indigo-600 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-indigo-500 transition">Update Password</button>
                <button onclick="closeModal('passwordModal')" class="px-8 bg-white/5 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-white/10 hover:bg-white/10 transition">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        function initProfile() {
            const userName = localStorage.getItem('userName');
            if (!userName) {
                window.location.href = '/login';
                return;
            }
            const savedStoreName = localStorage.getItem('storeName') || 'VIA';
            document.getElementById('storeBrand').innerText = savedStoreName.toUpperCase();
            updateUI();
        }

        function updateUI() {
            const name = localStorage.getItem('userName') || 'Via Member';
            const email = localStorage.getItem('userEmail') || 'member@viastore.com';
            
            document.getElementById('displayUserName').innerText = name;
            document.getElementById('displayEmailHead').innerText = email;
            document.getElementById('nameInitial').innerText = name.charAt(0).toUpperCase();
            document.getElementById('infoEmail').innerText = email;
            document.getElementById('infoPhone').innerText = localStorage.getItem('userPhone') || 'Not Set';
            document.getElementById('infoLocation').innerText = localStorage.getItem('userLocation') || 'Not Set';
        }

        function openModal(id) {
            document.getElementById(id).classList.add('active');
            if(id === 'editProfileModal') {
                document.getElementById('editName').value = localStorage.getItem('userName') || '';
                document.getElementById('editPhone').value = localStorage.getItem('userPhone') || '';
                document.getElementById('editLocation').value = localStorage.getItem('userLocation') || '';
            }
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        async function saveProfile() {
            const newName = document.getElementById('editName').value;
            const newPhone = document.getElementById('editPhone').value;
            const newLoc = document.getElementById('editLocation').value;

            try {
                const response = await fetch('/api/user/update', {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ name: newName, phone: newPhone, location: newLoc })
                });

                if (response.ok) {
                    localStorage.setItem('userName', newName);
                    localStorage.setItem('userPhone', newPhone);
                    localStorage.setItem('userLocation', newLoc);
                    updateUI();
                    closeModal('editProfileModal');
                    alert("Profile updated successfully!");
                }
            } catch (err) {
                alert("Error updating profile.");
            }
        }

        async function savePassword() {
            const p1 = document.getElementById('newPass').value;
            const p2 = document.getElementById('confirmPass').value;
            if (p1 !== p2) { alert("Passwords do not match!"); return; }
            
            try {
                const response = await fetch('/api/change-password', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ next: p1 })
                });
                if (response.ok) {
                    alert("Password updated securely!");
                    closeModal('passwordModal');
                }
            } catch (err) { alert("Failed to update password."); }
        }

        // --- FIXED TRANSACTION LOG LOGIC ---
        async function loadHistory() {
            const list = document.getElementById('historyList');
            try {
                // Change endpoint to /api/my-orders which is user-specific
                const res = await fetch('/api/my-orders'); 
                const orders = await res.json();

                if (!orders || orders.length === 0) {
                    list.innerHTML = `<div class="py-12 text-center"><p class="text-slate-500 italic text-sm">No purchase records found.</p></div>`;
                    return;
                }

                list.innerHTML = orders.map(o => {
                    let statusClass = 'bg-white/5 text-slate-400';
                    const status = o.status || 'Pending';
                    
                    if(status === 'Completed') statusClass = 'status-completed';
                    if(status === 'Pending') statusClass = 'status-pending';
                    if(status === 'Shipped') statusClass = 'status-shipped';

                    return `
                        <div class="p-6 bg-white/2 rounded-2xl border border-white/5 hover:border-indigo-500/30 transition group">
                            <div class="flex flex-wrap justify-between items-center gap-6">
                                <div class="flex items-center gap-5">
                                    <div class="w-12 h-12 bg-indigo-500/10 rounded-2xl flex items-center justify-center text-indigo-400 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                        <i class="fas fa-file-invoice"></i>
                                    </div>
                                    <div>
                                        <p class="text-[9px] text-slate-500 font-black uppercase tracking-widest">Order Reference</p>
                                        <p class="font-bold text-white">#ORD-${o.id}</p>
                                        <p class="text-[10px] text-slate-400 font-medium">${o.product_name || 'Product Detail'}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-indigo-400 font-black text-sm mb-1">₱${parseFloat(o.total_price).toLocaleString()}</p>
                                    <span class="px-4 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest ${statusClass}">
                                        ${status}
                                    </span>
                                </div>
                            </div>
                        </div>`;
                }).join('');
            } catch (err) { 
                list.innerHTML = `<div class="p-6 text-center text-red-400 text-[10px] italic">⚠️ DATABASE CONNECTION ERROR: Ensure your server is running.</div>`;
            }
        }

        async function logout() {
            if (confirm("Are you sure you want to logout?")) {
                await fetch('/api/logout', { method: 'POST' });
                localStorage.clear();
                window.location.href = '/login';
            }
        }
        
        window.onload = () => { 
            initProfile(); 
            loadHistory(); 
        };
    </script>
</body>
</html>