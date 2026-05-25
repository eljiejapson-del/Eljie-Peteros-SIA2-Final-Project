<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Via Store | Premium Online Shopping</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap');

        :root {
            --primary: #6366f1;
            --bg-dark: #020617;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-dark);
            color: #f8fafc;
            overflow-x: hidden;
        }

        /* --- THE BEST BACKGROUND ENGINE --- */
        .bg-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
            background: var(--bg-dark);
        }

        /* Animated Mesh Gradient */
        .mesh-gradient {
            position: absolute;
            width: 150%;
            height: 150%;
            top: -25%;
            left: -25%;
            background-image: 
                radial-gradient(at 10% 20%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
                radial-gradient(at 90% 10%, rgba(168, 85, 247, 0.1) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(79, 70, 229, 0.05) 0px, transparent 50%),
                radial-gradient(at 20% 80%, rgba(99, 102, 241, 0.1) 0px, transparent 50%),
                radial-gradient(at 80% 90%, rgba(59, 130, 246, 0.15) 0px, transparent 50%);
            filter: blur(80px);
            animation: meshFlow 20s ease-in-out infinite alternate;
        }

        @keyframes meshFlow {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(5%, 5%) scale(1.1); }
            100% { transform: translate(-2%, 3%) scale(1); }
        }

        /* Subtle Grid Pattern Overlay */
        .grid-overlay {
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px), 
                              linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
            background-size: 50px 50px;
            mask-image: radial-gradient(ellipse at center, black, transparent 80%);
        }

        /* --- UI COMPONENTS --- */
        .glass-nav {
            background: rgba(2, 6, 23, 0.7);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(99, 102, 241, 0.3);
            box-shadow: 0 20px 40px -15px rgba(0,0,0,0.5);
        }

        .hero-title {
            background: linear-gradient(to bottom right, #ffffff 30%, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .floating {
            animation: floating 4s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 10px; }
    </style>
</head>
<body>

    <div class="bg-wrapper">
        <div class="mesh-gradient"></div>
        <div class="grid-overlay"></div>
    </div>

    <nav class="fixed top-0 w-full z-50 glass-nav">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-600/20">
                    <i class="fas fa-bolt text-white"></i>
                </div>
                <h1 class="text-2xl font-black tracking-tighter" id="storeBrand">VIA</h1>
            </div>

            <div class="hidden md:flex items-center gap-8 text-sm font-bold uppercase tracking-widest text-slate-400">
                <a href="#" class="hover:text-white transition">Home</a>
                <a href="#categories" class="hover:text-white transition">Collections</a>
                <a href="/login" class="hover:text-white transition">Shop</a>
            </div>

            <div class="flex items-center gap-4" id="navActions">
                <a href="/login" class="px-6 py-2.5 rounded-xl border border-white/10 text-sm font-bold hover:bg-white/5 transition">Sign In</a>
                <a href="/register" class="px-6 py-2.5 rounded-xl bg-indigo-600 text-sm font-bold hover:bg-indigo-500 transition shadow-lg shadow-indigo-500/20">Join Now</a>
            </div>
        </div>
    </nav>

    <section class="pt-48 pb-32 px-6">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
            <div class="relative z-10">
                <div class="inline-block px-4 py-1.5 rounded-full bg-indigo-500/10 text-[10px] font-black text-indigo-400 uppercase tracking-[0.3em] mb-6 border border-indigo-500/20">
                    The Future of Shopping
                </div>
                <h1 class="text-6xl md:text-8xl font-black hero-title leading-[0.9] mb-8">
                    REFINE YOUR <br> <span class="text-indigo-500">AESTHETIC.</span>
                </h1>
                <p class="text-slate-400 text-lg font-medium max-w-lg mb-10 leading-relaxed">
                    Step into a world where premium quality meets digital innovation. Your journey to a better lifestyle starts here.
                </p>
                <div class="flex flex-wrap gap-5">
                    <a href="/login" class="px-10 py-5 rounded-2xl bg-indigo-600 text-white font-black uppercase text-xs tracking-[0.2em] hover:bg-indigo-500 transition-all shadow-2xl shadow-indigo-500/40 active:scale-95">
                        Explore Collection
                    </a>
                    <div class="flex -space-x-3 items-center">
                        <img src="https://i.pravatar.cc/100?u=a1" class="w-10 h-10 rounded-full border-2 border-slate-900" alt="">
                        <img src="https://i.pravatar.cc/100?u=a2" class="w-10 h-10 rounded-full border-2 border-slate-900" alt="">
                        <img src="https://i.pravatar.cc/100?u=a3" class="w-10 h-10 rounded-full border-2 border-slate-900" alt="">
                        <p class="ml-4 text-xs font-bold text-slate-500">Trusted by <span class="text-white">10k+</span> global clients</p>
                    </div>
                </div>
            </div>

            <div class="relative hidden lg:block">
                <div class="absolute -inset-4 bg-indigo-500/20 blur-3xl rounded-full"></div>
                <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=2012&auto=format&fit=crop" 
                     class="relative z-10 rounded-[3.5rem] shadow-[0_0_50px_rgba(0,0,0,0.3)] floating border border-white/10 grayscale-[20%] hover:grayscale-0 transition-all duration-700" alt="Featured">
            </div>
        </div>
    </section>

    <section id="categories" class="py-20 px-6 relative">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16 gap-4">
                <div>
                    <h3 class="text-xs font-black text-indigo-500 uppercase tracking-[0.4em] mb-3">Curated Selection</h3>
                    <h2 class="text-5xl font-black text-white tracking-tighter">OUR CATEGORIES</h2>
                </div>
                <a href="/login" class="group flex items-center gap-3 text-sm font-bold text-slate-500 hover:text-white transition">
                    View Entire Store <i class="fas fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="glass-card rounded-[3rem] p-10 group">
                    <div class="w-14 h-14 bg-indigo-500/10 rounded-2xl flex items-center justify-center text-indigo-400 mb-8 group-hover:scale-110 transition-transform">
                        <i class="fas fa-microchip text-2xl"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-white mb-3">Hardware</h4>
                    <p class="text-slate-500 text-sm leading-relaxed mb-8 font-medium">Cutting-edge gadgets and tools for the digital pioneer.</p>
                    <div class="h-1 w-12 bg-indigo-600 rounded-full group-hover:w-full transition-all duration-500"></div>
                </div>

                <div class="glass-card rounded-[3rem] p-10 group">
                    <div class="w-14 h-14 bg-purple-500/10 rounded-2xl flex items-center justify-center text-purple-400 mb-8 group-hover:scale-110 transition-transform">
                        <i class="fas fa-crown text-2xl"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-white mb-3">Apparel</h4>
                    <p class="text-slate-500 text-sm leading-relaxed mb-8 font-medium">High-end fashion designed for impact and durability.</p>
                    <div class="h-1 w-12 bg-purple-600 rounded-full group-hover:w-full transition-all duration-500"></div>
                </div>

                <div class="glass-card rounded-[3rem] p-10 group">
                    <div class="w-14 h-14 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-400 mb-8 group-hover:scale-110 transition-transform">
                        <i class="fas fa-vihara text-2xl"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-white mb-3">Lifestyle</h4>
                    <p class="text-slate-500 text-sm leading-relaxed mb-8 font-medium">Elevate your daily routine with exclusive essentials.</p>
                    <div class="h-1 w-12 bg-blue-600 rounded-full group-hover:w-full transition-all duration-500"></div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-20 border-t border-white/5 bg-black/30">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-black text-white mb-4 tracking-tighter">VIA STORE</h2>
            <p class="text-slate-500 text-sm mb-10 max-w-sm mx-auto font-medium">Experience the synergy of style and technology. Your premier online destination.</p>
            <div class="flex justify-center gap-8 text-slate-400 text-xl">
                <a href="#" class="hover:text-indigo-400 transition"><i class="fab fa-instagram"></i></a>
                <a href="#" class="hover:text-indigo-400 transition"><i class="fab fa-dribbble"></i></a>
                <a href="#" class="hover:text-indigo-400 transition"><i class="fab fa-behance"></i></a>
            </div>
        </div>
    </footer>

    <script>
        window.onload = () => {
            // Sync Brand Name
            const savedName = localStorage.getItem('storeName') || 'VIA';
            document.querySelectorAll('#storeBrand').forEach(el => el.innerText = savedName.toUpperCase());

            // Dynamic Nav Logic
            const userId = localStorage.getItem('userId');
            const navActions = document.getElementById('navActions');

            if (userId) {
                const userName = localStorage.getItem('userName') || 'User';
                navActions.innerHTML = `
                    <div class="flex items-center gap-5">
                        <span class="hidden lg:block text-[10px] font-black text-slate-500 uppercase tracking-widest">Active: ${userName}</span>
                        <a href="/login" class="px-6 py-2.5 rounded-xl bg-white text-black text-xs font-black uppercase tracking-widest hover:bg-slate-200 transition">Go To Shop</a>
                        <a href="/profile" class="w-11 h-11 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-indigo-400 hover:bg-indigo-600 hover:text-white transition shadow-xl">
                            <i class="fas fa-user-astronaut"></i>
                        </a>
                    </div>
                `;
            }
        };
    </script>
</body>
</html>