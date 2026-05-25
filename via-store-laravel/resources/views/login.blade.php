<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Via Store | Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Identity Services SDK -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-image: url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #f8fafc;
            overflow: hidden;
        }

        .glass-card {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
        }

        .login-card {
            animation: fadeInScale 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.95) translateY(20px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }

        .glass-input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
        }

        .glass-input:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(99, 102, 241, 0.5);
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.2);
        }

        .input-icon {
            transition: all 0.3s ease;
        }

        .group:focus-within .input-icon {
            color: #818cf8;
            transform: scale(1.1);
        }

        /* Custom style para mag-match ang Google Button sa dark glass theme */
        #g_id_onload { display: none; }
        .google-btn-container {
            display: flex;
            justify-content: center;
            margin-top: 1.25rem;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-6 relative">

    <div class="absolute inset-0 bg-slate-950/60 z-0"></div>

    <div class="login-card glass-card p-8 lg:p-12 rounded-[3rem] w-full max-w-md relative z-10 overflow-hidden">
        
        <div class="text-center mb-10">
            <div class="inline-block px-4 py-1.5 rounded-full bg-indigo-500/20 text-[10px] font-black text-indigo-300 uppercase tracking-[0.3em] mb-4 border border-indigo-500/30">
                Identity Verification
            </div>
            <h1 class="text-4xl font-black text-white tracking-tighter uppercase mb-2">VIA STORE</h1>
            <p class="text-slate-300 text-sm font-medium">Welcome back. Please enter your details.</p>
        </div>

        <form id="loginForm" class="space-y-5">
            <div class="group relative">
                <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 input-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <input type="email" id="email" placeholder="Email Address" 
                       class="w-full pl-14 pr-4 py-4 rounded-2xl glass-input outline-none font-semibold placeholder:text-slate-500 placeholder:font-medium" required>
            </div>

            <div class="group relative">
                <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 input-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <input type="password" id="password" placeholder="Password" 
                       class="w-full pl-14 pr-14 py-4 rounded-2xl glass-input outline-none font-semibold placeholder:text-slate-500 placeholder:font-medium" required>
                
                <button type="button" onclick="togglePassword()" class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white transition">
                    <i class="fas fa-eye" id="eyeIcon"></i>
                </button>
            </div>

            <div class="flex justify-end">
                <a href="#" class="text-xs font-bold text-slate-400 hover:text-indigo-400 transition tracking-wide uppercase">Forgot Password?</a>
            </div>

            <button type="submit" id="loginBtn" class="w-full bg-indigo-600 text-white py-4 rounded-2xl font-black uppercase text-xs tracking-[0.2em] hover:bg-indigo-500 shadow-2xl shadow-indigo-600/40 transition-all active:scale-[0.97] disabled:opacity-50 disabled:cursor-not-allowed">
                Sign In
            </button>
        </form>

        <!-- Divider for Google Login -->
        <div class="relative flex py-6 items-center">
            <div class="flex-grow border-t border-white/10"></div>
            <span class="flex-shrink mx-4 text-slate-500 text-[10px] font-black uppercase tracking-widest">Or Continue With</span>
            <div class="flex-grow border-t border-white/10"></div>
        </div>

        <!-- Google Login Button -->
        <div class="google-btn-container">
            <!-- UPDATED CLIENT ID BELOW -->
            <div id="g_id_onload"
                 data-client_id="862238637781-o593bc7pa39ffbg3sc4h9dveea5c7h1k.apps.googleusercontent.com"
                 data-callback="handleGoogleLogin"
                 data-auto_prompt="false">
            </div>
            <div class="g_id_signin"
                 data-type="standard"
                 data-shape="pill"
                 data-theme="filled_blue"
                 data-text="continue_with"
                 data-size="large"
                 data-logo_alignment="left"
                 data-width="320">
            </div>
        </div>

        <div class="text-center mt-12">
            <p class="text-sm text-slate-300 font-medium">
                New here? 
                <a href="/register" class="text-indigo-400 font-bold hover:text-indigo-300 transition ml-1">Create an account</a>
            </p>
            
            <div class="mt-8 pt-6 border-t border-white/10">
                <a href="/index" class="text-[10px] font-black text-slate-400 hover:text-slate-200 transition flex items-center justify-center gap-3 tracking-[0.2em] uppercase">
                    <i class="fas fa-arrow-left text-[8px]"></i> Back to Home
                </a>
            </div>
        </div>
    </div>

    <script>
        // API Base URL Detection
        const API_BASE_URL = window.location.hostname === 'localhost' ? '' : 'https://via-store-system.onrender.com';

        // Feature 1: Password Visibility Toggle
        function togglePassword() {
            const passInput = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            if (passInput.type === 'password') {
                passInput.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passInput.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        // Feature: Google Login Handler
        async function handleGoogleLogin(response) {
            const btn = document.getElementById('loginBtn');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-circle-notch fa-spin mr-2"></i> GOOGLE AUTH...';

            try {
                const res = await fetch(`${API_BASE_URL}/api/google-auth`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ token: response.credential })
                });

                const data = await res.json();

                if (res.ok && data.success) {
                    processLoginSuccess(data);
                } else {
                    alert(data.message || "Google Authentication Failed.");
                }
            } catch (err) {
                console.error("Google Auth Error:", err);
                alert("Connection Error. Please check your internet.");
            } finally {
                btn.disabled = false;
                btn.innerHTML = 'Sign In';
            }
        }

        // Helper function para sa successful login
        function processLoginSuccess(data) {
            const role = (data.role || '').toLowerCase();
            localStorage.setItem('userId', data.user?.id || '');
            localStorage.setItem('userName', data.user?.name || 'User');
            localStorage.setItem('userRole', role);

            if (role === 'admin') {
                window.location.href = '/admin';
            } else {
                window.location.href = '/shop'; 
            }
        }

        // Feature 2: Manual Login Submission
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault(); 
            
            const btn = document.getElementById('loginBtn');
            const originalText = btn.innerHTML;
            
            btn.innerHTML = '<i class="fas fa-circle-notch fa-spin mr-2"></i> AUTHORIZING...';
            btn.disabled = true;

            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;

            try {
                const res = await fetch(`${API_BASE_URL}/api/login`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, password })
                });

                const data = await res.json();

                if (res.ok && data.success) {
                    processLoginSuccess(data);
                } else {
                    alert(data.message || "Invalid credentials.");
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            } catch (err) {
                console.error("Login error:", err);
                alert("Server Connection Error. Please try again.");
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        });

        // Feature 5: Auto-auth session check
        window.onload = async () => {
            try {
                const res = await fetch(`${API_BASE_URL}/api/check-auth`);
                const data = await res.json();
                
                if (data.authorized) {
                    processLoginSuccess(data);
                }
            } catch (e) {
                console.log("Standard login flow active.");
            }
        };
    </script>
</body>
</html>