<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login Admin</title>
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        /* Import Font dari Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('https://images.unsplash.com/photo-1580273916550-e323be2ae537?q=80&w=1964&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') no-repeat;
            background-size: cover;
            background-position: center;
        }

        .login-container {
            width: 420px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, .2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            color: #fff;
            border-radius: 10px;
            padding: 30px 40px;
        }

        .login-container h1 {
            font-size: 36px;
            text-align: center;
            margin-bottom: 20px;
        }

        .login-container .input-group {
            position: relative;
            width: 100%;
            height: 50px;
            margin: 30px 0;
        }

        .input-group input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255, 255, 255, .2);
            border-radius: 40px;
            font-size: 16px;
            color: #fff;
            padding: 20px 45px 20px 20px;
        }

        .input-group input::placeholder {
            color: #fff;
        }

        .input-group i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
        }

        .login-container .options {
            display: flex;
            justify-content: space-between;
            font-size: 14.5px;
            margin: -15px 0 15px;
        }

        .options label {
            display: flex;
            align-items: center;
        }

        .options label input {
            accent-color: #fff;
            margin-right: 5px;
        }

        .options a {
            color: #fff;
            text-decoration: none;
        }

        .options a:hover {
            text-decoration: underline;
        }

        .login-container .btn-login {
            width: 100%;
            height: 45px;
            background: #fff;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            cursor: pointer;
            font-size: 16px;
            color: #333;
            font-weight: 600;
            transition: background 0.3s ease;
        }

        .login-container .btn-login:hover {
            background: #f0f0f0;
        }

        .login-container .register-link {
            font-size: 14.5px;
            text-align: center;
            margin-top: 20px;
        }

        .register-link p a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link p a:hover {
            text-decoration: underline;
        }
        
        #error-message {
            color: #ff8a8a;
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            min-height: 20px;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <form id="login-form" method="POST" action="">
            {{-- Token Keamanan Laravel --}}
            @csrf

            <h1>Admin</h1>
            
            {{-- Menampilkan error validasi dari Laravel --}}
            @if ($errors->any())
                <div id="error-message">
                    @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span>
                    @endforeach
                </div>
            @else
                <div id="error-message"></div>
            @endif

            <div class="input-group">
                {{-- Gunakan `old('email')` untuk menjaga input setelah validasi gagal --}}
                <input type="email" id="email" name="email" placeholder="Email" required value="{{ old('email') }}">
                <i class='bx bxs-user'></i>
            </div>
            
            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            
                <button type="submit" class="btn-login">Login</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const loginForm = document.getElementById('login-form');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const errorMessageContainer = document.getElementById('error-message');

            loginForm.addEventListener('submit', (event) => {
                const email = emailInput.value.trim();
                const password = passwordInput.value.trim();
                let clientSideErrors = [];

                if (errorMessageContainer.textContent.trim() !== '') {
                    return;
                }

                if (email === '') {
                    clientSideErrors.push('Email tidak boleh kosong.');
                }

                if (password === '') {
                    clientSideErrors.push('Password tidak boleh kosong.');
                }
                
                if (password.length > 0 && password.length < 6) {
                    clientSideErrors.push('Password harus memiliki minimal 6 karakter.');
                }

                if (clientSideErrors.length > 0) {
                    event.preventDefault(); 
                    errorMessageContainer.innerHTML = clientSideErrors.join('<br>');
                }
            });
        });
    </script>
</body>
</html>