@extends('site.layouts.master_left_sidebar')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
               สถานะการจัดส่ง
            </div>
        </div>
        <form method="post" action="{{route('driver.package.update',$package->id)}}">
            <input value="PUT" type="hidden" name="_method" >
            {{csrf_field()}}

            <div class="panel-body">
                <h4><span class="label label-{{$package->status->color}}">{{$package->status->title}}</span></h4>
                <div class=" input">


                    {{--LatLng Start Position--}}
                    <input value="{{$package->lat_start}}" id="txtLatStart" type="text" class="hidden">
                    <input value="{{$package->lng_start}}" id="txtLngStart" type="text" class="hidden">

                    {{--Start Position--}}
                    @if(in_array($package->status_id,[1,2]))
                        <input value="{{$package->lat_start}},{{$package->lng_start}}" id="txtSource" type="text" name="txtSource" class="hidden">
                    @elseif(in_array($package->status_id,[3,4]))
                        <input value="{{$package->staff_lat}},{{$package->staff_lng}}" id="txtSource" type="text" name="txtSource" class="hidden">
                    @endif

                    {{--Destination Position--}}
                    <input value="{{$package->lat_end}},{{$package->lng_end}}" id="txtDestination" type="text" name="destination" class="hidden">

                    {{--Product Weight--}}
                    <input value="{{$package->product_weight}}" type="number" id="weight" name="weight" class="hidden">

                    {{--Result Position--}}
                    <input id="input_origin" value="{{$package->staff_lat}},{{$package->staff_lng}}" class="hidden">
                    <input id="input_destination" value="{{$package->lat_start}},{{$package->lng_start}}" class="hidden">
                    <input type="text" value="{{$package->staff_lat}}" id="driver_position_lat" name="driver_position_lat" class="hidden" >
                    <input type="text" value="{{$package->staff_lng}}" id="driver_position_lng" name="driver_position_lng" class="hidden">

                </div>
                <div class="ln_solid"></div>
                {{--Sender Location--}}
                @if($package->status_id==2)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                               ตำแหน่งรถสินค้าและจุดรับสินค้า
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div id="processTwoMap" style="width:100%; height:500px;"></div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </form>

    </div>

    {{--Direction Map--}}
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                ตำแหน่งและเส้นทางการส่งสินค้า
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div id="dvMap" style="width:100%; height:500px;"></div>
            </div>
        </div>
    </div>

    {{--Package Info--}}
    <form id="tracking_form" action="{{route('package.store')}}" method="POST">
        {{csrf_field()}}
        <div style="margin-top:20px;" class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    ลายละเอียด
                </div>
            </div>
            <div class="panel-body">
                {{--Lat/Lng--}}
                <table class="hidden table">
                    <thead>
                    <tr class="active">
                        <th></th>
                        <th>ละติจูด</th>
                        <th>ลองติจูด</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>ต้นทาง</td>
                        <td><input class="form-control" readonly value=""  name="lat_start" id="lat_start" type="text"></td>
                        <td><input class="form-control" readonly value=""  name="lng_start" id="lng_start" type="text"></td>
                    </tr>
                    <tr>
                        <td>ปลายทาง</td>
                        <td> <input class="form-control" readonly value=""  name="lat_end" id="lat_end" type="text"></td>
                        <td><input class="form-control" readonly value=""  name="lng_end" id="lng_end" type="text"></td>
                    </tr>
                    </tbody>
                </table>
                <div class="line-dot"></div>
                <table class="table">
                    <tbody>
                    {{--Distance Per Price--}}
                    <tr class="border-none">
                        <td>อัตรค่าบริการต่อระยะทาง</td>
                        <td><input class="form-control" readonly value="{{$package_price->distance_price}}"  name="distance_price" id="distance_price" type="text"></td>
                        <td>บาท/กม.</td>
                    </tr>
                    {{--Distance Per Weight--}}
                    <tr class="border-none">
                        <td>อัตรค่าบริการต่อน้ำหนัก</td>
                        <td><input class="form-control" readonly value="{{$package_price->weight_price}}"  name="weight_price" id="weight_price" type="text"></td>
                        <td>บาท/กก.</td>
                    </tr>
                    {{--Distance--}}
                    <tr>
                        <td>ระยะทางทั้งหมด</td>
                        <td><input class="form-control" readonly value=""  name="distance" id="distance" type="text"></td>
                        <td>กิโลเมตร</td>
                    </tr>
                    {{--Distance--}}
                    <tr class="border-none">
                        <td>ระยะทางคงเหลือ</td>
                        <td><input class="form-control" readonly value=""  name="current_distance" id="current_distance" type="text"></td>
                        <td>กิโลเมตร</td>
                    </tr>
                    {{--Product Weight--}}
                    <tr class="border-none">
                        <td>น้ำหนัก</td>
                        <td><input class="form-control" readonly value=""  name="result_weight" id="result_weight" type="text"></td>
                        <td>กิโลกรัม</td>
                    </tr>
                    {{--Total Price--}}
                    <tr>
                        <td>รวมค่าใช่จ่าย</td>
                        <td><input class="form-control" readonly value=""  name="total_price" id="total_price" type="text"></td>
                        <td>บาท</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        {{--Sender Info--}}
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    ข้อมูลผู้ส่ง
                </div>
            </div>
            <div class="panel-body">
                <div class="form-horizontal">
                    {{--Name--}}
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-md-3">ชื่อ/สกุล</label>
                        <div class="col-xs-12 col-md-6">
                            <input readonly value="{{$package->sender}}" id="sender_name" type="text" name="sender_name" class="form-control">
                        </div>
                    </div>
                    {{--Phone--}}
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-md-3">เบอร์โทร</label>
                        <div class="col-xs-12 col-md-6">
                            <input readonly value="{{$package->sender_phone}}" id="sender_phone" type="text" name="sender_phone" class="form-control">
                        </div>
                    </div>
                    {{--Address--}}
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-md-3">ที่อยู่</label>
                        <div class="col-xs-12 col-md-6">
                            <textarea  readonly class="form-control" name="sender_address" id="sender_address" form="tracking_form">{{$package->sender_address}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--Receiver Info--}}
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    ข้อมูลผู้รับ
                </div>
            </div>
            <div class="panel-body">
                <div class="form-horizontal">
                    {{--Name--}}
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-md-3">ชื่อ/สกุล</label>
                        <div class="col-xs-12 col-md-6">
                            <input readonly value="{{$package->receiver}}" id="receiver_name" type="text" name="receiver_name" class="form-control">
                        </div>
                    </div>
                    {{--Phone--}}
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-md-3">เบอร์โทร</label>
                        <div class="col-xs-12 col-md-6">
                            <input readonly value="{{$package->receiver_phone}}" id="receiver_phone" type="text" name="receiver_phone" class="form-control">
                        </div>
                    </div>
                    {{--Address--}}
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-md-3">ที่อยู่</label>
                        <div class="col-xs-12 col-md-6">
                                            <textarea readonly class="form-control" name="receiver_address" id="receiver_address" form="tracking_form">{{$package->receiver_address}}
                                            </textarea>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection
