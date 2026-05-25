<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Via Store | My Cart</title>
    <!-- Frameworks -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Using your existing style.css -->
    <link rel="stylesheet" href="style.css">
    <style>
        /* Ensuring glassmorphism consistency from your image */
        body {
            background: #0f172a;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 1.5rem;
            padding: 1.5rem;
        }
    </style>
</head>
<body class="min-h-screen text-slate-200">

    <!-- Navigation Header -->
    <nav class="glass-card sticky top-0 z-50 !rounded-none border-b border-white/10 !p-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <a href="/shop" class="text-2xl font-black tracking-tighter text-white hover:text-indigo-400 transition">
                VIA <span class="text-indigo-500">STORE</span>
            </a>
            <div class="flex items-center gap-6">
                <!-- Back Button to shop.html -->
                <a href="/shop" class="text-sm font-medium hover:text-indigo-400 transition flex items-center gap-2">
                    <i class="fas fa-arrow-left text-xs"></i> Continue Shopping
                </a>
                <div class="h-8 w-[1px] bg-white/10"></div>
                <span id="userName" class="text-sm font-bold text-indigo-300">Guest</span>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto p-6 md:p-12">
        <header class="mb-12">
            <h1 class="text-4xl font-black text-white mb-2 uppercase">Shopping Cart</h1>
            <p class="text-slate-400">Items saved to your account are synced across all your devices.</p>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Cart Items List -->
            <div class="lg:col-span-2 space-y-4" id="cartList">
                <!-- Loading State -->
                <div class="glass-card text-center p-20">
                    <i class="fas fa-spinner fa-spin text-3xl text-indigo-500 mb-4"></i>
                    <p class="uppercase tracking-widest text-[10px] font-black text-slate-500">Retrieving your items...</p>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="glass-card sticky top-28 border-indigo-500/20">
                    <h3 class="text-xl font-bold text-white mb-6 uppercase tracking-tight">Order Summary</h3>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-slate-400 text-sm">
                            <span>Subtotal</span>
                            <span id="subtotal" class="font-bold">₱0.00</span>
                        </div>
                        <div class="flex justify-between text-slate-400 text-sm">
                            <span>Shipping</span>
                            <span class="text-emerald-400 font-black uppercase text-[10px] tracking-widest">Free</span>
                        </div>
                        <div class="h-[1px] bg-white/10 my-4"></div>
                        <div class="flex justify-between text-white text-2xl font-black">
                            <span>Total</span>
                            <span id="grandTotal" class="text-indigo-400">₱0.00</span>
                        </div>
                    </div>

                    <button onclick="processCheckout()" id="checkoutBtn" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-black py-4 rounded-xl transition-all shadow-lg shadow-indigo-500/20 flex items-center justify-center gap-3 uppercase text-xs tracking-widest">
                        <i class="fas fa-shield-alt"></i>
                        Proceed to Checkout
                    </button>
                    
                    <p class="text-[9px] text-center text-slate-500 mt-4 uppercase tracking-[0.2em] font-bold">
                        Secure SSL Encrypted Checkout
                    </p>
                </div>
            </div>
        </div>
    </main>

    <script>
        let currentCart = [];

        async function init() {
            try {
                const res = await fetch('/api/check-auth');
                const auth = await res.json();
                
                if (!auth.authorized) {
                    window.location.href = '/login';
                    return;
                }

                document.getElementById('userName').innerText = auth.user.name;
                fetchCart();
            } catch (err) {
                console.error("Auth error:", err);
                window.location.href = '/login';
            }
        }

        // Updated Fetch Logic to handle errors gracefully
        async function fetchCart() {
            try {
                const res = await fetch('/api/cart');
                if (!res.ok) throw new Error("Could not reach cart API");
                
                currentCart = await res.json();
                renderCart();
            } catch (err) {
                console.error("Fetch error:", err);
                document.getElementById('cartList').innerHTML = `
                    <div class="glass-card text-center p-12 border-rose-500/20">
                        <i class="fas fa-exclamation-circle text-rose-500 text-3xl mb-4"></i>
                        <p class="text-rose-400 font-bold uppercase text-xs tracking-widest">Failed to load cart items</p>
                        <button onclick="fetchCart()" class="mt-4 text-xs text-indigo-400 hover:underline">Try Again</button>
                    </div>`;
            }
        }

        function renderCart() {
            const container = document.getElementById('cartList');
            const subtotalEl = document.getElementById('subtotal');
            const totalEl = document.getElementById('grandTotal');
            const checkoutBtn = document.getElementById('checkoutBtn');

            if (!currentCart || currentCart.length === 0) {
                container.innerHTML = `
                    <div class="glass-card text-center p-20">
                        <i class="fas fa-shopping-basket text-5xl text-slate-700 mb-6"></i>
                        <h2 class="text-xl font-bold text-white mb-2 uppercase">Your cart is empty</h2>
                        <p class="text-slate-500 text-sm mb-8">Add some style to your collection.</p>
                        <a href="/shop" class="inline-block bg-indigo-600/10 hover:bg-indigo-600/20 text-indigo-400 px-8 py-3 rounded-xl font-bold transition text-xs uppercase tracking-widest">
                            Browse Shop
                        </a>
                    </div>`;
                subtotalEl.innerText = "₱0.00";
                totalEl.innerText = "₱0.00";
                checkoutBtn.disabled = true;
                checkoutBtn.classList.add('opacity-50', 'cursor-not-allowed');
                return;
            }

            let total = 0;
            container.innerHTML = currentCart.map(item => {
                const itemTotal = parseFloat(item.price) * parseInt(item.quantity);
                total += itemTotal;

                return `
                    <div class="glass-card !p-4 flex flex-col md:flex-row items-center gap-6 group hover:border-indigo-500/30 transition-all">
                        <div class="w-20 h-20 rounded-xl overflow-hidden flex-shrink-0 bg-slate-800">
                            <img src="${item.image_url || 'https://via.placeholder.com/150'}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        
                        <div class="flex-1 text-center md:text-left">
                            <span class="text-[9px] font-black text-indigo-500 uppercase tracking-widest">${item.category || 'Item'}</span>
                            <h3 class="text-md font-bold text-white uppercase truncate max-w-[200px]">${item.name}</h3>
                            <p class="text-slate-500 text-[10px] font-bold">UNIT: ₱${parseFloat(item.price).toLocaleString()}</p>
                        </div>

                        <div class="flex items-center gap-4 bg-black/40 px-4 py-2 rounded-xl border border-white/5">
                            <span class="text-[10px] font-black text-slate-400 uppercase">Qty: ${item.quantity}</span>
                        </div>

                        <div class="text-center md:text-right min-w-[120px]">
                            <p class="text-lg font-black text-white">₱${itemTotal.toLocaleString()}</p>
                        </div>

                        <button onclick="removeItem(${item.cart_id})" class="text-slate-600 hover:text-rose-500 transition-colors p-2">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                `;
            }).join('');

            subtotalEl.innerText = `₱${total.toLocaleString()}`;
            totalEl.innerText = `₱${total.toLocaleString()}`;
            checkoutBtn.disabled = false;
            checkoutBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        }

        async function removeItem(cartId) {
            if (!confirm("Remove this item?")) return;
            try {
                const res = await fetch(`/api/cart/${cartId}`, { method: 'DELETE' });
                if (res.ok) fetchCart();
            } catch (err) {
                alert("Error removing item.");
            }
        }

        async function processCheckout() {
            const btn = document.getElementById('checkoutBtn');
            const originalContent = btn.innerHTML;
            btn.innerHTML = `<i class="fas fa-spinner fa-spin"></i> PROCESSING...`;
            btn.disabled = true;

            const orderData = {
                items: currentCart.map(item => ({
                    id: item.id,
                    name: item.name,
                    price: item.price,
                    qty: item.quantity
                }))
            };

            try {
                const res = await fetch('/api/create-order', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(orderData)
                });

                const result = await res.json();
                if (result.success) {
                    alert("Order Placed Successfully!");
                    window.location.href = '/shop'; 
                } else {
                    alert("Checkout Failed: " + result.message);
                    btn.innerHTML = originalContent;
                    btn.disabled = false;
                }
            } catch (err) {
                alert("Server Connection Error.");
                btn.innerHTML = originalContent;
                btn.disabled = false;
            }
        }

        window.onload = init;
    </script>
</body>
</html>