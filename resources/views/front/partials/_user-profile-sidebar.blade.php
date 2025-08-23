<div class="col-md-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="text-center">
                <img src="{{ asset(Auth::user()->profile->profile_image ?? 'default.png') }}" 
                     alt="Profile Image"
                     class="rounded-circle img-fluid" 
                     style="width: 120px; height: 120px; object-fit: cover;">

                <h5 class="mt-2">
                    {{ Auth::user()->profile->first_name ?? '' }} {{ Auth::user()->profile->last_name ?? '' }}
                </h5>
            </div>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div><i class="fas fa-user px-1"></i> Name</div>
                    <span class="fw-bold">{{ Auth::user()->name ?? '-' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div><i class="fas fa-user px-1"></i> Username</div>
                    <span class="fw-bold">{{ Auth::user()->username ?? '-' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div><i class="fas fa-envelope px-1"></i> Email</div>
                    <span class="fw-bold">{{ Auth::user()->email ?? '-' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div><i class="fas fa-phone px-1"></i> Phone</div>
                    <span class="fw-bold">{{ Auth::user()->phone ?? '-' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div><i class="fas fa-toggle-on px-1"></i> Status</div>
                    <span class="fw-bold">Active</span>
                </li>
            </ul>
        </div>
    </div>
</div>
