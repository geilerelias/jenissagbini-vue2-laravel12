<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use File;
use Inertia\Inertia;

class NoticeController extends Controller
{

    public function index(Request $request)
    {         //return Notice::orderBy('date', 'asc')->get();
        $data = Notice::orderBy('date', 'desc')->get();
        //return Notice::orderByRaw('date - time DESC')->get();
        return Inertia::render('Dashboard/Notices/AllNotice', ['notices' => $data]);
    }

    public function all()
    {
        return Notice::orderBy('date', 'desc')->get();
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
            'image' => 'required|image',
            "title" => 'required',
            "city" => 'required',
            "date" => 'required',
            "time" => 'required',
            "description" => 'required',
        ]);

        $fileName = '';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // Generate a file name with extension
            $fileName = 'image-' . time() . '.' . $file->getClientOriginalExtension();
            // Save the file
            $path = $file->storeAs('notices', $fileName);
        }

        $notice = new Notice();
        $notice->image = $path;
        $notice->title = $request->title;
        $notice->city = $request->city;
        $notice->date = $request->date;
        $notice->time = $request->time;
        $notice->description = $request->description;

        $notice->save();

        return $notice;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notice = Notice::find($id);
        return Inertia::render('Dashboard/Notices/DeleteNotice', ['notice' => $notice]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notice = Notice::find($id);
        return Inertia::render('Dashboard/Notices/EditNotice', ['notice' => $notice]);
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
            'image' => 'required|image',
            "title" => 'required',
            "city" => 'required',
            "date" => 'required',
            "time" => 'required',
            "description" => 'required',
        ]);


        $fileName = '';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // Generate a file name with extension
            $fileName = 'image-' . time() . '.' . $file->getClientOriginalExtension();
            // Save the file
            $path = $file->storeAs('notices', $fileName);
        }

        $notice = Notice::find($id);
        Storage::delete($notice->image);

        $notice->image = $path;
        $notice->title = $request->title;
        $notice->city = $request->city;
        $notice->date = $request->date;
        $notice->time = $request->time;
        $notice->links = $request->links;
        $notice->description = $request->description;
        $notice->save();
        return $notice;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice)
    {
        Storage::delete($notice->image);
        $notice->delete();
    }
}
