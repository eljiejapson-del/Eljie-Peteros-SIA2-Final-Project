<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Via Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap');
        
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        .hero-bg {
            background: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.8)), 
                        url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
        }
        .step-hidden { display: none; }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        #registrationStep, #verificationStep {
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="hero-bg flex items-center justify-center min-h-screen p-6">

    <div class="glass-card p-8 md:p-10 rounded-[2.5rem] shadow-2xl w-full max-w-lg">
        
        <!-- Registration Form Step -->
        <div id="registrationStep">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-black text-slate-800 tracking-tighter" id="formHeader">Join Via Store</h2>
                <p class="text-slate-500 text-sm font-medium">Create your customer account to start shopping.</p>
            </div>

            <form id="regForm" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" id="name" placeholder="Full Name" 
                           class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl outline-none focus:ring-2 ring-indigo-400 transition" required>
                    
                    <input type="email" id="email" placeholder="Email Address" 
                           class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl outline-none focus:ring-2 ring-indigo-400 transition" required>
                </div>

                <input type="password" id="pass" placeholder="Create Password" 
                       class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl outline-none focus:ring-2 ring-indigo-400 transition" required>

                <div class="pt-4 border-t border-slate-100">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Personal Details</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <input type="text" id="phone" placeholder="Phone Number" 
                               class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl outline-none focus:ring-2 ring-indigo-400 transition" required>
                        
                        <select id="gender" class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl outline-none focus:ring-2 ring-indigo-400 transition font-medium text-slate-500" required>
                            <option value="" disabled selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="relative">
                        <input type="text" id="location" maxlength="45" placeholder="Delivery Address (Max 45 chars)" 
                               class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl outline-none focus:ring-2 ring-indigo-400 transition mb-1" required>
                        <p class="text-[9px] text-right text-slate-400 pr-2 italic">Max 45 characters</p>
                    </div>
                    
                    <div class="relative mt-4">
                        <p class="text-[10px] font-bold text-slate-400 mb-1 ml-2">Birthdate</p>
                        <input type="date" id="birthdate" 
                               class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl outline-none focus:ring-2 ring-indigo-400 transition text-slate-500" required>
                    </div>
                </div>

                <button type="submit" id="submitBtn" class="w-full bg-slate-900 text-white py-4 rounded-2xl font-black uppercase tracking-widest text-xs shadow-lg hover:bg-indigo-600 transition-all active:scale-[0.98] mt-4">
                    Get Verification Code
                </button>
            </form>
        </div>

        <!-- Verification Step -->
        <div id="verificationStep" class="step-hidden">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center text-2xl mx-auto mb-4">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <h2 class="text-2xl font-black text-slate-800 tracking-tighter">Verify Email</h2>
                <p class="text-slate-500 text-sm font-medium">We sent a code to <span id="displayEmail" class="text-indigo-600 font-bold"></span></p>
            </div>

            <div class="space-y-4">
                <input type="text" id="vCode" placeholder="000000" maxlength="6"
                       class="w-full p-5 bg-slate-50 border border-slate-100 rounded-2xl text-center text-3xl font-bold tracking-[0.5em] outline-none focus:ring-2 ring-indigo-400 transition">
                
                <button onclick="verifyAndRegister()" id="verifyBtn" class="w-full bg-indigo-600 text-white py-4 rounded-2xl font-black uppercase tracking-widest text-xs shadow-lg hover:bg-slate-900 transition-all">
                    Verify & Complete
                </button>
                
                <button onclick="toggleSteps(false)" class="w-full text-slate-400 py-2 font-bold text-[10px] uppercase tracking-widest hover:text-slate-600 transition">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Edit
                </button>
            </div>
        </div>

        <p class="text-center mt-6 text-xs font-bold text-slate-400">
            Already have an account? <a href="/index" class="text-indigo-600 hover:underline">Login here</a>
        </p>
    </div>

    <script>
        /**
         * FIX PARA SA RENDER CONNECTION
         * Sinisiguro nito na kahit nasaan ka, makokontak ng frontend ang backend.
         */
        const API_BASE_URL = window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1'
            ? 'http://localhost:3000' 
            : 'https://via-store-system.onrender.com'; // Palitan ito kung iba ang URL ng backend mo

        let pendingUserData = null;

        function toggleSteps(showVerification) {
            const regStep = document.getElementById('registrationStep');
            const verStep = document.getElementById('verificationStep');
            regStep.classList.toggle('step-hidden', showVerification);
            verStep.classList.toggle('step-hidden', !showVerification);
        }

        // Phase 1: Request Verification Code
        document.getElementById('regForm').onsubmit = async (e) => {
            e.preventDefault();
            const btn = document.getElementById('submitBtn');
            const originalText = btn.innerText;
            
            btn.innerText = "SENDING CODE...";
            btn.disabled = true;

            pendingUserData = {
                fullname: document.getElementById('name').value,
                email: document.getElementById('email').value,
                password: document.getElementById('pass').value,
                phone: document.getElementById('phone').value,
                gender: document.getElementById('gender').value,
                location: document.getElementById('location').value,
                birthdate: document.getElementById('birthdate').value,
                role: 'customer'
            };

            try {
                // Gumagamit ng full path para maiwasan ang 404 sa Render
                const res = await fetch(`${API_BASE_URL}/api/send-verification`, {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({ email: pendingUserData.email })
                });

                const data = await res.json();

                if (data.success) {
                    document.getElementById('displayEmail').innerText = pendingUserData.email;
                    toggleSteps(true);
                } else {
                    alert("Error: " + (data.message || "Failed to send verification email. Check server logs."));
                }
            } catch (err) {
                console.error("Fetch Error:", err);
                alert("Connection Error: Hindi ma-contact ang server. Siguraduhin na ang backend ay 'Active'. Maaaring maghintay ng 1 minuto para mag-'wake up' ang Render server.");
            } finally {
                btn.innerText = originalText;
                btn.disabled = false;
            }
        };

        // Phase 2: Final Registration
        async function verifyAndRegister() {
            const code = document.getElementById('vCode').value;
            const vBtn = document.getElementById('verifyBtn');
            
            if (code.length < 6) return alert("Please enter the complete 6-digit code.");

            vBtn.innerText = "VERIFYING...";
            vBtn.disabled = true;

            try {
                const res = await fetch(`${API_BASE_URL}/api/register`, {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({ 
                        ...pendingUserData, 
                        verificationCode: code 
                    })
                });

                const data = await res.json();

                if (data.success) {
                    alert("Account successfully created! Please login.");
                    window.location.href = '/index';
                } else {
                    alert(data.message || "Invalid or expired code.");
                }
            } catch (err) {
                alert("An error occurred during verification.");
            } finally {
                vBtn.innerText = "Verify & Complete";
                vBtn.disabled = false;
            }
        }

        window.onload = () => {
            const savedName = localStorage.getItem('storeName') || 'VIA STORE';
            document.getElementById('formHeader').innerText = `Join ${savedName}`;
        };
    </script>
</body>
</html>