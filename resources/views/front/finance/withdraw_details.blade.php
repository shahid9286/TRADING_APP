<div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="withdrawModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="withdrawModalLabel">Withdraw Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <ul class="list-group userData mb-2">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>Trx ID</span>
                <span id="modalTrx"></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>Screenshot</span>
                <a id="modalScreenshot" href="#" target="_blank">View</a>
            </li>
        </ul>
        <div class="feedback"></div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
