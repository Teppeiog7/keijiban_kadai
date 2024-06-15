<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="{{ route('registerPost') }}" method="POST">
    <div class="w-100 d-flex" style="align-items:center; justify-content:center;">
      <div class="w-25 vh-75 border form_register" style="background: white;font-weight: bold; padding:50px; margin-top: 50px;">
        <div class="register_form">
          <div class="d-flex mt-3" style="justify-content:space-between width: 100%;">
            <div class="">
              @error('over_name')
              <p style="color:red; font-weight:bold;">{{ $message }}</p> <!-- エラーメッセージを表示 -->
              @enderror
              <label class="d-block m-0" style="font-size:13px">ユーザー名</label>
              <div class="border-bottom border-primary" style="">
                <input type="text" class="" name="username">
              </div>
            </div>
          </div>
          <div class="mt-3">
            @error('mail_address')
            <p style="color:red; font-weight:bold;">{{ $message }}</p> <!-- エラーメッセージを表示 -->
            @enderror
            <label class="m-0 d-block" style="font-size:13px">メールアドレス</label>
            <div class="border-bottom border-primary">
              <input type="mail" class="w-100 border-0 mail_address" name="email">
            </div>
          </div>
        </div>
        <div class="mt-3">
          <label class="d-block m-0" style="font-size:13px">パスワード</label>
          <div class="border-bottom border-primary">
            <input type="password" class="border-0 w-100 password" name="password">
          </div>
        </div>
        <div class="mt-3">
          <label class="d-block m-0" style="font-size:13px">確認用パスワード</label>
          <div class="border-bottom border-primary">
            <input type="password" class="border-0 w-100 password_confirmation" name="password_confirmation">
          </div>
        </div>
        <div class="mt-5 text-right">
          <input type="submit" class="btn btn-primary register_btn" value="確認" onclick="return confirm('登録してよろしいですか？')">
        </div>
      </div>
      {{ csrf_field() }}
    </div>
  </form>
</body>
</html>
