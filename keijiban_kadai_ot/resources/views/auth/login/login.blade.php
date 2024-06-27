 <!DOCTYPE html>
 <html lang="ja">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
 </head>
 <body>
   <form action="{{ route('loginView') }}" method="POST">
     <div class="w-100 vh-100 d-flex" style="align-items:center; justify-content:center;">
       <div class="border vh-50 w-25 form_login" style="background: #FFF;">
         <div class="w-75 m-auto pt-5">
           <label class="d-block m-0" style="font-size:13px;">メールアドレス</label>
           <div class="border-bottom border-primary w-100">
             <input type="text" class="w-100 border-0" name="email">
           </div>
         </div>
         <div class="w-75 m-auto pt-5">
           <label class="d-block m-0" style="font-size:13px;">パスワード</label>
           <div class="border-bottom border-primary w-100">
             <input type="password" class="w-100 border-0" name="password">
           </div>
         </div>
         <div class="text-right m-3">
           <input type="submit" class="btn btn-primary" value="ログイン">
         </div>
         <div class="text-center">
           <a href="/register">新規登録はこちら</a>
         </div>
       </div>
       {{ csrf_field() }}
     </div>
   </form>
 </body>
 </html>
