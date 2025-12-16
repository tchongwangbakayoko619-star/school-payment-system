@extends('index')

@section('content')
<div class="pt-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">

            {{-- Flash info --}}
            @if(session('info'))
                <div class="alert alert-info text-center" role="alert">
                    {{ session('info') }}
                </div>
            @endif

            <div class="col-md-9 text-center p-2">
                {{-- Logo --}}
                <div class="mb-4">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRf4aLGajTyYrLu2ArcpKaUVdGQms6wGdxVOA&s" alt="SecurePay Logo"
                         class="img-fluid" style="max-height:100px;">
                </div>
                <p class="text-muted">Secure Payment Solution</p>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm" style="border-top:4px solid #1976D2;">
                    <div class="card-header bg-info border-bottom">
                        <h3 class="text-center mb-0 text-primary">Payment Form</h3>
                    </div>
                    <div class="card-body">

                        {{-- Student info --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium text-secondary">Student:</label>
                            <input type="text" class="form-control bg-light" readonly
                                   value="{{ $student->lastname }} {{ $student->name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium text-secondary">Class:</label>
                            <input type="text" class="form-control bg-light" readonly
                                   value="{{ $classeName }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-medium text-secondary">Student ID:</label>
                            <input type="text" class="form-control bg-light" readonly
                                   value="{{ $student->id }}">
                        </div>

                        <hr>

                        {{-- Determine default amount by class --}}
                        @php
                            switch($classeName) {
                                case 'CM2': $defaultAmount = 60000; break;
                                case 'CM1': $defaultAmount = 50000; break;
                                case 'CE2': $defaultAmount = 30000; break;
                                case 'CE1': $defaultAmount = 20000; break;
                                case 'CP':  $defaultAmount = 10000; break;
                                default:    $defaultAmount = 5000;  break;
                            }
                        @endphp

                        <form method="POST" action="{{ route('cinetpay.payment') }}">
                            @csrf

                            {{-- Hidden for processing --}}
                            <input type="hidden" name="student_id" value="{{ $student->id }}">
                            <input type="hidden" name="cpm_designation"
                                   value="Fee payment for {{ $student->lastname }} {{ $student->name }} – Class {{ $classeName }}">

                            <div class="mb-4">
                                <label for="amount" class="form-label fw-medium text-primary">Amount:</label>
                                <input type="number" id="amount" name="amount"
                                       class="form-control" min="100"
                                       value="{{ old('amount', $defaultAmount) }}" required>
                                <div class="form-text text-secondary">Minimum amount: 100 XAF</div>
                            </div>

                            <div class="mb-4">
                                <label for="currency" class="form-label fw-medium text-primary">Currency:</label>
                                <select id="currency" name="currency" class="form-select" required>
                                    <option value="XAF">XAF – Central African CFA franc</option>
                                </select>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-lg px-5 btn-primary">
                                    <i class="fas fa-lock me-2"></i>Pay Now
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-4 text-secondary small">
                    <i class="fas fa-shield-alt me-1 text-primary"></i>100% Secure Payment
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
