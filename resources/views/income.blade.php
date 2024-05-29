<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '家計簿') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    
    <!-- Scripts追加 -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
</head>
<body>
@extends('layouts.layout')
@section('content')
        <main class="py-4">
            <div class="row justify-content-around">
                <dev class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class='text-center'>収入</div>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <table class='table'>
                                    <thead>
                                        <tr>
                                            <th scope='col'>日付</th>
                                            <th scope='col'>金額</th>
                                            <th scope='col'>カテゴリ</th>
                                            <th scope='col'>コメント</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- ここに支出を表示する -->
                                            <tr>
                                                <th scope="col">{{ $income->date }}</th>
                                                <th scope="col">{{ $income->amount }}</th>
                                                <th scope="col">{{ $income->type->name }}</th>
                                                <th scope="col">{{ $income->comment }}</th>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                    <div class="col-md-4 text-center mb-3">
                            <form action="{{ route('delete.income', ['id' => $income['id']]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">削除</button>
                            </form>
                        </div>
                        <div class="col-md-4 text-center mb-3">
                            <a href="{{ route('edit.income', ['income' => $income['id']]) }}">
                                <button class="btn btn-secondary">編集</button>
                            </a>
                        </div>
                        <div class="col-md-4 text-center mb-3">
                        <form action="{{ route('softdelete.income', ['id' => $income['id']]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning">論理削除</button>
                            </form>
                        </div>
                    </div>
                </dev>
            </div>
        </main>
@endsection
</body>
</html>