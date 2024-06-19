@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/index.css') }}">
@endsection

@section('content')
<div class="contact-form-container">
  <div class="contact-form-title">Contact</div>
  <form>
    @csrf
    <div class="form-group">
      <label for="first_name">お名前 <span class="required">※</span></label>
      <div class="name-fields">
        <input type="text" id="last_name" name="last_name" placeholder="例: 山田" required>
        <div class="name-spacer"></div>
        <input type="text" id="first_name" name="first_name" placeholder="例: 太郎" required>
      </div>
    </div>
    <div class="form-group">
      <label for="gender">性別 <span class="required">※</span></label>
      <div class="gender-options">
        <input type="radio" id="male" name="gender" value="male" required>
        <label for="male">男性</label>
        <input type="radio" id="female" name="gender" value="female">
        <label for="female">女性</label>
        <input type="radio" id="other" name="gender" value="other">
        <label for="other">その他</label>
      </div>
    </div>
    <div class="form-group">
      <label for="email">メールアドレス <span class="required">※</span></label>
      <div>
        <input type="email" id="email" name="email" placeholder="例: test@example.com" required>
      </div>
    </div>
    <div class="form-group">
      <label for="phone">電話番号 <span class="required">※</span></label>
      <div class="phone-fields">
        <input type="text" id="phone1" name="phone1" placeholder="080" required>
        <span class="phone-separator">-</span>
        <input type="text" id="phone2" name="phone2" placeholder="1234" required>
        <span class="phone-separator">-</span>
        <input type="text" id="phone3" name="phone3" placeholder="5678" required>
      </div>
    </div>
    <div class="form-group">
      <label for="address">住所 <span class="required">※</span></label>
      <div>
        <input type="text" id="address" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" required>
      </div>
    </div>
    <div class="form-group">
      <label for="building">建物名</label>
      <div>
        <input type="text" id="building" name="building" placeholder="例: 千駄ヶ谷マンション101">
      </div>
    </div>
    <div class="form-group">
      <label for="inquiry_type">お問い合わせの種類 <span class="required">※</span></label>
      <div class="inquiry_fields">
        <select id="inquiry_type" name="inquiry_type" required>
          <option value="" disabled selected>選択してください</option>
          <option value="type1">タイプ1</option>
          <option value="type2">タイプ2</option>
          <option value="type3">タイプ3</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="inquiry_content">お問い合わせ内容 <span class="required">※</span></label>
      <div>
        <textarea id="inquiry_content" name="inquiry_content" placeholder="お問い合わせ内容をご記載ください" required></textarea>
      </div>
    </div>
    <div class="form-group form-group-submit">
      <button type="submit">確認画面</button>
    </div>
  </form>
</div>
@endsection
