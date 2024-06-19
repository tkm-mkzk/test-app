@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin-container">
  <div class="admin-title">Admin</div>
  <div class="search-container">
    <div class="search__name-and-email-fields">
      <input type="text" placeholder="名前やメールアドレスを入力してください">
    </div>
    <div class="search__gender-fields">
      <select>
        <option value="">性別</option>
        <option value="male">男性</option>
        <option value="female">女性</option>
      </select>
    </div>
    <div class="search__inquiry-fields">
      <select>
        <option>お問い合わせの種類</option>
      </select>
    </div>
    <div class="search__day">
      <select>
        <option>年/月/日</option>
      </select>
    </div>
    <div class="search-button-fields">
      <button class="search-button">検索</button>
    </div>
    <div class="reset-button-fields">
      <button class="reset-button">リセット</button>
    </div>
  </div>

  <div class="action-container">
    <button class="export-button">エクスポート</button>
    <div class="pagination-container">
      <ul class="pagination">
        <li>1</li>
        <li>2</li>
        <li>3</li>
        <li>4</li>
        <li>5</li>
      </ul>
    </div>
  </div>

  <table class="admin-table">
    <thead>
      <tr>
        <th>お名前</th>
        <th>性別</th>
        <th>メールアドレス</th>
        <th>お問い合わせの種類</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @for ($i = 0; $i < 8; $i++) <tr>
        <td>山田 太郎</td>
        <td>男性</td>
        <td>test@example.com</td>
        <td>商品の交換について</td>
        <td><button class="detail-button">詳細</button></td>
        </tr>
        @endfor
    </tbody>
  </table>
</div>
@endsection
