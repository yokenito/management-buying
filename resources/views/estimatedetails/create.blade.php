@extends('layouts.app')

@push('scripts')
    <script src="{{asset('/js/script.js')}}"></script>
@endpush

@section('content')
    <main>
        <h2 class="section-ttl">見積書明細の作成</h2>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- 製品検索用モーダル -->
        @include('modals.search_product')

        <form action="{{route('estimatedetails.store')}}" method="post" class="w-75">
            @csrf
            <div>
                <input type="hidden" name="estimate_id" value="{{ old('estimate_id', $estimate->id) }}">
            </div>
            <div>
                <label for="product_id" class="form-label">製品<span class="form-note">必須</span></label>
                <div class="d-flex">
                    <input type="text" name="product_name" class="form-control w-50" id="set-product" value="{{old('product_name')}}" readonly>
                    <input type="hidden" name="product_id" class="form-control w-50" id="set-product-id" value="{{old('productt_name')}}" readonly>
                    <div class="my-parts" data-bs-toggle="modal" data-bs-target="#searchProductModal"><span></span></div>
                </div>
            </div>
            <div>
                <label for="product_count" class="form-label">個数<span class="form-note">必須</span></label>
                <input type="number" name="product_count" class="form-control" value="{{ old('product_count') }}">
            </div>
            <div>
                <label for="product_price" class="form-label">単価<span class="form-note">必須</span></label>
                <input type="number" name="product_price" class="form-control" value="{{ old('product_price') }}">
            </div>
            
            
            
            <button type="submit" class="btn btn-outline-primary mt-4">作成</button>
        </form>
    </main>
@endsection