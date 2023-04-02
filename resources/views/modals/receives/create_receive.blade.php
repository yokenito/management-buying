<div class="modal fade" id="createReceiveModal" tabindex="-1" aria-labelledby="createReceiveModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">新規納品書の作成</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>
            <div>
                <div class="d-flex m-3">
                    <button class="btn btn-outline-primary"><a href="{{route('receives.create')}}" class="new-reg">新規作成</a></button>
                    <button class="btn btn-outline-dark ms-3"><a href="{{route('receives.estimateindex')}}" class="new-reg c-black">見積より選択</a></button>
                </div>
            </div>
        </div>
        
    </div>
</div>