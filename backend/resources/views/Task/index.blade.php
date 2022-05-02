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
                            {{-- <th width="100">&nbsp;</th> --}}
                            {{-- <th width="100">&nbsp;</th> --}}
                            <th width="100">操作</th>
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
                                    <form action="{{ route('task_delete',[$task->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-primary">
                                            </i>完了済
                                        </button>
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
