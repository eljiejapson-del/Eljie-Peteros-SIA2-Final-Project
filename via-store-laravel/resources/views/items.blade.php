<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Via Store | Admin Inventory</title>
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
            <a href="/items" class="nav-link active">
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
            <div class="font-bold text-white tracking-widest">VIA STORE</div>
            <button onclick="openModal('add')" class="w-10 h-10 rounded-lg bg-cyan-500/20 text-cyan-400 flex items-center justify-center">
                <i class="fas fa-plus"></i>
            </button>
        </div>

        <header class="flex flex-col md:flex-row md:justify-between md:items-center mb-10 gap-6">
            <div>
                <h1 class="text-3xl font-bold text-white">Clothing Inventory</h1>
                <p class="text-slate-400">Manage products, markups, and markdowns.</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <div class="relative flex-1 md:flex-none">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-500"></i>
                    <input type="text" id="searchInput" onkeyup="filterProducts()" placeholder="Search items..." 
                           class="pl-11 pr-4 py-3 bg-white/5 border border-white/10 rounded-2xl outline-none focus:ring-2 ring-cyan-500/50 w-full md:w-64 transition-all text-white">
                </div>
                <button onclick="fetchProducts()" class="glass-card !p-3 hover:bg-white/10 transition text-slate-300">
                    <i class="fas fa-sync-alt"></i>
                </button>
                <button class="flex items-center bg-cyan-600 text-white px-6 py-3 rounded-2xl font-bold hover:bg-cyan-500 transition shadow-lg shadow-cyan-900/20" onclick="openModal('add')">
                    <i class="fas fa-plus mr-2"></i> New Product
                </button>
            </div>
        </header>

        <!-- Product Table Container -->
        <div class="glass-card !p-0 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-white/5 border-b border-white/10">
                        <tr>
                            <th class="p-5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Product Details</th>
                            <th class="p-5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Category</th>
                            <th class="p-5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Price Management</th>
                            <th class="p-5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Stock Status</th>
                            <th class="p-5 text-center text-xs font-bold text-slate-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productBody" class="text-slate-300">
                        <!-- Content loaded by JS -->
                    </tbody>
                </table>
            </div>

            <!-- Pagination Container -->
            <div class="p-6 bg-white/5 border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-4">
                <span id="pageInfo" class="text-sm font-bold text-slate-500 uppercase tracking-widest"></span>
                <div class="flex gap-3 w-full md:w-auto">
                    <button id="prevBtn" onclick="changePage(-1)" class="flex-1 md:flex-none px-6 py-2.5 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 disabled:opacity-30 disabled:cursor-not-allowed font-bold text-slate-300 transition">
                        <i class="fas fa-chevron-left mr-2"></i> Previous
                    </button>
                    <button id="nextBtn" onclick="changePage(1)" class="flex-1 md:flex-none px-6 py-2.5 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 disabled:opacity-30 disabled:cursor-not-allowed font-bold text-slate-300 transition">
                        Next <i class="fas fa-chevron-right ml-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </main>

    <!-- CRUD Modal -->
    <div id="crudModal" class="hidden fixed inset-0 z-[2000] flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-md">
        <div class="glass-card w-full max-w-md shadow-2xl max-h-[90vh] overflow-y-auto border-cyan-500/20">
            <div class="flex justify-between items-center mb-6">
                <h2 id="modalTitle" class="text-2xl font-bold text-white">Add New Item</h2>
                <button onclick="closeModal()" class="text-slate-400 hover:text-white"><i class="fas fa-times text-xl"></i></button>
            </div>
            <form id="productForm" class="space-y-5">
                <input type="hidden" id="pId">
                <div>
                    <label class="text-[10px] font-extrabold text-slate-500 ml-1 mb-2 block uppercase tracking-tighter">Product Name</label>
                    <input type="text" id="pName" placeholder="e.g. Vintage Oversized Tee" class="w-full p-4 border border-white/10 rounded-2xl bg-white/5 text-white outline-none focus:ring-2 ring-cyan-500/50 transition-all" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-[10px] font-extrabold text-slate-500 ml-1 mb-2 block uppercase tracking-tighter">Category</label>
                        <input type="text" id="pCategory" placeholder="Shirts" class="w-full p-4 border border-white/10 rounded-2xl bg-white/5 text-white outline-none focus:ring-2 ring-cyan-500/50 transition-all" required>
                    </div>
                    <div>
                        <label class="text-[10px] font-extrabold text-slate-500 ml-1 mb-2 block uppercase tracking-tighter">Price (₱)</label>
                        <input type="number" id="pPrice" placeholder="0.00" step="0.01" class="w-full p-4 border border-white/10 rounded-2xl bg-white/5 text-white outline-none focus:ring-2 ring-cyan-500/50 transition-all" required>
                    </div>
                </div>
                <div>
                    <label class="text-[10px] font-extrabold text-slate-500 ml-1 mb-2 block uppercase tracking-tighter">Stock Quantity</label>
                    <input type="number" id="pStock" placeholder="0" class="w-full p-4 border border-white/10 rounded-2xl bg-white/5 text-white outline-none focus:ring-2 ring-cyan-500/50 transition-all" required>
                </div>
                <div>
                    <label class="text-[10px] font-extrabold text-slate-500 ml-1 mb-2 block uppercase tracking-tighter">Image Upload</label>
                    <div class="flex items-center gap-4">
                        <input type="file" id="pImgFile" accept="image/*" class="text-xs text-slate-500 flex-1">
                        <input type="hidden" id="pImgValue">
                    </div>
                </div>
                <div id="previewContainer" class="hidden flex justify-center py-2">
                    <img id="previewImg" src="" class="w-28 h-28 rounded-2xl object-cover border-2 border-white/10 shadow-lg">
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="button" class="flex-1 p-4 bg-white/10 rounded-2xl font-bold text-slate-300 hover:bg-white/20 transition" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="flex-1 p-4 bg-cyan-600 text-white rounded-2xl font-bold hover:bg-cyan-500 shadow-lg shadow-cyan-900/20 transition">Save Product</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentMode = 'add';
        let allProducts = []; 
        let filteredProducts = []; 
        let currentPage = 1;
        const itemsPerPage = 10;

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

        // IMAGE PREVIEW
        document.getElementById('pImgFile').addEventListener('change', function() {
            const reader = new FileReader();
            reader.onload = (e) => {
                document.getElementById('pImgValue').value = e.target.result;
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('previewContainer').classList.remove('hidden');
            };
            if(this.files[0]) reader.readAsDataURL(this.files[0]);
        });

        // FETCH PRODUCTS
        async function fetchProducts() {
            const body = document.getElementById('productBody');
            body.innerHTML = `<tr><td colspan="5" class="p-10 text-center"><div class="animate-pulse flex flex-col space-y-4"><div class="h-12 bg-white/5 rounded-xl"></div><div class="h-12 bg-white/5 rounded-xl"></div></div></td></tr>`;
            
            try {
                const res = await fetch('/api/products');
                if (!res.ok) throw new Error('API Error');
                allProducts = await res.json();
                filteredProducts = [...allProducts];
                renderTable();
            } catch (err) { 
                console.error("Fetch Error:", err);
                body.innerHTML = `<tr><td colspan="5" class="p-10 text-center text-red-400 font-bold">Error connecting to server.</td></tr>`;
            }
        }

        // RENDER TABLE
        function renderTable() {
            const body = document.getElementById('productBody');
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedData = filteredProducts.slice(startIndex, endIndex);

            if (paginatedData.length === 0) {
                body.innerHTML = `<tr><td colspan="5" class="p-20 text-center text-slate-500 font-bold uppercase tracking-widest">No Items Found</td></tr>`;
                updatePaginationControls(0);
                return;
            }

            body.innerHTML = paginatedData.map((p) => {
                const price = parseFloat(p.price) || 0;
                return `
                <tr class="border-b border-white/5 hover:bg-white/5 transition-colors group">
                    <td class="p-5">
                        <div class="flex items-center gap-4">
                            <img src="${p.image_url || 'https://via.placeholder.com/50'}" class="w-12 h-12 rounded-xl object-cover bg-white/10 shadow-md">
                            <span class="font-bold text-white">${p.name}</span>
                        </div>
                    </td>
                    <td class="p-5">
                        <span class="bg-cyan-500/10 px-3 py-1.5 rounded-lg text-[10px] font-extrabold text-cyan-400 uppercase tracking-tighter">${p.category}</span>
                    </td>
                    <td class="p-5">
                        <div class="flex flex-col">
                            <span class="font-black text-white text-lg">₱${price.toLocaleString(undefined, {minimumFractionDigits: 2})}</span>
                            <div class="flex gap-2 mt-2">
                                <button onclick='adjustPrice(${p.id}, "markup")' class="text-[8px] bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 px-2 py-1 rounded-md font-black hover:bg-emerald-500 hover:text-white transition">+ MARKUP</button>
                                <button onclick='adjustPrice(${p.id}, "markdown")' class="text-[8px] bg-rose-500/20 text-rose-400 border border-rose-500/30 px-2 py-1 rounded-md font-black hover:bg-rose-500 hover:text-white transition">- MARKDOWN</button>
                            </div>
                        </div>
                    </td>
                    <td class="p-5">
                        <span class="inline-flex items-center font-bold px-3 py-1 rounded-full text-[10px] ${p.stock < 5 ? 'bg-rose-500/10 text-rose-400' : 'bg-emerald-500/10 text-emerald-400'}">
                            <i class="fas fa-circle text-[5px] mr-2"></i> ${p.stock} Units
                        </span>
                    </td>
                    <td class="p-5 text-center">
                        <div class="flex justify-center gap-3">
                            <button onclick='editBtnClicked(${p.id})' class="w-9 h-9 flex items-center justify-center rounded-xl bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-white transition-all"><i class="fas fa-pen text-xs"></i></button>
                            <button onclick="deleteProduct(${p.id})" class="w-9 h-9 flex items-center justify-center rounded-xl bg-rose-500/10 text-rose-400 hover:bg-rose-500 hover:text-white transition-all"><i class="fas fa-trash text-xs"></i></button>
                        </div>
                    </td>
                </tr>`;
            }).join('');

            updatePaginationControls(filteredProducts.length);
        }

        // PRICE ADJUSTMENT
        async function adjustPrice(id, type) {
            const product = allProducts.find(p => p.id === id);
            if (!product) return;
            
            const action = type === 'markup' ? 'increase' : 'decrease';
            const percentage = prompt(`Enter percentage to ${action} price for ${product.name}:`);
            
            if (percentage === null || percentage.trim() === "" || isNaN(percentage)) return;

            const factor = parseFloat(percentage) / 100;
            const currentPrice = parseFloat(product.price);
            let newPrice = type === 'markup' ? currentPrice * (1 + factor) : currentPrice * (1 - factor);
            
            if (newPrice < 0) newPrice = 0;

            try {
                const response = await fetch(`/api/products/${id}`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ ...product, price: newPrice.toFixed(2) })
                });
                
                if(response.ok) fetchProducts();
                else alert("Update failed on server.");
            } catch (err) { 
                console.error(err);
                alert("Network error updating price."); 
            }
        }

        function updatePaginationControls(total) {
            const maxPage = Math.ceil(total / itemsPerPage) || 1;
            document.getElementById('pageInfo').innerText = `Page ${currentPage} / ${maxPage}`;
            document.getElementById('prevBtn').disabled = currentPage === 1;
            document.getElementById('nextBtn').disabled = currentPage === maxPage;
        }

        function changePage(dir) { 
            currentPage += dir; 
            window.scrollTo({ top: 0, behavior: 'smooth' });
            renderTable(); 
        }

        function filterProducts() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            filteredProducts = allProducts.filter(p => 
                p.name.toLowerCase().includes(query) || 
                p.category.toLowerCase().includes(query)
            );
            currentPage = 1;
            renderTable();
        }

        // FORM SUBMISSION
        document.getElementById('productForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const data = {
                name: document.getElementById('pName').value,
                category: document.getElementById('pCategory').value,
                price: parseFloat(document.getElementById('pPrice').value),
                stock: parseInt(document.getElementById('pStock').value),
                image_url: document.getElementById('pImgValue').value
            };
            
            const method = currentMode === 'add' ? 'POST' : 'PUT';
            const url = currentMode === 'add' ? '/api/products' : `/api/products/${document.getElementById('pId').value}`;
            
            try {
                const response = await fetch(url, { 
                    method, 
                    headers: { 'Content-Type': 'application/json' }, 
                    body: JSON.stringify(data) 
                });
                if(response.ok) { 
                    closeModal(); 
                    fetchProducts(); 
                } else { 
                    alert("Error saving product."); 
                }
            } catch (error) { 
                console.error("Error:", error); 
                alert("Connection error.");
            }
        });

        async function deleteProduct(id) {
            if (confirm("Are you sure you want to delete this item?")) {
                try {
                    const res = await fetch(`/api/products/${id}`, { method: 'DELETE' });
                    if(res.ok) fetchProducts();
                    else alert("Could not delete item.");
                } catch (err) { 
                    alert("Failed to connect for deletion."); 
                }
            }
        }

        // MODAL LOGIC
        function editBtnClicked(id) {
            const product = allProducts.find(p => p.id === id);
            if(product) openModal('edit', product);
        }

        function openModal(mode, p = null) {
            currentMode = mode;
            document.getElementById('productForm').reset();
            document.getElementById('pId').value = "";
            document.getElementById('pImgValue').value = "";
            document.getElementById('previewContainer').classList.add('hidden');
            document.getElementById('modalTitle').innerText = mode === 'add' ? 'Add New Item' : 'Edit Product';
            
            if (p) {
                document.getElementById('pId').value = p.id;
                document.getElementById('pName').value = p.name;
                document.getElementById('pCategory').value = p.category;
                document.getElementById('pPrice').value = p.price;
                document.getElementById('pStock').value = p.stock;
                document.getElementById('pImgValue').value = p.image_url || "";
                if(p.image_url) {
                    document.getElementById('previewImg').src = p.image_url;
                    document.getElementById('previewContainer').classList.remove('hidden');
                }
            }
            document.getElementById('crudModal').classList.remove('hidden');
        }

        function closeModal() { 
            document.getElementById('crudModal').classList.add('hidden'); 
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
            fetchProducts(); 
        };
    </script>
</body>
</html>