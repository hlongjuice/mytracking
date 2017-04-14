<?php

namespace App\Http\Controllers\Site;

use App\Models\Member;
use App\Models\MemberType;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $member_types=MemberType::all();
        if(Auth::guest())
            return view('site.users.register');
        else if(Auth::user()->member_type_id==3)
            return view('admin.users.register')->with('member_types',$member_types);

        return view('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'username'=>'required|unique:member',
            'password'=>'required|min:4|confirmed',
            'password_confirmation'=>'required|min:4',
        ],[
            'username.required'=>'กรุณากรอก Username',
            'username.unique'=>'username นี้มีการใช้งานแล้ว',
            'password.confirmed'=>'รหัสผ่านไม่ตรงกัน',
            'password.required'=>'กรุณากรอกรหัสผ่าน'
        ]);
        $member=new Member();

        if(Auth::user()->member_type_id==3)//If Admin add new member,3 is Admin
            $member->member_type_id=$request->input('member_type');
        else
            $member->member_type_id=1;//1 is normal member

        $member->username=$request->input('username');
        $member->password=bcrypt($request->input('password'));
        $member->name=$request->input('name');
        $member->surname=$request->input('surname');
        $member->gender=$request->input('gender');
        $member->tel=$request->input('tel');
        $member->address=$request->input('address');
        $member->province=$request->input('province');
        $member->postcode=$request->input('postcode');
        $member->save();

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member=Member::where('id',$id)->first();

        return view('site.users.info')->with('member',$member);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $member=Member::where('id',$id)->first();
        $member->name=$request->input('name');
        $member->surname=$request->input('surname');
        $member->gender=$request->input('gender');
        $member->tel=$request->input('tel');
        $member->address=$request->input('address');
        $member->save();

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
