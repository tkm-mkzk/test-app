@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
<div class="admin-container">
  <div class="admin-title">Admin</div>
  <div class="search-container">
    <form class="search-form" action="{{ route('admin.search') }}" method="GET" id="search-form">
      <div class="search__name-and-email-fields">
        <input type="text" name="name_or_email" placeholder="名前やメールアドレスを入力してください" value="{{ request('name_or_email') }}">
      </div>
      <div class="search__gender-fields">
        <select name="gender">
          <option value="" {{ request('gender') === '' ? 'selected' : '' }}>性別</option>
          <option value="0" {{ request('gender') == "0" ? 'selected' : '' }}>男性</option>
          <option value="1" {{ request('gender') == "1" ? 'selected' : '' }}>女性</option>
          <option value="2" {{ request('gender') == "2" ? 'selected' : '' }}>その他</option>
        </select>
      </div>
      <div class="search__inquiry-fields">
        <select name="category_id">
          <option value="">お問い合わせの種類</option>
          @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
          @endforeach
        </select>
      </div>
      <div class="search__day">
        <input type="text" id="date-picker" name="date" placeholder="年/月/日" value="{{ request('date') }}">
      </div>
      <div class="search-button-fields">
        <button type="submit" class="search-button">検索</button>
      </div>
      <div class="reset-button-fields">
        <button type="button" class="reset-button" id="reset-button">リセット</button>
      </div>
    </form>
  </div>

  <div class="action-container">
    <button class="export-button">エクスポート</button>
    <div class="pagination-container">
      {{ $contacts->appends(request()->query())->links() }}
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
    const deleteButton = document.querySelector('.modal-footer .delete-button');
    let currentContactId;

    detailButtons.forEach(button => {
      button.addEventListener('click', function() {
        currentContactId = this.dataset.id;
        fetch(`/contacts/${currentContactId}`)
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

    deleteButton.addEventListener('click', function() {
      if (confirm('本当に削除しますか？')) {
        fetch(`/contacts/${currentContactId}`, {
            method: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
              'Content-Type': 'application/json'
            }
          })
          .then(response => response.json())
          .then(data => {
            if (data.status === 'success') {
              location.reload(); // 成功した場合、ページをリロードしてリストを更新
            } else {
              alert('削除に失敗しました。');
            }
          })
          .catch(error => {
            console.error('Error deleting contact:', error);
            alert('削除に失敗しました。');
          });
      }
    });

    document.getElementById('reset-button').addEventListener('click', function() {
      document.getElementById('search-form').reset();
      window.location.href = "{{ route('admin.search') }}";
    });
  });
</script>
@endsection
