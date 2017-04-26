<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            ลายละเอียดคนส่งของ
        </div>
    </div>
    <div class="driver-details-body panel-body">

        <div align="center">
            <img class="thumbnail" width="200px" height="200px" src="{{asset('images/members/member_profile.png')}}">
        </div>
        {{--Name--}}
        <div class="row">
            <div class="col-xs-4">ชื่อ/สกุล </div>
            <div class="col-xs-5">: {{$driver->name}} {{$driver->surname}}</div>
        </div>
        {{--Car--}}
        <div class="row">
            <div class="col-xs-4">รถที่ใช้ </div>
            @if($driver->carDetails)
                <div class="col-xs-5">: {{$driver->carDetails->car}} {{$driver->carDetails->model}}</div>
            @endif
        </div>
        {{--Car Colr--}}
        <div class="row">
            <div class="col-xs-4">สี </div>
            @if($driver->carDetails)
                <div class="col-xs-5">: {{$driver->carDetails->color}}</div>
            @endif
        </div>
        {{--Car Plate Number--}}
        <div class="row">
            <div class="col-xs-4">ป้ายทะเบียน </div>
            @if($driver->carDetails)
                <div class="col-xs-5">: {{$driver->carDetails->plate}}</div>
            @endif
        </div>
    </div>
</div>