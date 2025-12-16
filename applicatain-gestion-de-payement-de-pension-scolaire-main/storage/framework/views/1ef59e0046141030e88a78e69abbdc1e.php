
<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/show.css')); ?>">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white py-3">
                        <h2 class="h5 mb-0 text-center"><i class="fas fa-users me-2"></i>List of Students by Class</h2>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?php echo e(route('afficheclass.post')); ?>" method="GET" class="needs-validation" novalidate>
                            <?php echo csrf_field(); ?>
                            <div class="mb-4">
                                <label for="classeSelect" class="form-label fw-semibold text-muted"><i class="fas fa-graduation-cap me-2"></i>Select Class</label>
                                <select id="classeSelect" class="form-select form-select-lg border-2 border-primary" name="classeSelect" required>
                                    <option value="" disabled selected>Choose a class...</option>
                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($classe->id); ?>"><?php echo e($classe->nom); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a class
                                </div>
                            </div>
            
                            <button type="submit" class="btn btn-primary btn-lg w-100 py-2 fw-bold">
                                <i class="fas fa-eye me-2"></i> View Students
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  

  
    

    <script>
        // Form validation
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
<?php echo $__env->make('index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\BAKAYOKO 20\VirtualBox VMs\Desktop\learn_laravel\adninfees\resources\views/afficher.blade.php ENDPATH**/ ?>