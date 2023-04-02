<div class="modal fade" id="btn-confirm-ReceiveModal{{$receive->id}}" tabindex="-1" aria-labelledby="btnconfirmReceiveModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">納品書を確定してもよろしいですか？</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>
            <div class="modal-footer">
                <form action="{{route('receives.confirm',$receive)}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-dark ms-3">確定</button>
                </form>
            </div>
        </div>
        
    </div>
</div>