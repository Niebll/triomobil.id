<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
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
            padding: 20px 0; /* Menambahkan padding untuk layar kecil */
            background: url('https://images.unsplash.com/photo-1580273916550-e323be2ae537?q=80&w=1964&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') no-repeat;
            background-size: cover;
            background-position: center;
        }

        .register-container {
            width: 420px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, .2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            color: #fff;
            border-radius: 10px;
            padding: 30px 40px;
        }

        .register-container h1 {
            font-size: 36px;
            text-align: center;
            margin-bottom: 20px;
        }

        .register-container .input-group {
            position: relative;
            width: 100%;
            height: 50px;
            margin: 25px 0; /* Sedikit mengurangi margin */
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

        .register-container .btn-register {
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
            margin-top: 20px;
            transition: background 0.3s ease;
        }

        .register-container .btn-register:hover {
            background: #f0f0f0;
        }

        .register-container .login-link {
            font-size: 14.5px;
            text-align: center;
            margin-top: 20px;
        }

        .login-link p a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link p a:hover {
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

    <div class="register-container">
        <form id="register-form" method="POST" action="">
            @csrf
            <h1>Daftar</h1>
            
            @if ($errors->any())
                <div id="error-message">
                    @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span><br>
                    @endforeach
                </div>
            @else
                <div id="error-message"></div>
            @endif

            <div class="input-group">
                <input type="text" id="name" name="name" placeholder="Nama Lengkap" required value="{{ old('name') }}">
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-group">
                <input type="email" id="email" name="email" placeholder="Email" required value="{{ old('email') }}">
                <i class='bx bxs-envelope'></i>
            </div>
            
            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="input-group">
                {{-- Nama "password_confirmation" penting untuk validasi 'confirmed' di Laravel --}}
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            
            <button type="submit" class="btn-register">Daftar</button>
            
            <div class="login-link">
                <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const registerForm = document.getElementById('register-form');
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const passwordConfirmationInput = document.getElementById('password_confirmation');
            const errorMessageContainer = document.getElementById('error-message');

            registerForm.addEventListener('submit', (event) => {
                const name = nameInput.value.trim();
                const email = emailInput.value.trim();
                const password = passwordInput.value.trim();
                const passwordConfirmation = passwordConfirmationInput.value.trim();
                let clientSideErrors = [];

                if (errorMessageContainer.textContent.trim() !== '') {
                    return;
                }
                
                if (name === '' || email === '' || password === '' || passwordConfirmation === '') {
                    clientSideErrors.push('Semua field wajib diisi.');
                } else {
                    if (password.length < 8) {
                        clientSideErrors.push('Password harus memiliki minimal 8 karakter.');
                    }
                    if (password !== passwordConfirmation) {
                        clientSideErrors.push('Konfirmasi password tidak cocok.');
                    }
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