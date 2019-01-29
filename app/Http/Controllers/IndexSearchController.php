<?php

namespace App\Http\Controllers;

use App\MissingPeople;
use Illuminate\Http\Request;

class IndexSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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

    /**
     * @param Request $request
     */
    public function indexSearch(Request $request)
    {
       // search_name

        $missingPeoples = MissingPeople::join('divisions','divisions.id','missing_peoples.division_id')
            ->join('districts','districts.id','missing_peoples.district_id')
            ->join('upazilas','upazilas.id','missing_peoples.upazila_id')
            ->join('users','users.id','missing_peoples.created_by')
            ->where('missing_peoples.is_approve','=','Approve')
            ->orderBy('missing_peoples.missing_person_name');

        $search_name=$request->input('search_name');

        if(!empty($search_name))
        {
            $missingPeoples->where('missing_peoples.missing_person_name','LIKE','%'.$search_name.'%');
        }
        $missingPeoples=$missingPeoples->paginate(5);

        return view('indexSearchDetails',compact('missingPeoples'));

    }

}
