@extends('front.layouts.master')
@section('title', 'Dashboard')



@section('content')
    <section class="contact-section d-flex align-items-center justify-content-center"
        style="background-color: #071700; min-height: 100vh;">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="row justify-content-center">
                <div class="col">

                    <div class="card shadow-lg p-4 text-center" style="border-radius: 12px;">
                        <h2 class="mb-3 text-warning">⚠ Account Blocked</h2>
                        <p class="text-white">
                            Your account has been temporarily <strong>blocked</strong> by the administrator.
                            You cannot access the system until your account is approved.
                        </p>
                        <p class="fw-bold mt-3">
                            If you believe this is a mistake, please contact the administrator for further assistance.
                        </p>

                        <a href="#" class="trk-btn trk-btn--border trk-btn--primary d-block mt-4">Contact Admin</a>
                    </div>

                </div>
            </div>
        </div>
    </section>


@endsection

@section('js')

<script>
    // 🔄 Auto-check every 5 seconds if account is approved
    setInterval(() => {
        fetch("{{ route('check.status') }}")
            .then(res => res.json())
            .then(data => {
                if (data.status === 'approved') {
                    window.location.href = "{{ route('user.dashboard') }}";
                }
            });
    }, 5000);
</script>

@endsection
