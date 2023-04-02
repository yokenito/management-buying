@extends('layouts.app')

@section('content')
    <main>
        <h2 class="section-ttl">担当者の編集</h2>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('people.update',$person)}}" method="post" class="w-75">
            @csrf
            @method('patch')
            <div class="mt-4">
                <label for="person_number" class="form-label">社員番号<span class="form-note">必須</span></label>
                <input type="number" name="person_number" class="form-control" value="{{old('person_number', $person->person_number)}}">
            </div>
            <div class="mt-4">
                <label for="person_name" class="form-label">担当者名<span class="form-note">必須</span></label>
                <input type="text" name="person_name" class="form-control" value="{{old('person_name', $person->person_name)}}">
            </div>
            
            <button type="submit" class="btn btn-outline-primary mt-4">登録</button>
        </form>
    </main>
@endsection