@extends('site.layouts.master_left_sidebar')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">

            </div>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>รหัสบริการ</th>
                    <th>สถานะ</th>
                    <th>ที่อยู่ผู้ส่ง</th>
                    <th>ที่อยู่ผู้รับ</th>
                    <th>วันที่</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                <?php $row_number=($packages->currentPage()*$packages->perPage())-($packages->perPage()-1)?>
                @foreach($packages as $package)
                    <tr>
                        <td>{{$row_number}}</td>
                        <td>{{$package->service_id}}</td>
                        <td>{{$package->status->title}}</td>
                        <td>{{$package->sender_address}}</td>
                        <td>{{$package->receiver_address}}</td>
                        <td>{{$package->updated_at}}</td>
                        <td><a class="btn btn-info" href="{{route('package.history.show',$package->id)}}">ดูลายละเอียด</a></td>

                    </tr>
                    <?php $row_number++?>
                @endforeach
                </tbody>
            </table>
            <div class="col-xs-12 col-md-12">{{$packages->links()}}</div>
        </div>
    </div>
    @endsection