@extends('layouts.login.common')
@section('title', '質問の作成')
@include('layouts.login.header')
@section('contents')

<div class="question_text_area">
    <div class="input_text_area">
        <form action="{{ route('store_question') }}" method="POST">
            @csrf
            <div class="question_title_edit">
                <select class="select_tag_list" id="select_tag_id" name="select_tag_id">
                    <option value="">タグ選択</option>
                    @foreach($tag_list as $tag_lists)
                        <option  value="{{ $tag_lists->id }}"
                            data-tag_id="{{ $tag_lists->id }}">
                            {{ $tag_lists->question_tag }}
                        </option>
                    @endforeach
                </select>
                <input class='question_title_input' type="text" placeholder='タイトル' name="title">
            </div>
            <textarea class="text_area" id="body" name="name" rows="8" cols="40">
### 解決したいこと
ここに解決したい内容を記載してく

例）
Ruby on RailsでQiitaのようなWebアプリをつくっています。
記事を投稿する機能の実装中にエラーが発生しました。
解決方法を教えて下さい。

### 発生している問題・エラー
```
出ているエラーメッセージを入力
```

例）

```
NameError (uninitialized constant World)
```

または、問題・エラーが起きている画像をここにドラッグアンドドロップ

### 該当するソースコード
```言語名
ソースコードを入力
```

例）

```ruby
def greet
  puts Hello World
end
```

### 自分で試したこと
ここに問題・エラーに対して試したことを記載してください。

            </textarea>
                <div class="question_nav_btn">
                    <div class="question_back_btn">
                    <a class="btn btn-dark" href="QuestionBox">戻る</a>
                    </div>
                    <tr class="">　</tr>
                    <div class="question_create_btn">
                        <button type="submit" class="btn btn-primary">
                            登録
                        </button>
                    </div>
                </div>
        </form>
    </div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
<script>
var simplemde = new SimpleMDE({ element: document.getElementById("body") });
</script>
@endsection
@include('layouts.login.footer')
