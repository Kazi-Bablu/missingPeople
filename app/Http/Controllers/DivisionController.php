<?php

namespace App\Http\Controllers;

use App\Division;
use Illuminate\Http\Request;
use Session;

class DivisionController extends Controller
{
    /**
     * DivisionController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisions = Division::paginate(10);

        return view('division.view',compact('divisions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('division.create');
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
           'division_name'=>'required|unique:divisions,division_name'
        ]);

        $division= new Division();
        $division->division_name=$request->division_name;
        $division->save();

        Session::flash('message','Division add successfully!');
        return redirect()->back();
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
        $divisionById = Division::find($id);

        return view('division.edit',compact('divisionById'));
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
        $this->validate($request,[
            'division_name'=>'required|unique:divisions,division_name'
        ]);

        $divisionById = Division::find($id);
        $divisionById->division_name=$request->division_name;
        $divisionById->save();

        Session::flash('message','Division update successfully!');
        return redirect('/division/view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $divisionById = Division::find($id);
        $divisionById->delete();
        Session::flash('message','Division delete successfully!');
        return back();
    }
}
