<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile - MyPaySchool</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        .student-photo-container {
            max-width: 250px;
            margin: 0 auto;
        }
        
        .student-photo-container img {
            border: 3px solid #f8f9fa;
            transition: transform 0.3s ease;
            max-height: 300px;
            object-fit: cover;
        }
        
        .student-photo-container img:hover {
            transform: scale(1.03);
        }
        
        .detail-item {
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
        }
        
        .detail-value {
            color: #333;
            margin-left: 0.5rem;
        }
        
        .card {
            border-radius: 0.5rem;
            overflow: hidden;
            margin-top: 20px;
        }
        
        .card-header {
            border-radius: 0 !important;
        }
        
        body {
            background-color: #f8f9fa;
            padding-bottom: 50px;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1 class="h4 mb-0">Student Profile: {{ $student->name }} {{ $student->lastname }}</h1>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center mb-4 mb-md-0">
                        <div class="student-photo-container">
                            @if($student->image_path)
                                <img src="{{ asset('storage/' . $student->image_path) }}" 
                                     alt="Photo of {{ $student->name }}"
                                     class="img-fluid rounded shadow">
                            @else
                                <img src="{{ asset('images/default-student.png') }}" 
                                     alt="Default student photo"
                                     class="img-fluid rounded shadow">
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="student-details">
                            <div class="detail-item mb-3">
                                <strong class="text-muted">Date of Birth:</strong> 
                                <span class="detail-value">{{ $student->date_of_birth }}</span>
                            </div>
                            <div class="detail-item mb-3">
                                <strong class="text-muted">Place of Birth:</strong> 
                                <span class="detail-value">{{ $student->place_of_birth }}</span>
                            </div>
                            <div class="detail-item mb-3">
                                <strong class="text-muted">Gender:</strong> 
                                <span class="detail-value">{{ $student->gender }}</span>
                            </div>
                            <div class="detail-item mb-3">
                                <strong class="text-muted">Parent Email:</strong> 
                                <a href="mailto:{{ $student->parent_email }}" class="detail-value">
                                    {{ $student->parent_email }}
                                </a>
                            </div>
                            <div class="detail-item mb-3">
                                <strong class="text-muted">Payment Status:</strong> 
                                <span class="badge {{ $student->paid ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ $student->paid ? 'Paid' : 'Pending' }}
                                </span>
                            </div>
                            <div class="detail-item mb-3">
                                <strong class="text-muted">Class:</strong> 
                                <span class="detail-value">{{ $classe->nom }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer bg-light">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>