@extends('site.layouts.master_left_sidebar')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">

        </div>
        <div class="panel-body">
            <div class="col-xs-12">
                <a href="{{route('member.create')}}">สมัครสมาชิก</a>
                <a href="{{route('package.index')}}">tracking</a>
                <a href="{{route('admin.index')}}">Admin</a>
                @if (Auth::guest())
                    <a href="{{url('/login')}}">เข้าสู่ระบบ</a>
                @else
                    {{Auth::user()->username}}
                    <a href="{{route('package.history.index')}}">ประวัติการใช่บริการ</a>
                    <a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>ออกจากระบบ</a>
                @endif
            </div>
        </div>
    </div>



    @endsection