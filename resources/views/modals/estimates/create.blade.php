<div class="modal fade" id="createEstimate" tabindex="-1" aria-labelledby="createEstimateModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">見積の作成</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>
            <div class="modal-footer">
                <div>
                    <button type="button" class="btn btn-outline-primary"><a href="{{route('estimates.create')}}" class="new-reg">新規見積追加</a></button>
                    <button type="button" class="btn btn-outline-dark ms-3"><a href="{{route('estimates.create')}}" class="new-reg c-black">見積の再発行</a></button>
                </div>
            </div>
        </div>
        
    </div>
</div>