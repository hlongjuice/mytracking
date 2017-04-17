<div class="panel panel-default">
    <div class="panel panel-heading">
        <div class="panel-title">
            ผู้ใช้งาน
        </div>
    </div>
    <div class="panel-body">
        <div class="col-xs-12">
            <div class="text-center">
                <img width="100px" height="100px" src="{{asset('images/members/member_profile.png')}}">
                <div class="member-detail">
                    <p>{{Auth::user()->name}} {{Auth::user()->surname}}</p>
                    <a href="{{url('/logout')}}" class="btn btn-danger btn-block">ออกจากระบบ</a>
                </div>
            </div>

        </div>
    </div>
</div>
