@extends('site.layouts.master_left_sidebar')
@section('content')
    {{--Customer Menu--}}
    <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    ผู้ใช้ทั่วไป
                </div>
            </div>
            <div class="panel-body">
                {{--Tracking--}}
                <div class="col-xs-12 col-md-4 admin-menu">
                    <a href="{{route('package.index')}}">
                        <div class="icon">
                            <i class="fa fa-bookmark"></i>
                        </div>
                        <div class="title">
                            Tracking
                        </div>
                        <div class="highlight bg-color-orange"></div>
                    </a>
                </div>
                {{--Tracking Histroty--}}
                <div class="col-xs-12 col-md-4 admin-menu">
                    <a href="{{route('package.history.index')}}">
                        <div class="icon">
                            <i class="fa fa-bookmark"></i>
                        </div>
                        <div class="title">
                            ประวัติการใช้บริการ
                        </div>
                        <div class="highlight bg-color-orange"></div>
                    </a>
                </div>

            </div>
        </div>
    {{--Driver Menu--}}
    @if(in_array(Auth::user()->member_type_id,[2,3]) )
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                ผู้ส่งของ
            </div>
        </div>
        <div class="panel-body">
                {{--Service Order--}}
                <div class="col-xs-12 col-md-4 admin-menu">
                    <a href="{{route('admin.package.index')}}">
                        <div class="icon">
                            <i class="fa fa-bookmark"></i>
                        </div>
                        <div class="title">
                            Service Order
                        </div>
                        <div class="highlight bg-color-orange"></div>
                    </a>
                </div>
                {{--Service History--}}
                <div class="col-xs-12 col-md-4 admin-menu">
                    <a href="{{route('admin.package.service_history.index')}}">
                        <div class="icon">
                            <i class="fa fa-bookmark"></i>
                        </div>
                        <div class="title">
                            ประวัติการให้บริการ
                        </div>
                        <div class="highlight bg-color-orange"></div>
                    </a>
                </div>
        </div>
    </div>
    @endif
    {{--Admin Menu--}}
    @if(Auth::user()->member_type_id==3)
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                ผู้ดูแลระบบ
            </div>
        </div>
        <div class="panel-body">

            {{--Package-Price--}}
            <div class="col-xs-12 col-md-4 admin-menu">
                <a href="{{route('admin.package_price.edit',$package_price->id)}}">
                    <div class="icon">
                        <i class="fa fa-bookmark"></i>
                    </div>
                    <div class="title">
                        ตั้งราคาค่าบริการ
                    </div>
                    <div class="highlight bg-color-orange"></div>
                </a>
            </div>
            {{--Add New Member--}}
            <div class="col-xs-12 col-md-4 admin-menu">
                <a href="{{route('member.create')}}">
                    <div class="icon">
                        <i class="fa fa-bookmark"></i>
                    </div>
                    <div class="title">
                        เพิ่มผู้ใช้งาน
                    </div>
                    <div class="highlight bg-color-orange"></div>
                </a>
            </div>
            {{--View All Members--}}
            <div class="col-xs-12 col-md-4 admin-menu">
                <a href="{{route('admin.members.index')}}">
                    <div class="icon">
                        <i class="fa fa-bookmark"></i>
                    </div>
                    <div class="title">
                        ข้อมูลสมาชิกทั้งหมด
                    </div>
                    <div class="highlight bg-color-orange"></div>
                </a>
            </div>




        </div>
    </div>
    @endif
@endsection