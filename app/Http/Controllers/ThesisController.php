<?php

namespace App\Http\Controllers;

use App\Models\Thesis;
use Illuminate\Http\Request;

class ThesisController extends Controller
{
    public function index(Request $request)
    {
        return Thesis::orderBy('id', 'DESC')->get();
        abort(401, 'This action is unauthorized');
    }

    public function all()
    {
        return Thesis::orderBy('id', 'DESC')->get();
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

        $thesis = new Thesis();
        $thesis->title = $request->title;
        $thesis->year = $request->year;
        $thesis->entity = $request->entity;
        $thesis->people = $request->people;

        $thesis->save();

        return $thesis;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $thesis = Thesis::find($id);
        return $thesis;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thesis = Thesis::find($id);
        return $thesis;
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


        $thesis = Thesis::find($id);


        $thesis->title = $request->title;
        $thesis->year = $request->year;
        $thesis->entity = $request->entity;
        $thesis->people = $request->people;
        $thesis->save();
        return $thesis;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $thesis = Thesis::find($id);
        $thesis->delete();
    }
}
