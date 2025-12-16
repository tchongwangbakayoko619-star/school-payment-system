<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List - <?php echo e($classe->nom); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center; /* Centrer l'en-tête "N°" */
        }
        td:first-child {
            text-align: center; /* Centrer le numéro de l'élève */
        }
        .profile-img {
            width: 30px;
            height: 30px;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 5px;
            vertical-align: middle;
        }
        .payment-status {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Student List - Class <?php echo e($classe->nom); ?></h2>

    <table>
        <thead>
            <tr>
                <th>N°</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th>Place of Birth</th>
                
                
                <th>Payment</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $eleves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $eleve): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td><?php echo e($eleve->name); ?></td>
                    <td><?php echo e($eleve->lastname); ?></td>
                    <td><?php echo e($eleve->date_of_birth); ?></td>
                    <td><?php echo e($eleve->place_of_birth); ?></td>
                    
                    
                    <td class="payment-status">
                        <?php if($eleve->paid): ?>
                            Yes
                        <?php else: ?>
                            No
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <p>Generated on <?php echo e(now()->format('m/d/Y at H:i:s')); ?></p>
</body>
</html><?php /**PATH C:\Users\BAKAYOKO 20\VirtualBox VMs\Desktop\learn_laravel\adninfees\resources\views/students_list.blade.php ENDPATH**/ ?>