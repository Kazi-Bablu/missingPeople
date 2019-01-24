<?php

namespace App\Http\Controllers;

use App\District;
use App\Division;
use App\MissingPeople;
use App\Upazila;
use Illuminate\Http\Request;
use Session;

class MissingPeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->user_role == 'Admin') {
            $missingPeoples = MissingPeople::join('users', 'users.id', 'missing_peoples.created_by')
                ->join('divisions', 'divisions.id', 'missing_peoples.division_id')
                ->join('districts', 'districts.id', 'missing_peoples.district_id')
                ->join('upazilas', 'upazilas.id', 'missing_peoples.upazila_id')
                ->select('missing_peoples.id',
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
            return view('missingPeople.view', compact('missingPeoples'));
        } else {
            $missingPeoples = MissingPeople::join('users', 'users.id', 'missing_peoples.created_by')
                ->join('divisions', 'divisions.id', 'missing_peoples.division_id')
                ->join('districts', 'districts.id', 'missing_peoples.district_id')
                ->join('upazilas', 'upazilas.id', 'missing_peoples.upazila_id')
                ->where('missing_peoples.created_by', auth()->user()->id())
                ->select(
                    'missing_peoples.id',
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
            return view('missingPeople.view', compact('missingPeoples'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::all();
        return view('missingPeople.create', compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //    dd($request->all());
        $this->validate($request, [
            'missing_person_name' => 'required',
            'missing_person_age' => 'required',
            'contact_number' => 'required',
            'missing_date' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'upazila_id' => 'required',
            'missing_person_description' => 'required',
            'missing_image' => 'required',
        ]);

        $missing = new MissingPeople();
        $missing->missing_person_name = $request->missing_person_name;
        $missing->missing_person_age = $request->missing_person_age;
        $missing->contact_number = $request->contact_number;
        $missing->missing_date = $request->missing_date;
        $missing->division_id = $request->division_id;
        $missing->district_id = $request->district_id;
        $missing->upazila_id = $request->upazila_id;
        $missing->missing_person_description = $request->missing_person_description;
        $missing->created_by = auth()->id();

        if ($request->hasFile('missing_image')) {
            $img_nid = $request->file('missing_image');
            $filename = time() . "." . $img_nid->getClientOriginalExtension();
            $path = public_path('storage/images/');
            $img_nid->move($path, $filename);
            $missing->missing_image = $filename;
        }
        $missing->save();
        Session::flash('message', 'Missing add successfully!');
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

    public function divisionSelectedForDistrictName(Request $request)
    {
        $districtById = District::where('division_id', $request->division_id)
            ->select(
                'districts.id',
                'districts.district_name'
            )->get();

        if (count($districtById) > 0) {
            foreach ($districtById as $district) {
                echo '<option value="' . $district->id . '">' . $district->district_name . '</option>';
            }
        } else {
            echo '<option value="">No district found.</option>';
        }
    }

    public function districtSelectedForUpazilaName(Request $request)
    {
        $upazilaById = Upazila::where('district_id', $request->district_id)
            ->select(
                'id',
                'upazila_name'
            )->get();
        if (count($upazilaById) > 0) {
            foreach ($upazilaById as $upazila) {
                echo '<option value="' . $upazila->id . '">' . $upazila->upazila_name . '</option>';
            }
        } else {
            echo '<option value="">No upazila found.</option>';
        }
    }
}
