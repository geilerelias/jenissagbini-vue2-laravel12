<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    //
    public function index(Request $request)
    {
        return Business::orderBy('id', 'DESC')->get();
        abort(401, 'This action is unauthorized');
    }

    public function all()
    {
        return Business::orderBy('id', 'DESC')->get();
        abort(401, 'This action is unauthorized');
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "title" => 'required',
            "description" => 'required',
            "year" => 'required',
            "state" => 'required',
            "entity" => 'required',
        ]);

        $business = new Business();
        $business->title = $request->title;
        $business->description = $request->description;
        $business->year = $request->year;
        $business->state = $request->state;
        $business->entity = $request->entity;

        $business->save();

        return $business;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $business = Business::find($id);
        return $business;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $business = Business::find($id);
        return $business;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "title" => 'required',
            "description" => 'required',
            "year" => 'required',
            "state" => 'required',
            "entity" => 'required',
        ]);

        $business = Business::find($id);

        $business->title = $request->title;
        $business->description = $request->description;
        $business->year = $request->year;
        $business->state = $request->state;
        $business->entity = $request->entity;

        $business->save();
        return $business;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $business = Business::find($id);
        $business->delete();
    }
}
