<div class="modal fade" id="confirmReceiveDeleteModal{{$receive->id}}" tabindex="-1" aria-labelledby="confirmReceiveDeleteModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">件名：{{$receive->subject}}<br>上記の見積書を削除してもよろしいですか？</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>
            <div class="modal-footer">
                <form action="{{route('receives.destroy',$receive)}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">削除</button>
                </form>
            </div>
        </div>
        
    </div>
</div>