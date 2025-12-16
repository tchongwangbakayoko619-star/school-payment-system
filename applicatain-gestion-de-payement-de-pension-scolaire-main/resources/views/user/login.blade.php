<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Parent Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/loginuser.css') }}" />
</head>
<body>
    @if ($errors->any())
    <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 20px; border: 1px solid #f5c6cb; border-radius: 5px;">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    
@endif
@if (session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border: 1px solid #c3e6cb; border-radius: 5px;">
        {{ session('success') }}
    </div>
@endif

    <div class="card d-flex flex-row flex-wrap">
        <div class="col-md-6 d-none d-md-block">
            <img src="{{ asset('img/group-african-kids-paying-attention-class.jpg') }}" alt="Login" class="img-fluid w-100 h-100">
        </div>

        <div class="col-md-6 form-container">
            <h2 class="mb-4">Parent Login</h2>
            <div id="message-box"></div>
            <form action="{{ route('verifier') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="info@example.com" required aria-describedby="emailHelp">
                    <div class="invalid-feedback">Please enter a valid email.</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" required minlength="6">
                        <span class="fas fa-eye toggle-password" id="toggle-password"></span>
                    </div>
                    <div class="invalid-feedback">Password is required (min 6 characters).</div>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember-me">
                    <label class="form-check-label" for="remember-me">Remember me</label>
                </div>
                <div class="mb-3">
                    <a href="{{Route('forgot-password')}}" class="text-decoration-none">Forgot Password?</a>
                </div>
                <button type="submit" class="btn btn-success w-100">Login</button>
                <script src="{{asset('js/userlogin.js')}}"></script>
            </form>
        </div>
    </div>
   
</body>
</html>
