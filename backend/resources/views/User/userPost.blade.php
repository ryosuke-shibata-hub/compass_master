@extends('layouts.login.common')
@section('title','トップページ')
@include('layouts.login.header')
@section('contents')


<div class="home_index_page">
    <div class="home_layouts">
         <div class="btn_list">
        <div class="nav_btn">

        @can('admin')
            <p class="create_category">
            <a type="btn" class="btn category-btn" href="{{ route('postCategory.index') }}">カテゴリーを追加
            </a>
        </p>
        @else
        <p class="create_category pt-5"></p>
        <p class="create_category pt-5"></p>
        @endcan
        <p class="create_category">
            <a type="btn" class="btn post-btn" href="{{ route('post.create') }}">
                投稿
            </a>
        </p>
        <Form action="{{ route('userPostIndex') }}" method="get">
            <button class="btn my_post_btn"
                type="submit"
                name="my_post"
                value="my_post">
                自分の投稿
            </button>
        </Form>

        <Form action="{{ route('userPostIndex') }}" method="get">
            <button class="btn my_post_favorite_btn"
                type="submit"
                name="post_favorite"
                value="post_favorite">
                いいねした投稿
                <i class="fas fa-heart" style="color: red;"></i>
            </button>
        </Form>

        <Form action="{{ route('userPostIndex') }}" method="get">
        <input class="search_form" type="text" name="search_keyword"
                placeholder="キーワードを検索">
        <button class="btn search_btn"
                type="submit"
                >検索</button>
        </Form>

        <label class="category_title">カテゴリー</label>
        <select class="post_sub_category_search"
                id="post_sub_category_search" name="post_sub_category_id">
            <option value="">-----------------------------</option>
            @foreach($postMainCategoryList as $postMainCategoryList)
            <optgroup label="{{ $postMainCategoryList->main_category }}">
                @foreach($postMainCategoryList->postSubCategory as $postSubCategory)
                <option
                value="{{ $postSubCategory->id }}"
                data-subcategory_id="{{ $postSubCategory->id }}">
                {{ $postSubCategory->sub_category }}
                </option>
                @endforeach
            </optgroup>
            @endforeach
        </select>
        <p class="reset_btn">
            <a type="btn" class="btn category_reset_btn"href="{{ route('userPostIndex') }}">リセット</a>
        </p>
        </div>
        </div>
        <div class="posts_list">
            <div class="item_block">
                @foreach($posts_lists as $post_list)
                <div class="item">
                    <ul class="item_contents">
                        <li class="item_post_username">{{ $post_list->user->username }}さんが</li>
                        <li class="item_post_date">{{ $post_list->event_at->format('Y年m月d日') }}に投稿しました。
                        </li>

                        <li class="item_title">
                             <a class="item_title" href="{{ route('post_show',[$post_list->id]) }}">
                            {{ $post_list->title }}
                        </a></li>
                        <li class="item_sub_category">
                            <i class="fas fa-tags"></i>{{ $post_list->postSubCategory->sub_category }}</li>
                        <li class="item_favorite_count">
                        <i class="fas fa-heart" style="color: red;"></i>　{{ $post_list->userPostFavoriteRelation->count() }}
                        </li>
                        <li class="comment_count"><i class="fas fa-comment-dots"></i>　{{ $post_list->postComments->count() }}
                        </li>
                        <li class="item_visitor_count"><i class="fas fa-eye"></i>　{{ $post_list->ActionLog->count() }}view
                        </li>
                </ul>
                </div>
                @endforeach
            </div>
            <div class="paginate">
                <li class="page-item">
                    {{ $posts_lists->links() }}
                </li>
            </div>
        </div>

    </div>
</div>






@endsection
@include('layouts.login.footer')
