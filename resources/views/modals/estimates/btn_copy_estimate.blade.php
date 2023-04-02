<div class="modal fade" id="btn-copy-EstimateModal{{$estimate->id}}" tabindex="-1" aria-labelledby="btnreceiveEstimateModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">本見積を再発行しますか？</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-dark ms-3">
                    <a href="{{route('estimates.copy', $estimate)}}" class="new-reg c-black">再発行</a>
                </button>
            </div>
        </div>
        
    </div>
</div>