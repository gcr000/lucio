<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;

class HouseController extends Controller
{

    private $houses_columns_searcheable = [
        'note'
    ];
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view('houses.index');
    }

    function table(Request $request)
    {
        $houses = House::where('id', '>', 0);
        if (strlen($request->get('search'))) {
            $searchs = explode(" ", $request->get('search'));
            foreach ($searchs as $search) {
                $houses->where(function ($query) use ($search) {
                    foreach ($this->houses_columns_searcheable as $column) {
                        $query->orWhere($column, 'LIKE', "%".$search."%");
                    }
                });
            }
        }

        /*if ($request->get('category_id')) {
            $strutture->where('category_id', $request->get('category_id'));
        }


        if ($request->get('province_id')) {
            $strutture->where('province_id', $request->get('province_id'));
        }*/

        $houses = $houses->paginate(10);

        return view('houses.table', ['houses' => $houses])->render();
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
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function show(House $house)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function edit(House $house)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, House $house)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function destroy(House $house)
    {
        //
    }
}
