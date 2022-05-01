@extends('layouts.login.common')
@section('title','マイタス')
@include('layouts.login.header')
@section('contents')

<div class="home_index_page">
    <div class="home_layouts">
        <div class="panel-body">
            {{-- @include('common.erros') --}}

            <form action="{{ route('task_store') }}" method="POST" class="form-horizonal">
                @csrf
                <div class="form-group">
                    <label for="task-name" class="col-sm-3 control-label">MyTask</label>
                    <div class="col-sm-6">
                        <input type="text" name="name" id="task-name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-plus"></i> タスクを追加する
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@include('layouts.login.footer')
