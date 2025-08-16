@extends('front.layouts.master')
@section('title', 'Dashboard')

@section('content')
    <section class="contact-section d-flex align-items-center justify-content-center"
             style="background-color: #071700; min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    
                    <label for="referralLink" class="form-label fw-bold mb-3 text-white fs-4">
                        Your Referral Link
                    </label>

                    <div class="input-group shadow-sm">
                        <input type="text" 
                               id="referralLink"
                               class="form-control text-center"
                               value="{{ url('/') }}/{{ Auth::user()->username }}"
                               readonly>
                        <button class="btn btn-primary" id="copyBtn" type="button">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>

                    <small id="copyMsg" class="text-success d-none mt-3">
                        ✅ Copied to clipboard!
                    </small>

                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const copyBtn = document.getElementById('copyBtn');
            const input = document.getElementById('referralLink');
            const msg = document.getElementById('copyMsg');

            copyBtn.addEventListener('click', function () {
                input.select();
                input.setSelectionRange(0, 99999); // For mobile
                navigator.clipboard.writeText(input.value).then(() => {
                    msg.classList.remove('d-none');
                    setTimeout(() => msg.classList.add('d-none'), 2000);
                });
            });
        });
    </script>
    @endpush
@endsection
