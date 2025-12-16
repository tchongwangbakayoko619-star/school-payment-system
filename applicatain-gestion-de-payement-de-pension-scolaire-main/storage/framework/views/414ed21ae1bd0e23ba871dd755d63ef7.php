<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySchoolPay Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            flex-wrap: wrap;
            max-width: 1000px;
            width: 100%;
        }

        .image-box {
            flex: 1;
            max-width: 450px;
        }

        .image-box img {
            width: 100%;
            height: 100%;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .login-box {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 400px;
            animation: fadeIn 0.5s ease-in-out, slideIn 0.3s ease-out;
            flex: 1;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(-20px); }
            to { transform: translateY(0); }
        }

        .logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo-box {
            background-color: #007bff;
            color: #fff;
            font-size: 2rem;
            font-weight: 700;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            display: inline-block;
        }

        .logo-text {
            color: #333;
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            justify-content: center;
        }

        .tagline {
            color: #666;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        form {
            margin-top: 10px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #444;
            font-weight: 600;
            font-size: 0.95rem;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            transition: border-color 0.3s ease;
            font-size: 1rem;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .password-wrapper input {
            margin-bottom: 0;
            width: 100%;
            box-sizing: border-box;
        }

        .eye-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
            transition: color 0.3s ease;
        }

        .eye-icon:hover {
            color: #007bff;
        }

        .login-button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-top: 20px;
        }

        .login-button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .login-button:active {
            transform: translateY(0);
            background-color: #004080;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.9rem;
            margin-top: 10px;
            margin-bottom: 0;
            padding: 5px;
            background-color: #f8d7da;
            border-radius: 4px;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .image-box,
            .login-box {
                max-width: 100%;
            }

            .logo-box {
                font-size: 1.5rem;
                padding: 12px;
            }

            .logo-text {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="image-box">
            <img src="https://img.freepik.com/free-photo/girl-coloring-hand-with-blue-studio_23-2147851815.jpg?t=st=1746459730~exp=1746463330~hmac=30e1d20e067f8ff147859b324a2818ec32cd7fae3878dbc18240064363f52165&w=1380" alt="Illustration paiement scolarité">
        </div>

        <div class="login-box">
            <div class="logo">
                <div class="logo-box">MySchool<br>Pay</div>
                <div>
                    <h2 class="logo-text">
                        <i class="fas fa-graduation-cap"></i> 
                        Administrator Login
                    </h2>
                    <div class="tagline">Easy Payment</div>
                </div>
            </div>
            <form action="<?php echo e(route('connexion')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <label for="admin">Username</label>
                <input type="text" id="admin" name="admin" required value="<?php echo e(old('admin')); ?>">
                <?php $__errorArgs = ['admin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="error-message"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <label for="password">Password</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password">
                    <span class="eye-icon" id="togglePassword"><i class="fa-solid fa-eye-slash"></i></span>
                </div>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="error-message"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <button class="login-button" type="submit">Login</button>

                <?php if(session('error')): ?>
                    <p class="error-message"><?php echo e(session('error')); ?></p>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\BAKAYOKO 20\VirtualBox VMs\Desktop\learn_laravel\adninfees\resources\views/login.blade.php ENDPATH**/ ?>