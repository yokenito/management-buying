<div class="modal fade" id="btn-ProcessModal{{$bill->id}}" tabindex="-1" aria-labelledby="btnProcessModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">請求書を処理済にしてもよろしいですか？</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>
            <div class="modal-footer">
                <form action="{{route('bills.process',$bill)}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-dark ms-3">処理済</button>
                </form>
            </div>
        </div>
        
    </div>
</div>