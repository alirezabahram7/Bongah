<?php

namespace App\Http\Controllers;


use http\Env\Response;
use Illuminate\Http\Request;
use App;
use App\User;
use App\House;
use App\profile;
use App\location;
use App\city;
use App\Http\Controllers\Controller;

class HouseController extends Controller
{

    public function show($rors)
    {
        $req = null;
        $houses = House::where('RentorSell', $rors)->latest()->paginate(20);

        return view('pages/houses', ['house' => $houses, 'rors' => $rors, 'request' => $req]);
    }

    public function edit($id)
    {
        return view('pages/edithouse', ['house' => house::find($id)]);
    }

    public function create()
    {
        $cities = city::all();
        return view('pages/inserthome', compact('cities'));
    }

    public function del($id)
    {
        $house = App\house::find($id);

        $house->delete();
        return redirect()->route('myhouses.show');
    }

    public function myhouses()
    {

        return view('pages/myhouses', ['house' => House::all()->sortByDesc('created_at')]);
    }

    public function card($id)
    {

        return view('pages/housecard', ['house' => house::find($id)]);
    }

    public function search(Request $request)
    {

        if ($request->state == 'buy') {
            return view('pages/houses',
                ['house' => house::latest()->paginate(20), 'rors' => 1, 'request' => $request]);

        }
        if ($request->state == 'rent') {
            return view('pages/houses',
                ['house' => house::all()->sortByDesc('created_at'), 'rors' => 0, 'request' => $request]);
        }
        if ($request->state == 'agent') {
            return view('pages/agents', ['profile' => profile::all()->sortByDesc('created_at'), 'request' => $request]);
        }

    }

    public function fav()
    {
        $houses = auth()->user()->markedHouses()->paginate(5);

        return view('pages/favorites', compact('houses'));
    }

    public function store(Request $request)
    {
        $house = new House;

        $house->city = $request->city;
        $location = App\location::firstOrNew(['district' => $request->location], ['city_id' => $request->city]);
        $location->save();

        $house->location()->district= $request->location;
        $house->location_id = $location->id;

        $house->user_id = auth()->user()->id;
        $house->build_year = $request->year;
        $house->type = $request->type;
        $house->rooms = $request->rooms;
        $house->floor = $request->floor;
        $house->address = $request->address;
        $house->rooms = $request->rooms;
        $house->zipcode = $request->zip;
        $house->cost = $request->cost;
        $house->meterage = $request->meterage;
        $house->comment = $request->comment;
        $house->lat = $request->lat;
        $house->long = $request->long;

        if (!$request->sell) {
            $house->rent = $request->rentcost;
        } else {
            $house->rent = 0;
        }




        $data = '';
        if ($request->hasfile('photo')) {

            foreach ($request->file('photo') as $file) {
                $name = uniqid() . '.' . $file->getClientOriginalExtension();
                $uname = str_replace(' ', '_', $name);
                $file->move(public_path() . '/pic/', $uname);
                if ($data == '') {
                    $data = $uname;
                } else {
                    $data = $data . ',' . $uname;
                }
            }

            $house->photo = $data;
        }
        if ($request->parking) {
            $house->parking = 1;

        } else {
            $house->parking = 0;
        }

        if ($request->anbari) {
            $house->anbari = 1;

        } else {
            $house->anbari = 0;
        }

        if ($request->elevator) {
            $house->elevator = 1;

        } else {
            $house->elevator = 0;
        }

        if ($request->balcony) {
            $house->balcony = 1;

        } else {
            $house->balcony = 0;
        }

        if (!$request->sell) {
            $house->RentorSell = 0;

        } else {
            $house->RentorSell = 1;
        }


        $house->save();
        //dd($house);
        return redirect('/myhouses')->with('success', 'خانه شما با موفقیت ثبت شد');

    }

    public function update(Request $request)
    {
        $this->validate($request, [

            //'photo' => 'required',
            //'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);


        $city = App\city::firstOrNew(['city' => $request->city]);
        $city->save();
        $location = App\location::firstOrNew(['district' => $request->location], ['city_id' => $city->id]);
        $location->save();

        $house = App\house::find($request->id);

        //$house->location['district']=$request->location;
        //$house->cities['city']=$request->city;

        $house->user_id = auth()->user()->id;
        $house->build_year = $request->year;
        $house->type = $request->type;
        $house->rooms = $request->rooms;
        $house->floor = $request->floor;
        $house->address = $request->address;
        $house->rooms = $request->rooms;
        $house->zipcode = $request->zip;
        $house->cost = $request->cost;
        $house->meterage = $request->meterage;
        $house->comment = $request->comment;

        if (!$request->sell) {
            $house->rent = $request->rentcost;
        } else {
            $house->rent = 0;
        }

        $house->city = $city->id;
        $house->location_id = $location->id;

        $data = null;

        if ($request->hasfile('photo')) {

            foreach ($request->file('photo') as $image) {
                $name = $image->getClientOriginalName();
                $image->move(public_path() . '/pic/', $name);
                $data[] = 'pic' . $name;
            }
        }


        $house->photo = json_encode($data);


        if ($request->parking) {
            $house->parking = 1;

        } else {
            $house->parking = 0;
        }

        if ($request->anbari) {
            $house->anbari = 1;

        } else {
            $house->anbari = 0;
        }

        if ($request->elevator) {
            $house->elevator = 1;

        } else {
            $house->elevator = 0;
        }

        if ($request->balcony) {
            $house->balcony = 1;

        } else {
            $house->balcony = 0;
        }

        if (!$request->sell) {
            $house->RentorSell = 0;

        } else {
            $house->RentorSell = 1;
        }


        $house->update();
        return redirect()->route('house.card', ['id' => $request->id]);


    }

    public function map(Request $request)
    {

        $data = $request->id;
        echo response()->json($data);
        return response()->json($data);

    }

}

