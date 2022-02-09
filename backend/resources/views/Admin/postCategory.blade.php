@extends('layouts.login.common')
@section('title','カテゴリーの追加')
@include('layouts.login.header')
@section('contents')

<a href="{{ route('userPostIndex') }}">戻る</a>

<Form action="{{ route('post_main_category.store') }}" method="post">
  @csrf
  <label>新規メインカテゴリー</label>
  <input type="text" name="main_category">
  @if($errors->has('main_category'))
  <span class="text-danger">{{ $errors->first('main_category') }}</span>
  @endif
  <button type="submit">登録</button>
</Form>

<Form action="{{ route('post_sub_category.store') }}" method="post">
  @csrf
    <label>メインカテゴリー</label>
    <select name="post_main_category_id">
      <option value="">-----</option>
        @foreach($post_main_categories as $post_maincategory)
          <option value="{{ $post_maincategory->id }}">
            {{ $post_maincategory->main_category }}
          </option>
        @endforeach
    </select>
    @if($errors->has('post_main_category_id'))
    <span class="text-danger">{{ $errors->first('post_main_category_id') }}</span>
    @endif

    <label>新規サブカテゴリー追加</label>
    <input type="text" name="sub_category">
    @if($errors->has('sub_category'))
    <span class="text-danger">{{ $errors->first('sub_category') }}</span>
    @endif
    <button type="submit">登録</button>
</Form>
<p>カテゴリー一覧</p>
  <ul>
    @foreach($post_main_categories as $main_data)
    <li>{{ $main_data->main_category }}
      @if($main_data->postSubCatagoryIsExistence($main_data))
      <Form name="post_main_category_delete{{ $main_data->id }}"
        action="{{ route('post_main_category.destroy',[$main_data->id]) }}"
        method="post">
        @method('DELETE')
        @csrf
        <a href="javascript:post_main_category_delete{{ $main_data->id }}.submit()">
          メインカテゴリー削除</a>
      </Form>
      @endif
        <ul>
        @foreach($main_data->postSubCategory as $sub_data)
        <li>{{ $sub_data->sub_category }}</li>
        @if($sub_data->postIsExistence($sub_data))
        <Form name="post_sub_category_delete{{ $sub_data->id }}"
          action="{{ route('post_sub_category.destroy',[$sub_data->id]) }}"
          method="post">
          @method('DELETE')
          @csrf
          <a href="javascript:post_sub_category_delete{{ $sub_data->id }}.submit()">
            サブカテゴリー削除</a>
        </Form>
        @endif
        @endforeach
      </ul>
    </li>
    @endforeach
  </ul>
@endsection
@include('layouts.login.footer')
