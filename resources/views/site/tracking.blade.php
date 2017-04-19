@extends('site.layouts.master_left_sidebar')
@section('content')
    <div>
        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panel-title">
                    My Tracking
                </div>
            </div>

            <div class="panel-body">
                <div class="form-horizontal">
                    {{--Source Input--}}
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-md-3">ต้นทาง</label>
                            <div class="col-xs-12 col-md-6">
                                <input id="txtSource" type="text" name="start" class="form-control">
                            </div>
                        </div>
                    {{--Destination Input--}}
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-md-3">ปลายทาง</label>
                            <div class="col-xs-12 col-md-6">
                                <input id="txtDestination" type="text" name="destination" class="form-control">
                            </div>
                        </div>
                    <div class="form-inline">

                    </div>
                    {{--Product Weight Input--}}
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-md-3">น้ำหนักสินค้า</label>
                        <div class="col-xs-12 col-md-6">
                            <div class="input-group">
                                <input value="0" type="number" id="weight" name="weight" class="form-control">
                                <div class="input-group-addon">กก.</div>
                            </div>
                        </div>
                    </div>
                    {{--Detail--}}
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-md-3">ลายละเอียด</label>
                        <div class="col-xs-12 col-md-6">
                            <textarea id="detail" name="detail" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    {{--Calculate Directions--}}
                    <div class="form-group">
                        <div class="col-xs-12 col-md-6 col-md-offset-3">
                            {{Form::button('ค้นหาเส้นทาง',['class'=>'btn btn-success','onclick'=>'getRoute()'])}}
                        </div>
                    </div>
                    {{--<div class="form-group">--}}
                        {{--<div class="col-xs-12 col-md-6 col-md-offset-3">--}}
                            {{--{{Form::button('ตำแหน่ง',['class'=>'btn btn-success','onclick'=>'getCurrent()'])}}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
                <div class="row">
                    <div id="dvMap" style="width:100%; height:500px;"></div>
                </div>
            </div>
    </div>
        <form id="tracking_form" action="{{route('package.store')}}" method="POST">
                {{csrf_field()}}
                <div style="margin-top:20px;" class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            ผลลัพธ์
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
{{----}}
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
                                <td>ระยะทาง</td>
                                <td><input class="form-control" readonly value=""  name="distance" id="distance" type="text"></td>
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
                                    <input id="sender_name" type="text" name="sender_name" class="form-control">
                                </div>
                            </div>
                            {{--Phone--}}
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-md-3">เบอร์โทร</label>
                                <div class="col-xs-12 col-md-6">
                                    <input id="sender_phone" type="text" name="sender_phone" class="form-control">
                                </div>
                            </div>
                            {{--Address--}}
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-md-3">ที่อยู่</label>
                                <div class="col-xs-12 col-md-6">
                                    <textarea class="form-control" name="sender_address" id="sender_address" form="tracking_form"></textarea>
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
                                    <input id="receiver_name" type="text" name="receiver_name" class="form-control">
                                </div>
                            </div>
                            {{--Phone--}}
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-md-3">เบอร์โทร</label>
                                <div class="col-xs-12 col-md-6">
                                    <input id="receiver_phone" type="text" name="receiver_phone" class="form-control">
                                </div>
                            </div>
                            {{--Address--}}
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-md-3">ที่อยู่</label>
                                <div class="col-xs-12 col-md-6">
                                    <textarea class="form-control" name="receiver_address" id="receiver_address" form="tracking_form"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <button style="margin-bottom: 25px;" class="col-xs-12 col-md-offset-9 col-md-3 btn btn-success" type="submit">ยืนยันรายการ</button>
                </div>
            </form>
    </div>
@endsection
@section('script')
    <script>
        /*Setting Service Price from database for Calculating*/
        var weight_per_price="{{$package_price->weight_price}}";
        var distance_per_price="{{$package_price->distance_price}}";
    </script>
@endsection