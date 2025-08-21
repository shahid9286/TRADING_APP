<script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/bootstrap-taginput/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jquery-menu-editor.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/bootstrap-iconpicker/bootstrap-iconpicker.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/bootstrap-switch/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/data-table/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/data-table/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/data-table/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/data-table/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/data-table/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/data-table/buttons.bootstrap4.min.js') }}"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="{{ asset('assets/admin/js/adminlte.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom2.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
{{-- date range --}}
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const withdrawalModal = document.getElementById('withdrawalRequestDetail');
        withdrawalModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;

            // Extract data attributes
            const bankName = button.getAttribute('data-bank_name');
            const accountNo = button.getAttribute('data-account_no');
            const requestedAmount = button.getAttribute('data-requested_amount');
            const requestDate = button.getAttribute('data-request_date');
            const status = button.getAttribute('data-status');
            const approvalDate = button.getAttribute('data-approval_date');
            const payoutDate = button.getAttribute('data-payout_date');
            const payoutAmount = button.getAttribute('data-payout_amount');
            const fee = button.getAttribute('data-fee');
            const totalPayout = button.getAttribute('data-total_payout');
            const transactionId = button.getAttribute('data-transaction_id');
            const screenshot = button.getAttribute('data-screenshot');
            const clientStatus = button.getAttribute('data-client_status');

            // Populate modal fields
            withdrawalModal.querySelector('#modal-bank-name').textContent = bankName;
            withdrawalModal.querySelector('#modal-account-no').textContent = accountNo;
            withdrawalModal.querySelector('#modal-requested-amount').textContent = requestedAmount;
            withdrawalModal.querySelector('#modal-request-date').textContent = requestDate;
            withdrawalModal.querySelector('#modal-status').textContent = status;
            withdrawalModal.querySelector('#modal-approval-date').textContent = approvalDate;
            withdrawalModal.querySelector('#modal-payout-date').textContent = payoutDate;
            withdrawalModal.querySelector('#modal-payout-amount').textContent = payoutAmount;
            withdrawalModal.querySelector('#modal-fee').textContent = fee;
            withdrawalModal.querySelector('#modal-total-payout').textContent = totalPayout;
            withdrawalModal.querySelector('#modal-transaction-id').textContent = transactionId;

            // Screenshot (if exists)
            const screenshotContainer = withdrawalModal.querySelector('#modal-screenshot');
            if (screenshot) {
                screenshotContainer.innerHTML = `<a href="${screenshot}" target="_blank">
                                                    <img src="${screenshot}" alt="Screenshot" class="img-fluid rounded" style="max-height:150px;">
                                                 </a>`;
            } else {
                screenshotContainer.textContent = '—';
            }

            // Status colors
            const statusBadge = withdrawalModal.querySelector('#modal-status');
            statusBadge.className = 'badge';
            if (status === 'approved') statusBadge.classList.add('bg-success');
            else if (status === 'pending') statusBadge.classList.add('bg-warning', 'text-dark');
            else if (status === 'rejected') statusBadge.classList.add('bg-danger');
            else if (status === 'completed') statusBadge.classList.add('bg-primary');

            const clientBadge = withdrawalModal.querySelector('#modal-client-status');
            clientBadge.textContent = clientStatus;
            clientBadge.className = 'badge';
            if (clientStatus === 'verified') clientBadge.classList.add('bg-success');
            else clientBadge.classList.add('bg-secondary');
        });
    });
</script>

@yield('js')
@stack('script')
