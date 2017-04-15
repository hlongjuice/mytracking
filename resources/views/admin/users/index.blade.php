@extends('admin.layouts.master_left_sidebar')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                รายชื่อสมาชิก
            </div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>ลำดับ</th>
                        <th>username</th>
                        <th>ชื่อ</th>
                        <th>ประเภท</th>
                    </tr>
                    <?php $row_number=($members->currentPage()*$members->perPage())-($members->perPage()-1)?>
                    @foreach($members as $member)
                    <tr>
                        <td>{{$row_number}}</td>
                        <td>{{$member->username}}</td>
                        <td>{{$member->name}}</td>
                        <td>{{$member->memberType->type}}</td>
                    </tr>
                        <?php $row_number++?>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
    @endsection