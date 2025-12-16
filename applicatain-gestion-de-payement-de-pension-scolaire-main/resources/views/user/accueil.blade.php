@extends('user.home')
@section('content')
<main class="container mt-5 pt-4">

    <!-- Welcome Section -->
    <section class="welcome-section text-center py-5 mb-5 rounded shadow-sm bg-light">
        <h1 class="display-5 fw-bold">Welcome to MyPaySchool!</h1>
        <p class="lead text-muted col-lg-8 mx-auto">Your personal space to easily manage tuition and invest in the future.</p>
    </section>

    <!-- Quick Access Section -->
    <section class="quick-access mb-5">
        <h2 class="text-center fw-semibold">Quick Access</h2>
        <div class="row g-4 justify-content-center">

            <!-- Card Pay Tuition -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm text-center custom-card card-pay">
                    <div class="card-img-overlay">
                         <div class="card-icon mb-3">
                            <i class="fas fa-credit-card fa-3x"></i>
                        </div>
                        <h3 class="card-title h5 fw-bold">Pay Tuition</h3>
                        <p class="card-text small d-none d-md-block">Make your payments securely.</p>
                        <a href="#payer" class="btn btn-light stretched-link mt-2">Access</a>
                    </div>
                </div>
            </div>

            <!-- Card Payment History -->
             <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm text-center custom-card card-history">
                     <div class="card-img-overlay">
                        <div class="card-icon mb-3">
                            <i class="fas fa-history fa-3x"></i>
                        </div>
                        <h3 class="card-title h5 fw-bold">Payment History</h3>
                        <p class="card-text small d-none d-md-block">Check all your transactions.</p>
                        <a href="#paiements" class="btn btn-light stretched-link mt-2">View</a>
                    </div>
                </div>
            </div>

            <!-- Card My Information -->
            <div class="col-md-6 col-lg-4">
               <div class="card h-100 shadow-sm text-center custom-card card-info">
                     <div class="card-img-overlay">
                         <div class="card-icon mb-3">
                            <i class="fas fa-user-edit fa-3x"></i>
                        </div>
                        <h3 class="card-title h5 fw-bold">My Information</h3>
                        <p class="card-text small d-none d-md-block">Update your personal data.</p>
                        <a href="{{ route('student.show', ['id' => $id]) }}" class="btn btn-light stretched-link mt-2">Update</a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Illustration Section -->
    <section class="illustration-section mb-5">
         <div class="row align-items-center bg-white p-4 p-lg-5 rounded shadow-lg"> 
             <div class="col-lg-6 order-lg-2 text-center mb-4 mb-lg-0"> 
                 <img src="{{asset('img/lovely-girl-sitting-stack-books.png') }}" alt="Happy students engaged in studies" class="img-fluid rounded shadow-sm illustration-image">
             </div>
             <div class="col-lg-6 order-lg-1"> 
                <h2 class="fw-bold mb-3 text-primary display-6">Invest in Education, Build the Future</h2>
                <p class="text-secondary lead mb-4">MyPaySchool helps you simplify tuition management, empowering every student to reach their full potential.</p>
                <p class="text-muted">Focus on academic success while we handle the administration for you.</p>
             </div>
         </div>
    </section>

</main>
@endsection