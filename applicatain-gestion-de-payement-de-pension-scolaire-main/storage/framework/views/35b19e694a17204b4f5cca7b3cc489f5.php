
<?php $__env->startSection('content'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <h2 class="mb-4">Dashboard</h2>

        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h6 class="m-0 font-weight-bold">Number of Students by Class and Gender</h6>
                    </div>
                    <div class="card-body">
                        <?php if($studentsByClassAndGender->isNotEmpty()): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Class</th>
                                            <th class="text-center">Boys</th>
                                            <th class="text-center">Girls</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $studentsByClassAndGender; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $className => $genderCounts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($className); ?></td>
                                                <td class="text-center"><?php echo e($genderCounts['male'] ?? 0); ?></td>
                                                <td class="text-center"><?php echo e($genderCounts['female'] ?? 0); ?></td>
                                                <td class="text-center font-weight-bold"><?php echo e(($genderCounts['male'] ?? 0) + ($genderCounts['female'] ?? 0)); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">No student data available by class.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header bg-success text-white py-3">
                        <h6 class="m-0 font-weight-bold">Pension Payment Status by Gender</h6>
                    </div>
                    <div class="card-body">
                        <?php if(!empty($paymentStatusByGender)): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Gender</th>
                                            <th class="text-center text-success">Paid</th>
                                            <th class="text-center text-danger">Unpaid</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Boys</td>
                                            <td class="text-center"><?php echo e($paymentStatusByGender['male']['paid'] ?? 0); ?></td>
                                            <td class="text-center"><?php echo e($paymentStatusByGender['male']['unpaid'] ?? 0); ?></td>
                                            <td class="text-center font-weight-bold"><?php echo e(($paymentStatusByGender['male']['paid'] ?? 0) + ($paymentStatusByGender['male']['unpaid'] ?? 0)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Girls</td>
                                            <td class="text-center"><?php echo e($paymentStatusByGender['female']['paid'] ?? 0); ?></td>
                                            <td class="text-center"><?php echo e($paymentStatusByGender['female']['unpaid'] ?? 0); ?></td>
                                            <td class="text-center font-weight-bold"><?php echo e(($paymentStatusByGender['female']['paid'] ?? 0) + ($paymentStatusByGender['female']['unpaid'] ?? 0)); ?></td>
                                        </tr>
                                        <tr class="font-weight-bold">
                                            <th>Total</th>
                                            <th class="text-center"><?php echo e(($paymentStatusByGender['male']['paid'] ?? 0) + ($paymentStatusByGender['female']['paid'] ?? 0)); ?></th>
                                            <th class="text-center"><?php echo e(($paymentStatusByGender['male']['unpaid'] ?? 0) + ($paymentStatusByGender['female']['unpaid'] ?? 0)); ?></th>
                                            <th class="text-center"><?php echo e(($paymentStatusByGender['male']['paid'] ?? 0) + ($paymentStatusByGender['male']['unpaid'] ?? 0) + ($paymentStatusByGender['female']['paid'] ?? 0) + ($paymentStatusByGender['female']['unpaid'] ?? 0)); ?></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">No payment data available.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

       
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<style>
   
    /* Improved dashboard styles */
    .content h2 {
        color: #333;
    }

    .card {
        border: none;
        border-radius: 0.5rem;
        box-shadow: 0 0.15rem 0.25rem rgba(0, 0, 0, 0.05);
    }

    .card-header {
        font-weight: bold;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card-header h6 {
        margin: 0;
    }

    .card-body {
        padding: 1.5rem;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }

    .table-bordered {
        border: 1px solid #dee2e6;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6;
    }

    .table-bordered thead th,
    .table-bordered thead td {
        border-bottom-width: 2px;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.075);
    }

    .thead-light th {
        background-color: #e9ecef;
        color: #495057;
    }

    .text-muted {
        color: #6c757d !important;
    }

    .font-weight-bold {
        font-weight: bold !important;
    }

    .text-center {
        text-align: center !important;
    }

    .text-success {
        color: #28a745 !important;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    /* Card header background colors */
    .bg-primary {
        background-color: #007bff !important;
    }

    .bg-success {
        background-color: #28a745 !important;
    }

    .text-white {
        color: #fff !important;
    }

    .shadow {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\BAKAYOKO 20\VirtualBox VMs\Desktop\learn_laravel\adninfees\resources\views/home.blade.php ENDPATH**/ ?>