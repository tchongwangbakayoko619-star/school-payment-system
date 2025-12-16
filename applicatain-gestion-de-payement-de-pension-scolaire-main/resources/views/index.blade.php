<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySchoolPay Admin Menu</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Make sure this path is correct for your project structure -->
    <link rel="stylesheet" href="{{ asset('css/inde.css') }}">

    <style>
        /* --- Styles for Logout Confirmation Popup --- */
        .logout-confirm-popup {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%); /* Center the popup */
            background-color: white;
            padding: 30px;
            border: 1px solid #ccc;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            z-index: 1050; /* Ensure it's above other content */
            border-radius: 8px;
            text-align: center;
            min-width: 300px; /* Optional: set a minimum width */
        }

        .logout-confirm-popup p {
            margin-bottom: 20px; /* Space below text */
            font-size: 1.1em;
        }

        .logout-confirm-popup .btn {
            margin: 0 10px; /* Space between buttons */
        }

        /* Optional: Dim background when popup is open */
        .logout-confirm-overlay {
             display: none; /* Hidden by default */
             position: fixed;
             top: 0;
             left: 0;
             width: 100%;
             height: 100%;
             background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
             z-index: 1040; /* Below popup, above content */
        }

        /* --- Styles for Developer Info Footer --- */
        .developer-info {
            background-color: #f8f9fa;
            color: #6c757d;
            padding: 20px 0;
            text-align: center;
            font-size: 0.9em;
            border-top: 1px solid #dee2e6;
            margin-top: 30px; /* Adjust as needed */
        }

        .developer-info .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .developer-info a {
            color: #007bff;
            text-decoration: none;
        }

        .developer-info a:hover {
            text-decoration: underline;
        }

        .developer-info small {
            color: #adb5bd;
        }
        /* Your existing inde.css styles */
        /* .navbar-admin { ... } */
        /* .hat-icon { ... } */
    </style>
</head>
<body>

<!-- Main Menu -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-admin sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ Route('home') }}"> <!-- Link logo to home -->
            <i class="fas fa-graduation-cap hat-icon"></i>
            <span>MySchoolPay</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNavbar">
            <!-- Navigation Menu -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"> <!-- Added mb-2 mb-lg-0 for better spacing on collapse -->
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ Route('home') }}"> <!-- Dynamic active class -->
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('afficher') ? 'active' : '' }}" href="{{ Route('afficher') }}"> <!-- Dynamic active class -->
                        <i class="fas fa-list"></i>
                        Students List
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('add') ? 'active' : '' }}" href="{{ Route('add') }}"> <!-- Dynamic active class -->
                        <i class="fas fa-user-plus"></i>
                        Add Student
                    </a>
                </li>
            </ul>

            <!-- User Menu -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#"> <!-- Placeholder for notifications -->
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-danger badge-notification">5+</span>
                    </a>
                </li>
                <li class="nav-item">
                    <!-- MODIFIED: Changed link to a button/link acting as a trigger -->
                    <a class="nav-link" href="#" id="logout-trigger">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<!-- Logout Confirmation Popup -->
<div class="logout-confirm-overlay" id="logout-overlay"></div>
<div class="logout-confirm-popup" id="logout-confirmation">
    <p>Are you sure you want to log out?</p>
    <!-- The form that will be submitted -->
    <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: inline;">
        @csrf <!-- CSRF Token -->
        <button type="submit" class="btn btn-danger">
            <i class="fas fa-check"></i> Yes, Logout
        </button>
    </form>
    <button type="button" class="btn btn-secondary" id="cancel-logout">
        <i class="fas fa-times"></i> Cancel
    </button>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS for Logout Confirmation -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const logoutTrigger = document.getElementById('logout-trigger');
        const logoutConfirmation = document.getElementById('logout-confirmation');
        const cancelLogoutButton = document.getElementById('cancel-logout');
        const logoutOverlay = document.getElementById('logout-overlay'); // Get overlay

        if (logoutTrigger && logoutConfirmation && cancelLogoutButton && logoutOverlay) {
            // Show confirmation when trigger is clicked
            logoutTrigger.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default link behavior
                logoutConfirmation.style.display = 'block'; // Show popup
                logoutOverlay.style.display = 'block'; // Show overlay
            });

            // Hide confirmation when cancel is clicked
            cancelLogoutButton.addEventListener('click', function() {
                logoutConfirmation.style.display = 'none'; // Hide popup
                logoutOverlay.style.display = 'none'; // Hide overlay
            });

            // Hide confirmation when clicking on the overlay
            logoutOverlay.addEventListener('click', function() {
                logoutConfirmation.style.display = 'none'; // Hide popup
                logoutOverlay.style.display = 'none'; // Hide overlay
            });

        } else {
            console.error('Logout confirmation elements not found!');
        }
    });
</script>

<footer class="developer-info">
    <div class="container">
        <p>© 2025 MySchoolPay. Developed by <a href="https://github.com/TCHONGWANG/TCHONGWANG" target="_blank" rel="noopener noreferrer">Tchongwang Bakayoko</a>.</p>
        <p>Contact: <a href="mailto:tchongwangnathan@gmail.com">tchongwangnathan@gmail.com</a></p>
        <p><small>Version 1.0</small></p>
    </div>
</footer>

</body>
</html>