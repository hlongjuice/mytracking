@extends('admin.layouts.master_left_sidebar')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                ประวัติการให้บริการ
            </div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
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
                            <td>{{$package->status->title}}</td>
                            <td>{{$package->sender_address}}</td>
                            <td>{{$package->receiver_address}}</td>
                            <td>{{$package->updated_at}}</td>
                            <td><a href="{{route('admin.package.show',$package->id)}}" class="btn btn-info">ดูลายละเอียด</a></td>

                        </tr>
                        <?php $row_number++?>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-xs-12 col-md-12">{{$packages->links()}}</div>
        </div>
    </div>
    @endsection