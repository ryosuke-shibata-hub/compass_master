@extends('layouts.login.common')
@section('title','トップページ')
@include('layouts.login.header')
@section('contents')

<div class="main_content">
            <div class="posts_list">
                <span class="view_count_title">閲覧数が多い投稿</span>
                @foreach($view_count as $post_list)
                <div class="item">
                    <ul class="item_contents">
                        @if(!empty($post_list->user->logo))
                            <li class="item_post_username">
                            <img style="width:15px;" src="/uploads/{{ $post_list->user->logo }}">
                            {{ $post_list->user->username_kanji }}さんが
                            </li>
                        @else
                            <li class="item_post_username">
                            <img style="width:15px;" src="/uploads/user-regular-2.svg">
                            {{ $post_list->user->username_kanji }}さんが
                            </li>
                        @endif

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
                <div class="paginate">
                    <li class="page-item" style="margin-left: 130px; margin-top:-50px;">
                        {{ $view_count->links() }}
                    </li>
                </div>
            </div>
            <div class="posts_list">
                <span class="view_count_title">いいね数が多い投稿</span>
                @foreach($post_favorite_count as $post_list)
                <div class="item">
                    <ul class="item_contents">
                        @if(!empty($post_list->user->logo))
                            <li class="item_post_username">
                            <img style="width:15px;" src="/uploads/{{ $post_list->user->logo }}">
                            {{ $post_list->user->username_kanji }}さんが
                            </li>
                        @else
                            <li class="item_post_username">
                            <img style="width:15px;" src="/uploads/user-regular-2.svg">
                            {{ $post_list->user->username_kanji }}さんが
                            </li>
                        @endif

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
                <div class="paginate">
                    <li class="page-item" style="margin-left: 130px; margin-top:-50px;">
                        {{ $post_favorite_count->links() }}
                    </li>
                </div>
            </div>

            <div class="posts_list">
                <span class="view_count_title">コメント数が多い投稿</span>
                @foreach($post_comment_count as $post_list)
                <div class="item">
                    <ul class="item_contents">
                        @if(!empty($post_list->user->logo))
                            <li class="item_post_username">
                            <img style="width:15px;" src="/uploads/{{ $post_list->user->logo }}">
                            {{ $post_list->user->username_kanji }}さんが
                            </li>
                        @else
                            <li class="item_post_username">
                            <img style="width:15px;" src="/uploads/user-regular-2.svg">
                            {{ $post_list->user->username_kanji }}さんが
                            </li>
                        @endif

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
                <div class="paginate">
                    <li class="page-item" style="margin-left: 130px; margin-top:-50px;">
                        {{ $post_comment_count->links() }}
                    </li>
                </div>
            </div>


</div>
@endsection
@include('layouts.login.footer')
