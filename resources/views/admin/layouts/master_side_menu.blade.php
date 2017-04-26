<div class="panel panel-default">
    <div class="panel panel-heading">
        <div class="panel-title">
            ผู้ใช้งาน
        </div>
    </div>
    <div class="panel-body">
        <div class="col-xs-12">
            <div class="text-center">
                <div class="profile" align="center">
                    @if(Auth::user()->image==null)
                        @if(Auth::user()->member_type_id==2)
                            <img class="thumbnail" src="{{asset('images/members/driver.png')}}">
                            @endif
                        <img class="thumbnail" src="{{asset('images/members/member_profile.png')}}">
                    @else
                        <img class="thumbnail" src="{{asset(Auth::user()->image)}}">
                    @endif
                </div>
                <div class="member-detail">
                    <p>{{Auth::user()->name}} {{Auth::user()->surname}}</p>
                    <a href="{{url('/logout')}}" class="btn btn-danger btn-block">ออกจากระบบ</a>
                </div>
            </div>

        </div>
    </div>
</div>
