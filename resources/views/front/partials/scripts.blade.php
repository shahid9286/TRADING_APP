<script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('front/js/all.min.js') }}"></script>
<script src="{{ asset('front/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('front/js/aos.js') }}"></script>
<script src="{{ asset('front/js/fslightbox.js') }}"></script>
<script src="{{ asset('front/js/purecounter_vanilla.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('front/js/custom.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            pagingType: 'simple_numbers',
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search here...",
                lengthMenu: "Show _MENU_ entries"
            }
        });
    });
</script>
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
            notyf.success("{!! session('success') !!}");
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
            notyf.error("{!! session('error') !!}");
        });
    @endif
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var investmentModal = document.getElementById('investmentDetail');
        investmentModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;

            // Extract values
            var amount = button.getAttribute('data-amount');
            var startDate = button.getAttribute('data-start_date');
            var expiryDate = button.getAttribute('data-expiry_date');
            var status = button.getAttribute('data-status');
            var trxId = button.getAttribute('data-transaction_id');
            var screenshot = button.getAttribute('data-screenshot');
            var activeStatus = button.getAttribute('data-active_status');

            // Fill modal
            document.getElementById('modal-amount').textContent = amount;
            document.getElementById('modal-start-date').textContent = startDate;
            document.getElementById('modal-expiry-date').textContent = expiryDate;
            document.getElementById('modal-transaction-id').textContent = trxId;

            // Status badge
            var statusEl = document.getElementById('modal-status');
            statusEl.textContent = status.charAt(0).toUpperCase() + status.slice(1);
            statusEl.className = 'badge ' +
                (status === 'approved' ? 'bg-success' : status === 'pending' ? 'bg-warning' :
                    'bg-danger');

            // Active status badge
            var activeEl = document.getElementById('modal-active-status');
            activeEl.textContent = activeStatus.charAt(0).toUpperCase() + activeStatus.slice(1);
            activeEl.className = 'badge ' + (activeStatus === 'active' ? 'bg-success' : 'bg-secondary');

            // Screenshot
            var screenshotHtml = `<a href="${screenshot}" target="_blank">
                                    <img src="${screenshot}" alt="Screenshot" class="img-fluid rounded" style="max-height: 150px;">
                                  </a>`;
            document.getElementById('modal-screenshot').innerHTML = screenshotHtml;
        });
    });
</script>
@yield('js')
