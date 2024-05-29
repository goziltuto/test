<?php
$currentUrl = url()->current(); // 現在のURLを取得
$segments = explode('/', $currentUrl); // URLをスラッシュで分割
$lastSegment = end($segments); // 最後のセグメントを取得

// 最後のセグメントが数字であることを確認し、数字を取得
$category = is_numeric($lastSegment) ? intval($lastSegment) : 1;
?>

<!-- Scripts追加 -->
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

@extends('layouts.layout')
@section('content')
    <main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class='text-center'>分類データの追加</h1>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $message)
                            <li>{{ $message }}</li>
                            @endforeach
                        </div>
                        @endif
                        <form action="{{ route('addType', ['category' => $category]) }}" method="post">
                            @csrf
                            <label for='category'>分類</label>
                                <input type='text' class='form-control' name='category'/>
                            <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-primary w-25 mt-3'>追加</button>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection