<div class="modal fade" id="btn-receive-EstimateModal{{$estimate->id}}" tabindex="-1" aria-labelledby="btnreceiveEstimateModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">見積受注を確定してもよろしいですか？</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>
            <div class="modal-footer">
                <form action="{{route('estimates.receive',$estimate)}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-dark ms-3">受注</button>
                </form>
            </div>
        </div>
        
    </div>
</div>