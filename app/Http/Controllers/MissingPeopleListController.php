<?php

namespace App\Http\Controllers;

use App\Division;
use Illuminate\Http\Request;
use App\MissingPeople;

class MissingPeopleListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $divisions = Division::all();
        $missingPeoples = MissingPeople::join('divisions', 'divisions.id', 'missing_peoples.division_id')
            ->join('districts', 'districts.id', 'missing_peoples.district_id')
            ->join('upazilas', 'upazilas.id', 'missing_peoples.upazila_id')
            ->join('users', 'users.id', 'missing_peoples.created_by')
            ->where('missing_peoples.is_approve', '=', 'Approve')
            ->select(
                'missing_peoples.missing_image',
                'missing_peoples.missing_person_name',
                'missing_peoples.missing_person_age',
                'missing_peoples.contact_number',
                'missing_peoples.missing_date',
                'divisions.division_name',
                'districts.district_name',
                'upazilas.upazila_name',
                'missing_peoples.missing_person_description',
                'users.name'
            )->paginate(10);
        return view('missingList.view', compact('divisions', 'missingPeoples'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function missingListSearch(Request $request)
    {
        $divisions = Division::all();

        $missingPeoples = MissingPeople::join('divisions', 'divisions.id', 'missing_peoples.division_id')
            ->join('districts', 'districts.id', 'missing_peoples.district_id')
            ->join('upazilas', 'upazilas.id', 'missing_peoples.upazila_id')
            ->join('users', 'users.id', 'missing_peoples.created_by')
            ->where('missing_peoples.is_approve', '=', 'Approve');
        // ->orderBy('missing_peoples.missing_person_name');

        $division_name = $request->input('division_id');
        $district_name = $request->input('district_id');
        $upazila_name = $request->input('upazila_id');

        if (!empty($division_name) || !empty($district_name) || !empty($upazila_name)) {
            $missingPeoples->where(function ($missingPeoples) use ($division_name, $district_name, $upazila_name) {
                $missingPeoples->where('divisions.id', 'LIKE', '%' . $division_name . '%')
                    ->orWhere('districts.id', 'LIKE', '%' . $district_name . '%')
                    ->orWhere('upazilas.id', 'LIKE', '%' . $upazila_name . '%');
            });
            //  $missingPeoples->where('missing_peoples.missing_person_name', 'LIKE', '%' . $search_name . '%');
        }
        $missingPeoples = $missingPeoples->paginate(5);

        return view('missingList.searchListView', compact('missingPeoples', 'divisions'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