@section('side_menu_top')
    @include('site.layouts.icon_details')
@endsection
@section('script')
    <script type="text/javascript">
        var driver_icon=null;
        var driver_marker_move=false;
        var destination_marker_move=false;
        /*Setting Service Price from database for Calculating*/
        var weight_per_price="{{$package_price->weight_price}}";
        var distance_per_price="{{$package_price->distance_price}}";
        var home_icon={
            url:'{{asset('images/map-icon/home3.svg')}}'
        };
        var p2_driver_icon={
            url:'{{asset('images/map-icon/delivery-truck.svg')}}'
        };
        var package_icon={
            url:'{{asset('images/map-icon/package2.svg')}}'
        };

        if('{{$package->status_id}}'==1 || '{{$package->status_id}}'==2){
            driver_icon={
                url:'{{asset('images/map-icon/package2.svg')}}'
            };
        }
        else if('{{$package->status_id}}'==3){
            driver_icon={
                url:'{{asset('images/map-icon/delivery-truck.svg')}}'
            };
        }
        else{
            driver_icon={
                url:'{{asset('images/map-icon/success.svg')}}'
            }
        }
        getRoute();
        if('{{$package->status_id}}'==2){
            var p2_driver_marker_move=false;
            getProcessTwoRoute();
        }
    </script>
@endsection