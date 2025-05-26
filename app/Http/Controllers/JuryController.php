<?php

namespace App\Http\Controllers;

use App\Models\Jury;
use Illuminate\Http\Request;

class JuryController extends Controller
{

    public function index(Request $request)
    {
        return Jury::orderBy('id', 'DESC')->get();
        abort(401, 'This action is unauthorized');
    }

    public function all()
    {
        return Jury::orderBy('id', 'DESC')->get();
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
            "year" => 'required',
            "entity" => 'required',
        ]);

        $jury = new Jury();
        $jury->title = $request->title;
        $jury->year = $request->year;
        $jury->entity = $request->entity;
        $jury->people = $request->people;

        $jury->save();

        return $jury;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jury = Jury::find($id);
        return $jury;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jury = Jury::find($id);
        return $jury;
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
            "year" => 'required',
            "entity" => 'required',
        ]);


        $jury = Jury::find($id);


        $jury->title = $request->title;
        $jury->year = $request->year;
        $jury->entity = $request->entity;
        $jury->people = $request->people;
        $jury->save();
        return $jury;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jury = Jury::find($id);
        $jury->delete();
    }
}
