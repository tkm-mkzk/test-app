@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-form-container">
  <div class="contact-form-title">Contact</div>
  <form action="/contacts/confirm" method="post" 　novalidate>
    @csrf
    <div class="form-group">
      <label for="first_name">お名前 <span class="required">※</span></label>
      <div class="name-fields">
        <input type="text" id="last_name" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
        <div class="name-spacer"></div>
        <input type="text" id="first_name" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
      </div>
    </div>
    <div class="form-group">
      <label for=""></label>
      @if ($errors->has('last_name') || $errors->has('first_name'))
      <div class="error">{{ $errors->first('last_name') ?: $errors->first('first_name') }}</div>
      @endif
    </div>
    <div class="form-group">
      <label for="gender">性別 <span class="required">※</span></label>
      <div class="gender-options">
        <input type="radio" id="male" name="gender" value="0" {{ old('gender') === 0 ? 'checked' : '' }}>
        <label for="male">男性</label>
        <input type="radio" id="female" name="gender" value="1" {{ old('gender') === 1 ? 'checked' : '' }}>
        <label for="female">女性</label>
        <input type="radio" id="other" name="gender" value="2" {{ old('gender') === 2 ? 'checked' : '' }}>
        <label for="other">その他</label>
      </div>
    </div>
    <div class="form-group">
      <label for=""></label>
      @if ($errors->has('gender'))
      <div class="error">{{ $errors->first('gender') }}</div>
      @endif
    </div>
    <div class="form-group">
      <label for="email">メールアドレス <span class="required">※</span></label>
      <div>
        <input type="email" id="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
        @if ($errors->has('email'))
        <div class="error">{{ $errors->first('email') }}</div>
        @endif
      </div>
    </div>
    <div class="form-group">
      <label for="phone1">電話番号 <span class="required">※</span></label>
      <div class="phone-fields">
        <input type="text" id="phone1" name="phone1" placeholder="080" value="{{ old('phone1') }}">
        <span class="phone-separator">-</span>
        <input type="text" id="phone2" name="phone2" placeholder="1234" value="{{ old('phone2') }}">
        <span class="phone-separator">-</span>
        <input type="text" id="phone3" name="phone3" placeholder="5678" value="{{ old('phone3') }}">
      </div>
    </div>
    <div class="form-group" style="display:none;">
      <input type="hidden" id="tel" name="tel">
    </div>
    <div class="form-group">
      <label for=""></label>
      @if ($errors->has('phone1') || $errors->has('phone2') || $errors->has('phone3'))
      <div class="error">{{ $errors->first('phone1') ?: ($errors->first('phone2') ?: $errors->first('phone3')) }}</div>
      @endif
    </div>
    <div class="form-group">
      <label for="address">住所 <span class="required">※</span></label>
      <div>
        <input type="text" id="address" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
        @if ($errors->has('address'))
        <div class="error">{{ $errors->first('address') }}</div>
        @endif
      </div>
    </div>
    <div class="form-group">
      <label for="building">建物名</label>
      <div>
        <input type="text" id="building" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
        @if ($errors->has('building'))
        <div class="error">{{ $errors->first('building') }}</div>
        @endif
      </div>
    </div>
    <div class="form-group">
      <label for="category_id">お問い合わせの種類 <span class="required">※</span></label>
      <div class="inquiry_fields">
        <select id="category_id" name="category_id">
          <option value="" disabled selected>選択してください</option>
          @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
          @endforeach
        </select>
        @if ($errors->has('category_id'))
        <div class="error">{{ $errors->first('category_id') }}</div>
        @endif
      </div>
    </div>
    <div class="form-group">
      <label for="inquiry_content">お問い合わせ内容 <span class="required">※</span></label>
      <div>
        <textarea id="inquiry_content" name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
        @if ($errors->has('detail'))
        <div class="error">{{ $errors->first('detail') }}</div>
        @endif
      </div>
    </div>
    <div class="form-group form-group-submit">
      <button id="submit-button" type="submit">確認画面</button>
    </div>
  </form>
</div>
@endsection
