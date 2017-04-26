@if(Auth::user())
<div class="panel panel-default">
    <div class="panel panel-heading">
        <div class="panel-title">
            ผู้ใช้งาน
        </div>
    </div>
    <div class="panel-body">
        <div class="col-xs-12">
            <div class="text-center">
                <div align="center">
                    @if(Auth::user()->image==null)
                    <img class="thumbnail" width="150px" height="150px" src="{{asset('images/members/member_profile.png')}}">
                        @else
                        <img class="thumbnail" width="150px" height="150px" src="{{asset(Auth::user()->image)}}">
                        @endif
                </div>

                <div class="member-detail">
                    <p>{{Auth::user()->name}} {{Auth::user()->surname}}</p>

                    <a href="{{route('member.edit',Auth::user()->id)}}" class="">แก้ไขข้อมูลส่วนตัว</a>
                    <a href="{{url('/logout')}}" class="btn btn-danger btn-block">ออกจากระบบ</a>
                </div>
            </div>

        </div>
    </div>
</div>
    @else
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                ผู้ใช้งานทั่วไป
            </div>
        </div>
    </div>
    @endif
