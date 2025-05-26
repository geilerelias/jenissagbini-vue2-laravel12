<?php

namespace App\Http\Controllers;

use App\Models\Software;
use Illuminate\Http\Request;

class SoftwareController extends Controller
{

    public function index(Request $request)
    {
        return Software::orderBy('id', 'DESC')->get();
        abort(401, 'This action is unauthorized');
    }

    public function all()
    {
        return Software::orderBy('id', 'DESC')->get();
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

        $software = new Software();
        $software->title = $request->title;
        $software->description = $request->description;
        $software->year = $request->year;
        $software->state = $request->state;
        $software->entity = $request->entity;

        $software->save();

        return $software;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $software = Software::find($id);
        return $software;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $software = Software::find($id);
        return $software;
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

        $software = Software::find($id);

        $software->title = $request->title;
        $software->description = $request->description;
        $software->year = $request->year;
        $software->state = $request->state;
        $software->entity = $request->entity;

        $software->save();
        return $software;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $software = Software::find($id);
        $software->delete();
    }
}
