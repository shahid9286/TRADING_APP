<div class="modal fade" id="investmentDetail" tabindex="-1" aria-labelledby="investmentDetail" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Investment Detail</h4>
                <button type="button" class="bg-white text-dark border-0" data-bs-dismiss="modal" aria-label="Close"><i
                        class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-sm-4">Amount</dt>
                    <dd class="col-sm-8" id="modal-amount"></dd>

                    <dt class="col-sm-4">Start Date</dt>
                    <dd class="col-sm-8" id="modal-start-date"></dd>

                    <dt class="col-sm-4">Expiry Date</dt>
                    <dd class="col-sm-8" id="modal-expiry-date"></dd>

                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8"><span id="modal-status" class="badge"></span></dd>

                    <dt class="col-sm-4">Transaction ID</dt>
                    <dd class="col-sm-8" id="modal-transaction-id"></dd>

                    <dt class="col-sm-4">Screenshot</dt>
                    <dd class="col-sm-8" id="modal-screenshot"></dd>

                    <dt class="col-sm-4">Active Status</dt>
                    <dd class="col-sm-8"><span id="modal-active-status" class="badge"></span></dd>
                </dl>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="withdrawalRequestDetail" tabindex="-1" aria-labelledby="withdrawalRequestDetailLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Bigger modal for more details -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Withdrawal Request Detail</h4>
                <button type="button" class="bg-white text-dark border-0" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-sm-4">Bank Name</dt>
                    <dd class="col-sm-8" id="modal-bank-name"></dd>

                    <dt class="col-sm-4">Account No</dt>
                    <dd class="col-sm-8" id="modal-account-no"></dd>

                    <dt class="col-sm-4">Requested Amount</dt>
                    <dd class="col-sm-8" id="modal-requested-amount"></dd>

                    <dt class="col-sm-4">Request Date</dt>
                    <dd class="col-sm-8" id="modal-request-date"></dd>

                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8"><span id="modal-status" class="badge"></span></dd>

                    <dt class="col-sm-4">Approval Date</dt>
                    <dd class="col-sm-8" id="modal-approval-date"></dd>

                    <dt class="col-sm-4">Payout Date</dt>
                    <dd class="col-sm-8" id="modal-payout-date"></dd>

                    <dt class="col-sm-4">Payout Amount</dt>
                    <dd class="col-sm-8" id="modal-payout-amount"></dd>

                    <dt class="col-sm-4">Fee</dt>
                    <dd class="col-sm-8" id="modal-fee"></dd>

                    <dt class="col-sm-4">Total Payout</dt>
                    <dd class="col-sm-8" id="modal-total-payout"></dd>

                    <dt class="col-sm-4">Transaction ID</dt>
                    <dd class="col-sm-8" id="modal-transaction-id"></dd>

                    <dt class="col-sm-4">Screenshot</dt>
                    <dd class="col-sm-8" id="modal-screenshot"></dd>

                    <dt class="col-sm-4">Client Status</dt>
                    <dd class="col-sm-8"><span id="modal-client-status" class="badge"></span></dd>
                </dl>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="approveForm" method="POST" action="{{ route('admin.withdrawal-request.approve') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="approveModalLabel">Approve Payout</h5>
                    <button type="button" class="text-dark bg-success border-0" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="payout_date" class="form-label">Payout Date</label>
                    <input type="date" name="payout_date" id="payout_date" class="form-control" required>
                    <input type="hidden" name="withdrawal_request_id" id="awithdrawal_request_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Approve</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="rejectForm" method="POST" action="{{ route('admin.withdrawal-request.reject') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="rejectModalLabel">Reject Payout</h5>
                    <button type="button" class="bg-danger text-dark border-0" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="remarks" class="form-label">Remarks</label>
                    <textarea name="remarks" id="remarks" class="form-control" rows="3" required></textarea>
                    <input type="hidden" name="withdrawal_request_id" id="rwithdrawal_request_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Reject</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="payModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="rejectForm" method="POST" action="{{ route('admin.withdrawal-request.pay') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="payModalLabel">Pay Withdrawal</h5>
                    <button type="button" class="bg-primary text-dark border-0" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="admin_bank_id" class="form-label">Bank</label>
                        <select name="admin_bank_id" id="admin_bank_id" class="form-control" required>
                            @if (isset($admin_banks))
                                @foreach ($admin_banks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->name }} - {{ $bank->account_no }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="transaction_id" class="form-label">Transaction ID</label>
                        <input type="text" name="transaction_id" id="transaction_id" class="form-control"
                            rows="3" required>
                    </div>
                    <div>
                        <label for="screenshot" class="form-label">Screenshot</label>
                        <input type="file" name="screenshot" id="screenshot" class="form-control" rows="3"
                            required>
                    </div>
                    <input type="hidden" name="withdrawal_request_id" id="pwithdrawal_request_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Pay Now</button>
                </div>
            </div>
        </form>
    </div>
</div>
