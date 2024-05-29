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

            <div class="row justify-content-around mt-3 mb-2">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class='text-center'>日付検索</div>
                        </div>
                        <div class="card-body">
                            <form  action="{{ route('transactions.search') }}" method="GET" class="d-flex justify-content-center align-items-center">
                                @csrf
                                <div class="form-group">
                                    <input type="date" name="from" placeholder="from_date" value="{{ request('from') }}">
                                </div>
                                <span class="mx-3">~</span>
                                <div class="form-group">
                                    <input type="date" name="until" placeholder="until_date" value="{{ request('until') }}">
                                </div>
                                <button type="submit" class="btn btn-primary">検索</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-around mt-3 mb-2">
                <a href="{{ route('create.income') }}">
                    <button type="button" class="btn btn-primary">+ 収入</button>
                </a>
                <a href="{{ route('create.spend') }}">
                    <button type="button" class="btn btn-primary">+ 支出</button>
                </a>
            </div>
            <div class="row justify-content-around">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class='text-center'>収入</div>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <table class='table'>
                                    <thead>
                                        <tr>
                                            <th scope='col'>詳細</th>
                                            <th scope='col'>日付</th>
                                            <th scope='col'>金額</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- ここに収入を表示する -->
                                        @foreach($incomes as $income)
                                        <tr>
                                            <th scope="col">
                                                <a href="{{ route('income.detail', ['income' => $income['id']]) }}">#</a>
                                            </th>
                                            <th scope="col">{{ $income['date'] }}</th>
                                            <th scope="col">{{ $income['amount'] }}</th>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class='text-center'>支出</div>
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <table class='table'>
                                <thead>
                                    <tr>
                                        <th scope='col'>詳細</th>
                                        <th scope='col'>日付</th>
                                        <th scope='col'>金額</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- ここに支出を表示する -->
                                    @foreach($spends as $spend)
                                    <tr>
                                        <th scope="col">
                                            <a href="{{ route('spend.detail', ['spending' => $spend['id']]) }}">#</a>
                                        </th>
                                        <th scope="col">{{ $spend['date'] }}</th>
                                        <th scope="col">{{ $spend['amount'] }}</th>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection
</body>
</html>