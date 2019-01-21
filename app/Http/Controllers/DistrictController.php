<?php

namespace App\Http\Controllers;

use App\District;
use App\Division;
use Illuminate\Http\Request;
use Session;

class DistrictController extends Controller
{
    /**
     * DistrictController constructor.
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

        $districts=District::join('divisions','divisions.id','districts.division_id')
            ->select(
                'districts.id',
                'districts.district_name',
                'divisions.division_name'
            )->paginate(10);

        return view('district.view',compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::all();
        return view('district.create',compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'division_id'=>'required',
            'district_name' => 'required|unique:districts,district_name'
        ]);

        $district = new District();
        $district->division_id=$request->division_id;
        $district->district_name = $request->district_name;
        $district->save();

        Session::flash('message', 'District add successfully!');
        return redirect()->back();
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
        $districtById = District::find($id);

        return view('district.edit',compact('districtById','divisions'));
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
            'division_id'=>'required',
            'district_name'=>'required|unique:districts,district_name',
        ]);

        $districtById = District::find($id);
        $districtById->division_id=$request->division_id;
        $districtById->district_name=$request->district_name;
        $districtById->save();

        Session::flash('message', 'District update successfully!');
        return redirect('/district/view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $districtById = District::find($id);
        $districtById->delete();
        Session::flash('message','District delete successfully!');
        return back();
    }
}
