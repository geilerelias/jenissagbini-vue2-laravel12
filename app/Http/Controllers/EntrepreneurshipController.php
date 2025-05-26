<?php

namespace App\Http\Controllers;

use App\Models\Entrepreneurship;
use Illuminate\Http\Request;

class EntrepreneurshipController extends Controller
{

    public function index(Request $request)
    {
        return Entrepreneurship::orderBy('id', 'DESC')->get();
        abort(401, 'This action is unauthorized');
    }

    public function all()
    {
        return Entrepreneurship::orderBy('id', 'DESC')->get();
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
            "state" => 'required',
            "description" => 'required',
        ]);


        $entrepreneurship = new Entrepreneurship();
        $entrepreneurship->title = $request->title;
        $entrepreneurship->state = $request->state;
        $entrepreneurship->description = $request->description;

        $entrepreneurship->save();

        return $entrepreneurship;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entrepreneurship = Entrepreneurship::find($id);
        return $entrepreneurship;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entrepreneurship = Entrepreneurship::find($id);
        return $entrepreneurship;
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
            "state" => 'required',
            "description" => 'required',
        ]);


        $entrepreneurship = Entrepreneurship::find($id);


        $entrepreneurship->title = $request->title;
        $entrepreneurship->state = $request->state;
        $entrepreneurship->description = $request->description;
        $entrepreneurship->save();
        return $entrepreneurship;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entrepreneurship = Entrepreneurship::find($id);
        $entrepreneurship->delete();
    }
}
