@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="contact-form-container">
  <div class="contact-form-title">Confirm</div>
  <form action="/contacts" method="post">
    @csrf
    <div class="form-group">
      <label for="first_name">お名前</label>
      <div class="name-fields" style="display: flex;">
        <div>{{ $contact['full_name'] }}</div>
        <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}" />
        <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}" />
      </div>
    </div>
    <div class="form-group">
      <label for="gender">性別</label>
      <div class="gender-options">
        <div>{{ $contact->gender_text }}</div>
        <input type="hidden" name="gender" value="{{ $contact['gender'] }}" />
      </div>
    </div>
    <div class="form-group">
      <label for="email">メールアドレス</label>
      <div>
        <div>{{ $contact['email'] }}</div>
        <input type="hidden" name="email" value="{{ $contact['email'] }}" />
      </div>
    </div>
    <div class="form-group">
      <label for="phone">電話番号</label>
      <div class="phone-fields">
        <div>{{ $contact['tel'] }}</div>
        <input type="hidden" name="tel" value="{{ $contact['tel'] }}" />
      </div>
    </div>
    <div class="form-group">
      <label for="address">住所</label>
      <div>
        <div>{{ $contact['address'] }}</div>
        <input type="hidden" name="address" value="{{ $contact['address'] }}" />
      </div>
    </div>
    <div class="form-group">
      <label for="building">建物名</label>
      <div>
        <div>{{ $contact['building'] }}</div>
        <input type="hidden" name="building" value="{{ $contact['building'] }}" />
      </div>
    </div>
    <div class="form-group">
      <label for="category_id">お問い合わせの種類</label>
      <div class="inquiry_fields">
        <div>{{ $contact['category_id'] }}</div>
        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}" />
      </div>
    </div>
    <div class="form-group form-group-last">
      <label for="inquiry_content">お問い合わせ内容</label>
      <div>
        <div>{{ $contact['detail'] }}</div>
        <textarea name="detail" style="display: none;" readonly>{{ $contact['detail'] }}</textarea>
      </div>
    </div>
    <div class="form-group-submit">
      <button type="submit">送信</button>
      <a href="/" class="form-group-fix">修正</a>
    </div>
  </form>
</div>
@endsection
