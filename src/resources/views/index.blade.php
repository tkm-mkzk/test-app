@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-form-container">
  <div class="contact-form-title">Contact</div>
  <form action="/contacts/confirm" method="post">
    @csrf
    <div class="form-group">
      <label for="first_name">お名前 <span class="required">※</span></label>
      <div class="name-fields">
        <input type="text" id="last_name" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}" required>
        <div class="name-spacer"></div>
        <input type="text" id="first_name" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}" required>
      </div>
    </div>
    <div class="form-group">
      <label for="gender">性別 <span class="required">※</span></label>
      <div class="gender-options">
        <input type="radio" id="male" name="gender" value="0" {{ old('gender') == 0 ? 'checked' : '' }} required>
        <label for="male">男性</label>
        <input type="radio" id="female" name="gender" value="1" {{ old('gender') == 1 ? 'checked' : '' }} required>
        <label for="female">女性</label>
        <input type="radio" id="other" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }} required>
        <label for="other">その他</label>
      </div>

    </div>
    <div class="form-group">
      <label for="email">メールアドレス <span class="required">※</span></label>
      <div>
        <input type="email" id="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}" required>
      </div>
    </div>
    <div class="form-group">
      <label for="phone1">電話番号 <span class="required">※</span></label>
      <div class="phone-fields">
        <input type="text" id="phone1" name="phone1" placeholder="080" value="{{ old('phone1') }}" required>
        <span class="phone-separator">-</span>
        <input type="text" id="phone2" name="phone2" placeholder="1234" value="{{ old('phone2') }}" required>
        <span class="phone-separator">-</span>
        <input type="text" id="phone3" name="phone3" placeholder="5678" value="{{ old('phone3') }}" required>
      </div>
    </div>
    <div class="form-group" style="display:none;">
      <input type="hidden" id="tel" name="tel">
    </div>
    <div class="form-group">
      <label for="address">住所 <span class="required">※</span></label>
      <div>
        <input type="text" id="address" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}" required>
      </div>
    </div>
    <div class="form-group">
      <label for="building">建物名</label>
      <div>
        <input type="text" id="building" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
      </div>
    </div>
    <div class="form-group">
      <label for="category_id">お問い合わせの種類 <span class="required">※</span></label>
      <div class="inquiry_fields">
        <select id="category_id" name="category_id" required>
          <option value="" disabled selected>選択してください</option>
          @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="inquiry_content">お問い合わせ内容 <span class="required">※</span></label>
      <div>
        <textarea id="inquiry_content" name="detail" placeholder="お問い合わせ内容をご記載ください" required>{{ old('detail') }}</textarea>
      </div>
    </div>
    <div class="form-group form-group-submit">
      <button id="submit-button" type="submit">確認画面</button>
    </div>
  </form>
</div>
@endsection
