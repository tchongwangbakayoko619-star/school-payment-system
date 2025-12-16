
<?php $__env->startSection('content'); ?>
    
    <style>
        #studentsTableContainer {
            max-width: 1100px;
            margin: auto;
            background-color: #f9f9f9;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            vertical-align: middle;
            padding: 12px;
        }

        .table-primary {
            background-color: #007bff;
            color: white;
        }

        .profile-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border: 2px solid #007bff;
        }

        .btn {
            border-radius: 20px;
            padding: 5px 12px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        /* Style to keep action buttons/forms inline */
        .action-item {
             display: inline-block;
             margin-right: 5px; /* Add some spacing */
             margin-bottom: 5px; /* Add spacing for wrapping on small screens */
        }
        /* Ensure forms inside table cells don't cause extra space */
        td form {
            margin-bottom: 0;
        }
    </style>

    <div id="studentsTableContainer" class="container-fluid my-5 p-4 rounded shadow bg-white">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 text-center text-md-start">
            <h2 class="mb-3 mb-md-0">Students of Class <span id="className" class="text-primary"><?php echo e($classeNom); ?></span></h2>
            <a href="<?php echo e(route('home')); ?>" class="btn btn-outline-primary mt-2 mt-md-0"><i class="bi bi-house-door me-2"></i>Home</a>
        </div>

        <div class="mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Search students...">
        </div>

        <div class="table-responsive overflow-auto">
            <table class="table table-hover text-center align-middle">
                <thead>
                    <tr>
                        <th>Profile</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date of Birth</th>
                        <th>Place of Birth</th>
                        <th>Payment</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
                <tbody id="studentsTableBody"> 
                    <?php if($eleves->count() > 0): ?>
                        <?php $__currentLoopData = $eleves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eleve): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <?php if($eleve->image_path): ?>
                                        <img src="<?php echo e(asset('storage/' . $eleve->image_path)); ?>" class="rounded-circle profile-img">
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('img/account-grey-icon.png')); ?>" class="rounded-circle profile-img">
                                    <?php endif; ?>
                                </td>
                                
                                <td><?php echo e($eleve->name); ?></td>
                                <td><?php echo e($eleve->lastname); ?></td>
                                <td><?php echo e($eleve->date_of_birth); ?></td>
                                <td><?php echo e($eleve->place_of_birth); ?></td>
                                <td>
                                    
                                    <?php if($eleve->paid): ?>
                                        <span class="badge bg-success">Paid</span>
                                        
                                        
                                    <?php else: ?>
                                        <span class="badge bg-danger">Not Paid</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    
                                    <a href="<?php echo e(route('edit-student', $eleve->id)); ?>" class="btn btn-sm btn-warning action-item">Edit</a>

                                    
                                    <button type="button" class="btn btn-sm btn-danger btn-delete-student action-item" data-bs-toggle="modal" data-bs-target="#deleteStudentModal" data-student-id="<?php echo e($eleve->id); ?>" data-student-name="<?php echo e($eleve->name); ?> <?php echo e($eleve->lastname); ?>">
                                        Delete
                                    </button>

                                    
                                    <?php if(!$eleve->paid): ?>
                                    <form class="action-item" action="<?php echo e(route('cinetpay.index', $eleve->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?> 
                                        <button type="submit" class="btn btn-sm btn-success">Mark as Paid</button>
                                    </form>
                                    
                                    <?php endif; ?>

                                    
                                    <form id="deleteForm<?php echo e($eleve->id); ?>" action="/delete-student/<?php echo e($eleve->id); ?>" method="POST" class="d-none">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">No students found for this class.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <?php echo e($eleves->appends(['classeSelect' => $selectedClass])->links('vendor.pagination.bootstrap-5')); ?>


        
        <a id="downloadListBtn" href="/download-list/<?php echo e($selectedClass); ?>" class="btn btn-primary d-block mx-auto mt-4">Download List</a>

        
        <div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="deleteStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark" id="deleteStudentModalLabel">Delete Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-dark">
                        Are you sure you want to delete <span id="studentNameToDelete" class="fw-bold"></span>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteStudent">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteStudentModal = document.getElementById('deleteStudentModal');
            const confirmDeleteButton = document.getElementById('confirmDeleteStudent');
            const studentNameToDelete = document.getElementById('studentNameToDelete');
            let studentIdToDelete;
            const searchInput = document.getElementById('searchInput');
            const studentsTableBody = document.getElementById('studentsTableBody');
            const studentRows = studentsTableBody.querySelectorAll('tr');

            // Modal for delete confirmation
            if (deleteStudentModal) {
                deleteStudentModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    studentIdToDelete = button.getAttribute('data-student-id');
                    const studentName = button.getAttribute('data-student-name');
                    studentNameToDelete.textContent = studentName;
                });
            }

            if (confirmDeleteButton) {
                confirmDeleteButton.addEventListener('click', function() {
                    if (studentIdToDelete) {
                        const deleteForm = document.getElementById(`deleteForm${studentIdToDelete}`);
                         if(deleteForm) {
                             deleteForm.submit();
                         }
                    }
                });
            }

            // Search functionality
            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    const searchTerm = searchInput.value.toLowerCase().trim();

                    studentRows.forEach(row => {
                        // Check if it's a data row (ignore potential header/footer rows if any)
                        if (row.cells.length > 1) {
                            const rowText = row.textContent.toLowerCase();
                            row.style.display = rowText.includes(searchTerm) ? '' : 'none';
                        }
                    });
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\BAKAYOKO 20\VirtualBox VMs\Desktop\learn_laravel\adninfees\resources\views/afficheclass.blade.php ENDPATH**/ ?>