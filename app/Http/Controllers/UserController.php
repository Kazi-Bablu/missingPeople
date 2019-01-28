<?php

namespace App\Http\Controllers;

use App\District;
use App\Division;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->user_role == 'Admin') {
            $users = User::leftJoin('divisions', 'divisions.id', 'users.division_id')
                ->leftJoin('districts', 'districts.id', 'users.district_id')
                ->leftJoin('upazilas', 'upazilas.id', 'users.upazila_id')
                ->select(
                    'users.id',
                    'users.name',
                    'users.email',
                    'users.user_role',
                    'users.occupation',
                    'divisions.division_name',
                    'districts.district_name',
                    'upazilas.upazila_name'
                )->paginate(5);

            return view('user.view',compact('users'));
            //dd($users);
        } else {
            $users = User::leftJoin('divisions', 'divisions.id', 'users.division_id')
                ->leftJoin('districts', 'districts.id', 'users.district_id')
                ->leftJoin('upazilas', 'upazilas.id', 'users.upazila_id')
                ->where('users.id',auth()->id())
                ->select(
                    'users.id',
                    'users.name',
                    'users.email',
                    'users.user_role',
                    'users.occupation',
                    'divisions.division_name',
                    'districts.district_name',
                    'upazilas.upazila_name'
                )->paginate(1);

            return view('user.view',compact('users'));
            //dd($users);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $divisions = Division::all();
        $userById = User::find($id);

        return view('user.edit',compact('divisions','userById'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'occupation'=>'required',
            'division_id'=>'required',
            'district_id'=>'required',
            'upazila_id'=>'required'
        ]);
       // dd($request->all());
        $userById = User::find($id);
        $userById->name=$request->name;
        $userById->email=$request->email;
        $userById->occupation=$request->occupation;
        $userById->division_id=$request->division_id;
        $userById->district_id=$request->district_id;
        $userById->upazila_id=$request->upazila_id;
        $userById->save();

        Session::flash('message','User update successfully!');
        return redirect('/user/view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userById = User::find($id);
        $userById->delete();
        Session::flash('message','user delete successfully!');
        return back();
    }
}
