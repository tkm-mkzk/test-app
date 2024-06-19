@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/thanks.css') }}">
@endsection

@section('content')
<div class="thanks-container">
  <div class="message">
    お問い合わせありがとうございました
  </div>
  <div class="button-container">
    <button onclick="location.href='/'" class="to-home-button">HOME</button>
  </div>
</div>
@endsection
