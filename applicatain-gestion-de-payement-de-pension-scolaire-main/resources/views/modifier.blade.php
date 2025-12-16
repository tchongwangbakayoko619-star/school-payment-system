@extends('index')
@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <h2 class="h4 mb-0 text-center"><i class="fas fa-user-edit me-2"></i>Edit Student Information</h2>
                    </div>
                    
                    <div class="card-body p-4">
                        <!-- Success Message -->
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        
                        <!-- Error Messages -->
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        
                        <form action="{{ route('update-student', $student->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <!-- First Column -->
                                <div class="col-md-6">
                                    <!-- First Name -->
                                    <div class="mb-3">
                                        <label for="firstName" class="form-label">First Name <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" id="firstName" name="firstName" 
                                                   value="{{ old('firstName', $student->name) }}" required>
                                        </div>
                                    </div>
                                    
                                    <!-- Last Name -->
                                    <div class="mb-3">
                                        <label for="lastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" id="lastName" name="lastName" 
                                                   value="{{ old('lastName', $student->lastname) }}" required>
                                        </div>
                                    </div>
                                    
                                    <!-- Image Upload -->
                                    <div class="mb-3">
                                        <label for="studentImage" class="form-label">Student Image</label>
                                        <div class="upload-area" onclick="document.getElementById('studentImage').click();">
                                            <div class="upload-content">
                                                <i class="fas fa-camera me-2"></i>
                                                <span>Change Image</span>
                                            </div>
                                            <input type="file" id="studentImage" name="studentImage" 
                                                   accept="image/*" style="display: none;" onchange="previewImage(event)">
                                        </div>
                                        <div class="current-image mt-3 text-center">
                                            <img id="studentImagePreview" 
                                                 src="{{ $student->image_path ? asset('storage/' . $student->image_path) : asset('img/default-student.png') }}" 
                                                 alt="Current Image" class="img-thumbnail" style="max-height: 150px;">
                                            <p class="text-muted small mt-2">Current Image</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Birth Date -->
                                    <div class="mb-3">
                                        <label for="birthDate" class="form-label">Date of Birth</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            <input type="date" class="form-control" id="birthDate" name="birthDate" 
                                                   value="{{ old('birthDate', $student->date_of_birth) }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Second Column -->
                                <div class="col-md-6">
                                    <!-- Birth Place -->
                                    <div class="mb-3">
                                        <label for="birthPlace" class="form-label">Place of Birth <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                            <input type="text" class="form-control" id="birthPlace" name="birthPlace" 
                                                   value="{{ old('birthPlace', $student->place_of_birth) }}" required>
                                        </div>
                                    </div>
                                    
                                    <!-- Class Selection -->
                                    <div class="mb-3">
                                        <label for="className" class="form-label">Class <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-school"></i></span>
                                            <select class="form-select" id="className" name="className" required>
                                                <option value="">Select Class</option>
                                                @foreach ($classes as $classe)
                                                <option value="{{ $classe->id }}" 
                                                    {{ old('className', $student->class_id) == $classe->id ? 'selected' : '' }}>
                                                    {{ $classe->nom }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Gender -->
                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                            <select class="form-select" id="gender" name="gender" required>
                                                <option value="">Select Gender</option>
                                                <option value="male" {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                                <option value="other" {{ old('gender', $student->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Parent Email -->
                                    {{-- <div class="mb-4">
                                        <label for="parentEmail" class="form-label">Parent's Email <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input type="email" class="form-control" id="parentEmail" name="parentEmail" 
                                                   value="{{ old('parentEmail', $student->parent_email) }}" required>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg py-2">
                                    <i class="fas fa-save me-2"></i> Update Student
                                </button>
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --accent-color: #4895ef;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    }
    
    .card {
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .upload-area {
        border: 2px dashed #dee2e6;
        border-radius: 10px;
        padding: 1rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
    }
    
    .upload-area:hover {
        border-color: var(--primary-color);
        background-color: rgba(67, 97, 238, 0.05);
    }
    
    .upload-content {
        color: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .current-image {
        border: 1px solid #dee2e6;
        border-radius: 10px;
        padding: 15px;
        background-color: #f8f9fa;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(67, 97, 238, 0.3);
    }
    
    .input-group-text {
        background-color: #f8f9fa;
        color: var(--primary-color);
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
    }
    
    .alert {
        border-radius: 10px;
    }
    
    @media (max-width: 768px) {
        .card {
            margin-top: 1rem;
        }
        
        .upload-area {
            padding: 1rem;
        }
    }
</style>

<script>
    // Image Preview Function
    function previewImage(event) {
        const reader = new FileReader();
        const preview = document.getElementById('studentImagePreview');
        
        reader.onload = function() {
            preview.src = reader.result;
        }
        
        reader.readAsDataURL(event.target.files[0]);
    }
    
    // Form Validation
    (function () {
        'use strict'
        
        var forms = document.querySelectorAll('.needs-validation')
        
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endsection