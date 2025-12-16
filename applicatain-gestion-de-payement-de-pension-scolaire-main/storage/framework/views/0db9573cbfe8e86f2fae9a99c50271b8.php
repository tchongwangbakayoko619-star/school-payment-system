
<?php $__env->startSection('content'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <h2 class="h4 mb-0 text-center"><i class="fas fa-user-graduate me-2"></i>Register a New Student</h2>
                    </div>
                    
                    <div class="card-body p-4">
                        <!-- Success Message -->
                        <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php endif; ?>     
                        
                        <!-- Error Messages -->
                        <?php if($errors->any()): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <ul class="mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php endif; ?>
                        
                        <form action="<?php echo e(route('ajout')); ?>" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            <?php echo csrf_field(); ?>
                            
                            <div class="row">
                                <!-- First Column -->
                                <div class="col-md-6">
                                    <!-- First Name -->
                                    <div class="mb-3">
                                        <label for="firstName" class="form-label">First Name <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter first name" required>
                                        </div>
                                    </div>
                                    
                                    <!-- Last Name -->
                                    <div class="mb-3">
                                        <label for="lastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter last name" required>
                                        </div>
                                    </div>
                                    
                                    <!-- Image Upload -->
                                    <div class="mb-3">
                                        <label for="studentImage" class="form-label">Student Image</label>
                                        <div class="upload-area" onclick="document.getElementById('studentImage').click();">
                                            <div class="upload-content">
                                                <i class="fas fa-cloud-upload-alt fa-3x mb-3"></i>
                                                <p class="mb-1">Click to upload image</p>
                                                <p class="text-muted small">(JPG, PNG, max 2MB)</p>
                                            </div>
                                            <input type="file" id="studentImage" name="studentImage" accept="image/*" style="display: none;" onchange="previewImage(event)">
                                        </div>
                                        <div class="image-preview mt-2 text-center" id="imagePreviewContainer" style="display: none;">
                                            <img id="studentImagePreview" src="#" alt="Preview" class="img-thumbnail" style="max-height: 150px;">
                                            <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeImage()">
                                                <i class="fas fa-trash me-1"></i> Remove
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Birth Date -->
                                    <div class="mb-3">
                                        <label for="birthDate" class="form-label">Date of Birth</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            <input type="date" class="form-control" id="birthDate" name="birthDate">
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
                                            <input type="text" class="form-control" id="birthPlace" name="birthPlace" placeholder="Enter place of birth" required>
                                        </div>
                                    </div>
                                    
                                    <!-- Class Selection -->
                                    <div class="mb-3">
                                        <label for="className" class="form-label">Class <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-school"></i></span>
                                            <select class="form-select" id="className" name="className" required>
                                                <option value="" selected disabled>Select Class</option>
                                                <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($classe->id); ?>"><?php echo e($classe->nom); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Gender -->
                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                            <select class="form-select" id="gender" name="gender" required>
                                                <option value="" selected disabled>Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Parent Email -->
                                    
                                    
                                    <!-- Password -->
                                    
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2 mt-3">
                                <button type="submit" class="btn btn-primary btn-lg py-2">
                                    <i class="fas fa-user-plus me-2"></i> Register Student
                                </button>
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
        padding: 2rem;
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
    }
    
    .image-preview {
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
            padding: 1.5rem;
        }
    }
</style>

<script>
    // Image Preview Function
    function previewImage(event) {
        const reader = new FileReader();
        const preview = document.getElementById('studentImagePreview');
        const container = document.getElementById('imagePreviewContainer');
        
        reader.onload = function() {
            preview.src = reader.result;
            container.style.display = 'block';
        }
        
        reader.readAsDataURL(event.target.files[0]);
    }
    
    // Remove Image Function
    function removeImage() {
        document.getElementById('studentImage').value = '';
        document.getElementById('studentImagePreview').src = '#';
        document.getElementById('imagePreviewContainer').style.display = 'none';
    }
    
    // Toggle Password Visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('initialPassword');
        const icon = this.querySelector('i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
    
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\BAKAYOKO 20\VirtualBox VMs\Desktop\learn_laravel\adninfees\resources\views/add new students.blade.php ENDPATH**/ ?>