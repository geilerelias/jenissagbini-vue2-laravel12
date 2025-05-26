<?php

namespace App\Http\Controllers;


use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = About::all();
        return Inertia::render('Dashboard/About/AppAboutMe', ['data' => $data]);
    }

    public function all()
    {
        return About::all();
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
        $path = '';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // Generate a file name with extension
            $fileName = '¿Quíen-soy?-' . time() . '.' . $file->getClientOriginalExtension();
            // Save the file
            $path = $file->storeAs('about', $fileName);
        }


        $about = new About();
        $about->title = $request->title;
        $about->image = $path;
        $about->name = $request->name;
        $about->content = $request->input('content');
        $about->icon = $request->icon;
        $about->save();
        return $about;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $path = "";

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // Generate a file name with extension
            $fileName = 'image-' . time() . '.' . $file->getClientOriginalExtension();
            // Save the file
            $path = $file->storeAs('about', $fileName);
        }


        $about = About::find($id);

        if ($path !== "") {
            Storage::delete($about->image);
            $about->image = $path;
        }

        $about->title = $request->title;
        $about->name = $request->name;
        $about->content = $request->input('content');
        $about->icon = $request->icon;

        $about->save();
        return response()->json($about);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $about = About::find($id);
        Storage::delete($about->image);
        $about->delete();
    }
}
