<!-- Scripts追加 -->
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

@extends('layouts.layout')
@section('content')
    <main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class='text-center'>収入</h1>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <div class="panel-body">
                            @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $message)
                                <li>{{ $message }}</li>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <form action="{{ route('edit.income', ['income' => $result->id])}}" method="post">
                            @csrf
                            <label for='amount'>金額</label>
                                <input type='text' class='form-control' name='amount' value="{{ $result['amount'] }}"/>
                            <label for='date' class='mt-2'>日付</label>
                                <input type='date' class='form-control' name='date' id='date' value="{{ $result['date'] }}"/>
                            <label for='type' class='mt-2'>カテゴリ</label>
                            <select name='type_id' class='form-control'>
                                <option value='' hidden>カテゴリ</option>
                                @foreach($types as $type)
                                    @if($type->user_id === auth()->id() || $type->user_id === 0)<!-- ユーザーの登録またはデフォルトのカテゴリのみ表示 -->
                                        <option value="{{ $type->id }}" {{ ($type->id == old('type_id', $selectedCategoryId)) ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <a href="{{ route('create.Type.Form', ['category' => 1]) }}" class="btn btn-link w-100">カテゴリ追加</a>
                            <label for='comment' class='mt-2'>メモ</label>
                                <textarea class='form-control' name='comment'>{{ $result['comment'] }}</textarea>
                            <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-primary w-25 mt-3'>登録</button>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection