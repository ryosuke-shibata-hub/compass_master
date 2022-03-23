@extends('layouts.login.common')
@section('title','ユーザー編集')
@include('layouts.login.header')
@section('contents')

<div class="main_content">
    <div class="">
        <p>
            <a class="btn btn-primary" style="margin-left: 20px;"
                href="{{ route('csv_download') }}"target="_blank">
                CSVダウンロード</a>
        </p>
        <div class="col-md-12 col-md-offset-2">
                <table class="table table-striped panel-body">
                <thead>
                    <tr>
                    <th></th>
                    <th></th>
                    <th>UserID</th>
                    <th>Logo</th>
                    <th>UserName</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Gender</th>
                    <th>Birthday</th>
                    <th width="100">&nbsp;</th>
                    <th width="100">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user_list as $users)
                    <tr>
                        <td></td>
                        <td></td>
                        <td>{{ $users->id }}</td>
                        <td>
                            @if(!empty($users->logo))
                            <img style="width:20px;" src="/uploads/{{ $users->logo }}">
                            </li>
                        @else
                            <img style="width:20px;" src="/uploads/user-regular-2.svg">
                        @endif
                        </td>
                        <td>{{ $users->username_kanji }}</td>
                        <td>{{ $users->email }}</td>
                        @if($users->admin_role == 0)
                            <td>国語教師</td>
                        @elseif($users->admin_role == 5)
                            <td>数学教師</td>
                        @elseif($users->admin_role == 10)
                            <td>生徒</td>
                        @elseif($users->admin_role == 15)
                            <td>管理者</td>
                        @endif
                        @if($users->gender == '0')
                            <td>男性</td>
                        @elseif($users->gender == '1')
                            <td>女性</td>
                        @endif
                        <td>{{ $users->birthday->format('Y年m月d日') }}</td>
                        <td>
                            <form action="{{ route('admin_user.destroy',[$users->id]) }}"
                            method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger btn-dell">
                                <i class="fas fa-trash-alt"></i>delete
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('Admin_user_edit',[$users->id]) }}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-edit"></i>edit
                            </button>
                            </form>
                        </td>
                    </tr>

                    @endforeach
                    </table>
                </tbody>
                <div class="paginate">
                <li class="page-item" style="margin-left: 50px;">
                    {{ $user_list->links() }}
                </li>
            </div>
        </div>
    </div>

</div>
@endsection
@include('layouts.login.footer')
