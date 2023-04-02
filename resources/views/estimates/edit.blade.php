@extends('layouts.app')

@push('scripts')
    <script src="{{asset('/js/script.js')}}"></script>
@endpush

@section('content')
    <main>
        <h2 class="section-ttl">見積書の編集</h2>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- 担当者検索用モーダル -->
        @include('modals.search_person')
        @include('modals.search_client')

        <form action="{{route('estimates.update',$estimate)}}" method="post" class="w-75">
            @csrf
            @method('patch')
            <div>
                <label for="estimate_no" class="form-label">見積番号<span class="form-note">必須</span></label>
                <input type="number" name="estimate_no" class="form-control" value="{{ old('estimate_no',$estimate->estimate_no) }}">
            </div>
            <div class="mt-4">
                <label for="subject" class="form-label">件名<span class="form-note">必須</span></label>
                <input type="text" name="subject" class="form-control" value="{{old('subject', $estimate->subject)}}">
            </div>
            <div class="mt-4">
                <label for="issue_date" class="form-label">発行日<span class="form-note">必須</span></label>
                <input type="date" name="issue_date" class="form-control" value="{{old('issue_date', $estimate->issue_date)}}">
            </div>
            <div class="mt-4">
                <label for="person_id" class="form-label">担当者<span class="form-note">必須</span></label>
                <div class="d-flex">
                    <input type="text" name="person_name" class="form-control w-50" id="set-person" value="{{old('person_name',$estimate->person->person_name)}}" readonly>
                    <input type="hidden" name="person_id" class="form-control w-50" id="set-person-id" value="{{old('person_id',$estimate->person_id)}}" readonly>
                    <div class="my-parts" data-bs-toggle="modal" data-bs-target="#searchPersonModal"><span></span></div>
                </div>
            </div>
            <div class="mt-4">
                <label for="client_id" class="form-label">顧客名<span class="form-note">必須</span></label>
                <div class="d-flex">
                    <input type="text" name="client_name" class="form-control w-50" id="set-client" value="{{old('client_name',$estimate->client->client_name)}}" readonly>
                    <input type="hidden" name="client_id" class="form-control w-50" id="set-client-id" value="{{old('client_name',$estimate->client_id)}}" readonly>
                    <div class="my-parts" data-bs-toggle="modal" data-bs-target="#searchClientModal"><span></span></div>
                </div>
            </div>
            <div class="mt-4">
                <label for="delivery_line" class="form-label">納期<span class="form-note">必須</span></label>
                <input type="text" name="delivery_line" class="form-control" value="{{old('delivery_line', $estimate->delivery_line)}}">
            </div>
            <div class="mt-4">
                <label for="date_line" class="form-label">有効期限<span class="form-note">必須</span></label>
                <input type="text" name="date_line" class="form-control" value="{{old('date_line', $estimate->date_line)}}">
            </div>
            <div class="mt-4">
                <label for="expire_date" class="form-label">見積書期限<span class="form-note">必須</span></label>
                <input type="date" name="expire_date" class="form-control" value="{{old('expire_date',$estimate->expire_date)}}">
            </div>
            <div class="mt-4">
                <label for="delivery_place" class="form-label">納品場所</label>
                <input type="text" name="delivery_place" class="form-control" value="{{old('delivery_place',$estimate->delivery_place)}}">
            </div>
            <div class="mt-4">
                <label for="pay_requirement" class="form-label">支払条件<span class="form-note">必須</span></label>
                <input type="text" name="pay_requirement" class="form-control" value="{{old('pay_requirement',$estimate->pay_requirement)}}">
            </div>
            <div class="mt-4">
                <label for="estimate_requirement" class="form-label">見積条件</label>
                <textarea name="estimate_requirement" class="form-control">{{old('estimate_requirement', $estimate->estimate_requirement)}}</textarea>
            </div>
            <div class="mt-4">
                <label for="note" class="form-label">備考</label>
                <textarea name="note" class="form-control">{{old('note',$estimate->note)}}</textarea>
            </div>
            
            
            <button type="submit" class="btn btn-outline-primary mt-4">編集</button>
        </form>
    </main>
@endsection