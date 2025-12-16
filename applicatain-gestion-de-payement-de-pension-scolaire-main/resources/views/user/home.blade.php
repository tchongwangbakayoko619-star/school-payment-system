<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyPaySchool - Home</title>

    @php
        $studentId = request()->route('id') ?? 
                     (auth()->check() ? auth()->user()->student_id : null);
    @endphp
   
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Google Fonts (Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-graduation-cap me-2"></i>MyPaySchool
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#userNavbar" aria-controls="userNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="userNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{Route('user.home')}}"><i class="fas fa-home me-1 d-lg-none d-xl-inline-block"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        @php
                            // Solution robuste avec fallback sécurisé
                            $studentId = request()->route('id') ?? 
                                        (auth()->check() ? auth()->user()->student_id : null);
                        @endphp
                    
                        @if($studentId)
                            <a class="nav-link" href="{{ route('student.show', ['id' => $studentId]) }}">
                                <i class="fas fa-user-circle me-1 d-lg-none d-xl-inline-block"></i> My Information
                            </a>
                        @else
                            <span class="nav-link text-muted" style="cursor: not-allowed; opacity: 0.5;">
                                <i class="fas fa-user-circle me-1 d-lg-none d-xl-inline-block"></i> My Information
                            </span>
                        @endif
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#paiements"><i class="fas fa-receipt me-1 d-lg-none d-xl-inline-block"></i> My Payments</a>
                    </li>
                    <li class="nav-item mx-lg-2 my-2 my-lg-0">
                        <a class="btn btn-warning btn-sm text-dark px-3" href="#payer">
                            <i class="fas fa-credit-card me-1"></i> Pay Tuition
                        </a>
                    </li>
                    <!-- Account Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-cog me-1 d-lg-none d-xl-inline-block"></i> Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#parametres"><i class="fas fa-cog fa-fw me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#deconnexion"><i class="fas fa-sign-out-alt fa-fw me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
 @yield('content')

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-auto"> 
        <div class="container">
            <p class="mb-1">© 2025 MyPaySchool. All rights reserved.</p>
            <p class="small mb-0">Designed to simplify your educational journey.</p>
        </div>
    </footer>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
