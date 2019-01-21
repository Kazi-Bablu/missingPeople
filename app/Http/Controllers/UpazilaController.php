<?php

namespace App\Http\Controllers;

use App\District;
use App\Upazila;
use Illuminate\Http\Request;
use Session;

class UpazilaController extends Controller
{
    /**
     * UpazilaController constructor.
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
        $upazilas = Upazila::join('districts','districts.id','upazilas.district_id')
            ->select(
                'upazilas.id',
                'upazilas.upazila_name',
                'districts.district_name'
            )->paginate(5);

        return view('upazila.view',compact('upazilas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = District::all();

        return view('upazila.create', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  dd($request->all());
        $this->validate($request, [
            'district_id' => 'required',
            'upazila_name' => 'required|unique:upazilas,upazila_name'
        ]);

        $upazila = new Upazila();
        $upazila->district_id = $request->district_id;
        $upazila->upazila_name = $request->upazila_name;
        $upazila->save();

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
        $districts = District::all();
        $upazilaById = Upazila::find($id);

        return view('upazila.edit',compact('upazilaById','districts'));
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
            'district_id'=>'required',
            'upazila_name'=>'required'
        ]);

        $upazilaById=Upazila::find($id);
        $upazilaById->district_id=$request->district_id;
        $upazilaById->upazila_name=$request->upazila_name;
        $upazilaById->save();

        Session::flash('message', 'Upazila update successfully!');
        return redirect('/upazila/view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $upazilaById = Upazila::find($id);
        $upazilaById->delete();
        Session::flash('message', 'Upazila delete successfully!');
        return back();
    }
}
