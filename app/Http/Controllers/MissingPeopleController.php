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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::all();
        $districts = District::all();
        $upazilas = Upazila::all();
        return view('missingPeople.create', compact('divisions', 'districts', 'upazilas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->all());
//        $this->validate($request, [
//            'missing_person_name' => 'required',
//            'missing_person_age' => 'required',
//            'contact_number' => 'required',
//            'missing_date' => 'required',
//            'division_id' => 'required',
//            'district_id' => 'required',
//            'upazila_id' => 'required',
//            'missing_person_description' => 'required',
//            'missing_image' => 'required',
//        ]);

        $missing = new MissingPeople();
        $missing->missing_person_name = $request->missing_person_name;
        $missing->missing_person_age = $request->missing_person_age;
        $missing->contact_number = $request->contact_number;
        $missing->missing_date = $request->missing_date;
        $missing->division_id = $request->division_id;
        $missing->district_id = $request->district_id;
        $missing->upazila_id = $request->upazila_id;
        $missing->missing_person_description = $request->missing_person_description;
        //$missing->missing_image = $request->missing_image;
        $missing->save();




        $img_nid = $request->file('missing_image');
      //  if ($img_nid) {
             $missingById = MissingPeople::find($missing->id);
            // Image upload
            $img_nid_extension = $img_nid->clientExtension();
            $img_nid_name = 'customer_nid_' . $missing->id . '.' . $img_nid_extension;
            $upload_path = 'public/' . $missing->id . '/';
            $img_nid->move($upload_path, $img_nid_name);
            $img_nid_url = $upload_path . $img_nid_name;
            $missingById->missing_image = $img_nid_url;
            $missingById->save();
   //     }

        Session::flash('message','Missing add successfully!');
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
}
