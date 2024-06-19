@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/confirm.css') }}">
@endsection

@section('content')
<div class="contact-form-container">
  <div class="contact-form-title">Confirm</div>
  <form>
    @csrf
    <div class="form-group">
      <label for="first_name">お名前</span></label>
      <div class="name-fields">
        山田　太郎
      </div>
    </div>
    <div class="form-group">
      <label for="gender">性別</span></label>
      <div class="gender-options">
        男性
      </div>
    </div>
    <div class="form-group">
      <label for="email">メールアドレス</span></label>
      <div>
        test@example.com
      </div>
    </div>
    <div class="form-group">
      <label for="phone">電話番号</span></label>
      <div class="phone-fields">
        08012345678
      </div>
    </div>
    <div class="form-group">
      <label for="address">住所</span></label>
      <div>
        東京都渋谷区千駄ヶ谷1-2-3
      </div>
    </div>
    <div class="form-group">
      <label for="building">建物名</label>
      <div>
        千駄ヶ谷マンション101
      </div>
    </div>
    <div class="form-group">
      <label for="inquiry_type">お問い合わせの種類</span></label>
      <div class="inquiry_fields">
        商品の交換について
      </div>
    </div>
    <div class="form-group form-group-last">
      <label for="inquiry_content">お問い合わせ内容</span></label>
      <div>
        お問い合わせ内容をご記載ください
      </div>
    </div>
    <div class="form-group-submit">
      <button type="submit">確認画面</button>
      <a　href="#" class="form-group-fix">修正</a>
    </div>
  </form>
</div>
@endsection
