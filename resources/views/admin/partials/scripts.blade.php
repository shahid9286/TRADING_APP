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
@yield('js')
@stack('script')
