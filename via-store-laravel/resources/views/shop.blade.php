<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Via Store | Shop</title>
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

        .product-card:hover {
            transform: translateY(-8px);
            border-color: rgba(99, 102, 241, 0.4);
            background: rgba(255, 255, 255, 0.06);
        }

        .nav-link.active {
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.1) 0%, rgba(99, 102, 241, 0) 100%);
            color: #818cf8;
            border-left: 3px solid #6366f1;
        }

        .search-input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .search-input:focus {
            border-color: var(--accent);
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 15px var(--accent-glow);
        }

        .category-pill {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .category-pill.active {
            background: #6366f1;
            color: white;
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.3);
        }

        ::-webkit-scrollbar { width: 5px; }
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
            <a href="/dashboard" class="nav-link flex items-center gap-4 px-6 py-4 rounded-xl text-slate-400 font-semibold hover:text-white transition">
                <i class="fas fa-th-large w-5"></i> Dashboard
            </a>
            <a href="/shop" class="nav-link active flex items-center gap-4 px-6 py-4 rounded-xl text-slate-400 font-semibold hover:text-white transition">
                <i class="fas fa-shopping-bag w-5"></i> Shop
            </a>
            <a href="/profile" class="nav-link flex items-center gap-4 px-6 py-4 rounded-xl text-slate-400 font-semibold hover:text-white transition">
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
        <header class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-12">
            <div>
                <h2 class="text-4xl font-black text-white tracking-tight uppercase">Discover Items</h2>
                <p class="text-slate-500 font-medium mt-1">High quality products curated just for you.</p>
            </div>

            <div class="flex items-center gap-4 w-full lg:w-auto">
                <div class="relative flex-1 lg:w-80">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-500"></i>
                    <input type="text" id="searchInput" placeholder="Search products..." 
                           class="w-full pl-12 pr-4 py-3 rounded-xl search-input outline-none text-sm font-medium">
                </div>
                <a href="/cart" class="relative w-12 h-12 glass-card rounded-xl flex items-center justify-center text-indigo-400 hover:text-white transition">
                    <i class="fas fa-shopping-cart"></i>
                    <span id="cartBadge" class="absolute -top-2 -right-2 w-5 h-5 bg-indigo-600 text-white text-[10px] font-bold rounded-full flex items-center justify-center shadow-lg" style="display: none;">0</span>
                </a>
            </div>
        </header>

        <div class="flex flex-wrap gap-3 mb-10">
            <div class="category-pill active px-6 py-2.5 rounded-full glass-card text-[10px] font-black uppercase tracking-widest" onclick="filterCategory('All')">All Items</div>
            <div class="category-pill px-6 py-2.5 rounded-full glass-card text-[10px] font-black uppercase tracking-widest text-slate-500" onclick="filterCategory('Clothing')">Clothing</div>
            <div class="category-pill px-6 py-2.5 rounded-full glass-card text-[10px] font-black uppercase tracking-widest text-slate-500" onclick="filterCategory('Shoes')">Shoes</div>
            <div class="category-pill px-6 py-2.5 rounded-full glass-card text-[10px] font-black uppercase tracking-widest text-slate-500" onclick="filterCategory('Accessories')">Accessories</div>
        </div>

        <div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <!-- Products load here via JS -->
        </div>
    </main>

    <script>
        let allProducts = [];

        window.onload = () => {
            const savedName = localStorage.getItem('storeName') || 'VIA';
            document.getElementById('storeBrand').innerText = savedName.toUpperCase();
            loadProducts();
            updateCartBadge(); 
        };

        async function loadProducts() {
            try {
                const res = await fetch('/api/products');
                const contentType = res.headers.get("content-type");
                if (!contentType || !contentType.includes("application/json")) {
                    throw new Error("Server error: Product route not found.");
                }

                allProducts = await res.json();
                renderProducts(allProducts);
            } catch (err) {
                console.error(err);
                document.getElementById('productGrid').innerHTML = `
                    <div class="col-span-full p-12 glass-card rounded-3xl text-center">
                        <i class="fas fa-exclamation-triangle text-orange-500 text-3xl mb-4"></i>
                        <p class="text-white font-bold">Unable to load items.</p>
                        <p class="text-slate-500 text-sm mt-1">${err.message}</p>
                    </div>`;
            }
        }

        function renderProducts(products) {
            const grid = document.getElementById('productGrid');
            if (products.length === 0) {
                grid.innerHTML = `<div class="col-span-full text-center text-slate-500 py-10">No products found.</div>`;
                return;
            }

            grid.innerHTML = products.map(product => {
                const isOutOfStock = product.stock <= 0;
                return `
                <div class="product-card glass-card rounded-[2rem] p-5 flex flex-col group ${isOutOfStock ? 'opacity-60' : ''}">
                    <div class="relative aspect-square rounded-[1.5rem] overflow-hidden mb-5 bg-slate-800">
                        <img src="${product.image_url || 'https://via.placeholder.com/300'}" 
                             alt="${product.name}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div class="absolute top-4 right-4 px-3 py-1 bg-black/50 backdrop-blur-md rounded-lg text-[10px] font-black ${isOutOfStock ? 'text-red-400' : 'text-indigo-400'} uppercase tracking-widest border border-white/10">
                            ${isOutOfStock ? 'Out of Stock' : (product.category || 'New')}
                        </div>
                    </div>

                    <div class="flex-1 px-2">
                        <h3 class="text-white font-black text-lg tracking-tight mb-1 truncate">${product.name}</h3>
                        <p class="text-slate-500 text-xs font-medium mb-2 line-clamp-2">${product.description || 'Premium quality item.'}</p>
                        <p class="text-[10px] text-slate-400 font-bold mb-4 uppercase tracking-tighter">Availability: ${product.stock} units</p>
                        
                        <div class="flex items-center justify-between mt-auto gap-2">
                            <div class="flex-1">
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Price</p>
                                <p class="text-indigo-400 font-black text-xl">₱${parseFloat(product.price).toLocaleString()}</p>
                            </div>
                            <button onclick="buyNow(${product.id})" ${isOutOfStock ? 'disabled' : ''}
                                    class="px-4 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl text-[10px] font-bold uppercase transition disabled:opacity-30">
                                Buy Now
                            </button>
                            <button onclick="addToCart(event, ${product.id})" ${isOutOfStock ? 'disabled' : ''}
                                    class="w-12 h-12 bg-white/5 hover:bg-white/10 text-white rounded-xl transition border border-white/5 disabled:opacity-30">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `}).join('');
        }

        async function addToCart(event, productId) {
            // Grab the button element immediately from the event
            const btn = event.currentTarget;
            
            try {
                const authRes = await fetch('/api/check-auth');
                const auth = await authRes.json();

                if (!auth.authorized) {
                    alert("Please login to save items to your cart.");
                    window.location.href = '/login';
                    return;
                }

                const res = await fetch('/api/cart', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ product_id: productId, quantity: 1 })
                });

                const data = await res.json();
                if (data.success) {
                    updateCartBadge();
                    
                    // Visual feedback using the captured btn reference
                    const originalIcon = btn.innerHTML;
                    btn.innerHTML = '<i class="fas fa-check text-emerald-400"></i>';
                    setTimeout(() => btn.innerHTML = originalIcon, 2000);
                } else {
                    alert(data.error || "Failed to add item.");
                }
            } catch (err) {
                console.error("Cart Error:", err);
            }
        }

        async function updateCartBadge() {
            try {
                const res = await fetch('/api/cart');
                if (res.ok) {
                    const items = await res.json();
                    const badge = document.getElementById('cartBadge');
                    
                    // Handle case where items might be an array or an object with a count
                    const totalItems = Array.isArray(items) 
                        ? items.reduce((sum, i) => sum + (i.quantity || 1), 0)
                        : (items.count || 0);

                    badge.innerText = totalItems;
                    badge.style.display = totalItems > 0 ? 'flex' : 'none';
                }
            } catch (err) {
                console.log("Badge sync failed.");
            }
        }

        async function buyNow(id) {
            // Create a fake event object to satisfy the addToCart function signature
            const fakeEvent = { currentTarget: document.activeElement };
            await addToCart(fakeEvent, id);
            window.location.href = '/cart';
        }

        function filterCategory(cat) {
            document.querySelectorAll('.category-pill').forEach(pill => {
                pill.classList.remove('active', 'text-white');
                pill.classList.add('text-slate-500');
                // Normalized check for active state
                if(pill.innerText.trim().toUpperCase() === cat.toUpperCase() || 
                  (cat === 'All' && pill.innerText.trim().toUpperCase() === 'ALL ITEMS')) {
                    pill.classList.add('active', 'text-white');
                    pill.classList.remove('text-slate-500');
                }
            });

            if (cat === 'All') renderProducts(allProducts);
            else renderProducts(allProducts.filter(p => p.category === cat));
        }

        document.getElementById('searchInput').addEventListener('input', (e) => {
            const term = e.target.value.toLowerCase();
            const filtered = allProducts.filter(p => 
                p.name.toLowerCase().includes(term) || 
                (p.category && p.category.toLowerCase().includes(term))
            );
            renderProducts(filtered);
        });

        async function logout() {
            if (confirm("Are you sure you want to logout?")) {
                localStorage.clear();
                window.location.href = '/login';
            }
        }
    </script>
</body>
</html>