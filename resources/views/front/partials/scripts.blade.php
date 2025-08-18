<script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('front/js/all.min.js') }}"></script>
<script src="{{ asset('front/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('front/js/aos.js') }}"></script>
<script src="{{ asset('front/js/fslightbox.js') }}"></script>
<script src="{{ asset('front/js/purecounter_vanilla.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('front/js/custom.js') }}"></script>

<script>
    @if (session('success'))
        document.addEventListener("DOMContentLoaded", function() {
            var notyf = new Notyf({
                duration: 4000,
                position: {
                    x: 'right',
                    y: 'top'
                }
            });
            notyf.success("{{ session('success') }}");
        });
    @endif

    @if (session('error'))
        document.addEventListener("DOMContentLoaded", function() {
            var notyf = new Notyf({
                duration: 4000,
                position: {
                    x: 'right',
                    y: 'top'
                }
            });
            notyf.error("{{ session('error') }}");
        });
    @endif
</script>

@yield('js')
