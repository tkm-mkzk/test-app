@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
        <option value=0>男性</option>
        <option value=1>女性</option>
        <option value=2>その他</option>
      </select>
    </div>
    <div class="search__inquiry-fields">
      <select>
        <option>お問い合わせの種類</option>
      </select>
    </div>
    <div class="search__day">
      <input type="text" id="date-picker" placeholder="年/月/日">
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
      {{ $contacts->links() }}
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
      @foreach ($contacts as $contact)
      <tr>
        <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
        <td>{{ $contact->gender_text }}</td>
        <td>{{ $contact->email }}</td>
        <td>{{ $contact->category->content }}</td>
        <td><button class="detail-button" data-id="{{ $contact->id }}">詳細</button></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- モーダル start -->
<div id="detail-modal" class="modal">
  <div class="modal-content">
    <span class="close-button">&times;</span>
    <div class="modal-body">
      <div class="modal-item">
        <p><strong>お名前:</strong></p>
        <p id="modal-name"></p>
      </div>
      <div class="modal-item">
        <p><strong>性別:</strong></p>
        <p id="modal-gender"></p>
      </div>
      <div class="modal-item">
        <p><strong>メールアドレス:</strong></p>
        <p id="modal-email"></p>
      </div>
      <div class="modal-item">
        <p><strong>電話番号:</strong></p>
        <p id="modal-tel"></p>
      </div>
      <div class="modal-item">
        <p><strong>住所:</strong></p>
        <p id="modal-address"></p>
      </div>
      <div class="modal-item">
        <p><strong>建物名:</strong></p>
        <p id="modal-building"></p>
      </div>
      <div class="modal-item">
        <p><strong>お問い合わせの種類:</strong></p>
        <p id="modal-category"></p>
      </div>
      <div class="modal-item inquiry-content">
        <p><strong>お問い合わせ内容:</strong></p>
        <p id="modal-detail"></p>
      </div>
    </div>
    <div class="modal-footer">
      <button class="delete-button">削除</button>
    </div>
  </div>
</div>
<!-- モーダル end -->

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  flatpickr("#date-picker", {
    dateFormat: "Y/m/d",
    altInput: true,
    altFormat: "Y年m月d日",
    locale: {
      firstDayOfWeek: 1,
      weekdays: {
        shorthand: ['日', '月', '火', '水', '木', '金', '土'],
        longhand: ['日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日'],
      },
      months: {
        shorthand: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
        longhand: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
      },
    },
  });

  document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('detail-modal');
    const detailButtons = document.querySelectorAll('.detail-button');
    const closeButton = document.querySelector('.close-button');

    detailButtons.forEach(button => {
      button.addEventListener('click', function() {
        const contactId = this.dataset.id;
        fetch(`/contacts/${contactId}`)
          .then(response => response.json())
          .then(data => {
            document.getElementById('modal-name').innerText = `${data.first_name} ${data.last_name}`;
            document.getElementById('modal-gender').innerText = data.gender_text;
            document.getElementById('modal-email').innerText = data.email;
            document.getElementById('modal-tel').innerText = data.tel;
            document.getElementById('modal-address').innerText = data.address;
            document.getElementById('modal-building').innerText = data.building;
            document.getElementById('modal-category').innerText = data.category.content;
            document.getElementById('modal-detail').innerText = data.detail;
            modal.style.display = 'block';
          })
          .catch(error => {
            console.error('Error fetching contact data:', error);
          });
      });
    });

    closeButton.addEventListener('click', function() {
      modal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
      if (event.target == modal) {
        modal.style.display = 'none';
      }
    });
  });
</script>
@endsection
