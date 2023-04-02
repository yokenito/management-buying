<div class="modal fade" id="btn-InvoiceModal{{$receive->id}}" tabindex="-1" aria-labelledby="btnInvoiceModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">請求書の作成を開始してもよろしいですか？</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-dark ms-3">
                    <a href="{{route('bills.create',$receive)}}" class="c-white">
                        請求書作成
                    </a>
                </button>
            </div>
        </div>
        
    </div>
</div>