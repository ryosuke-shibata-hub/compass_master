@extends('layouts.login.common')
@section('title','マイタスク')
@include('layouts.login.header')
@section('contents')

<div class="home_index_page">
    <div class="home_layouts">
        <div class="panel-body pb-5">
            @include('layouts.login.errors')

            <form action="{{ route('task_store') }}" method="POST" class="form-horizonal">
                @csrf
                <strong>新規タスク</strong>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="text" name="name" id="task-name" class="form-control">
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-outline-secondary">
                            <i class="fa fa-plus"></i> タスクを追加する
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                タスク一覧
            </div>
            <div class="panel-body">
                <table class="table table-striped panel-body">
                    <thead>
                        <tr>
                            <th>タイトル</th>
                            <th>登録日</th>
                            <th width="100">&nbsp;</th>
                            <th width="100">&nbsp;</th>
                            <th>状態</th>
                            <th width="150">操作</th>
                            <th width="100">&nbsp;</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->name }}</td>
                                <td>{{ $task->created_at }}</td>
                                <td></td>
                                <td></td>
                                <td>
                                    @if($task->finished_flg == '1')
                                        完了
                                    @else
                                        未完了
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('task_update',[$task->id]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        @if ($task->finished_flg == '1')
                                            <button type="submit" id="update-task-{{ $task->id }}" class="btn btn-secondary" name="finished_flg" value="0">未完了にする
                                            </button>
                                        @else
                                            <button type="submit" id="update-task-{{ $task->id }}" class="btn btn-success" name="finished_flg" value="1">完了済にする
                                            </button>
                                        @endif
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('task_delete',[$task->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
                                            <i class="fa fa-btn fa-trash"></i>削除
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@include('layouts.login.footer')
