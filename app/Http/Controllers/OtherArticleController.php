<?php

namespace App\Http\Controllers;

use App\Models\OtherArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class OtherArticleController extends Controller
{

    public function index(Request $request)
    {
        $data = OtherArticle::orderBy('id', 'DESC')->get();
        return Inertia::render(
        //'Dashboard/Articles/Other/AppOtherArticles',
            'Dashboard/Articles/Other/AppOtherArticles',
            ['data' => $data]
        );
    }

    public function all()
    {
        return OtherArticle::orderBy('id', 'DESC')->get();
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
            "file" => 'required',
            "title" => 'required',
            "description" => 'required',
        ]);
        $path = "";

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            // Generate a file name with extension
            $name = 'other article-' . time() . '.' . $file->getClientOriginalExtension();
            // Save the file
            $path = $file->storeAs('others-article', $name);
        }

        $otherArticle = new OtherArticle();
        $otherArticle->file = $path;
        $otherArticle->title = $request->title;
        $otherArticle->description = $request->description;

        $otherArticle->save();

        return $otherArticle;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $otherArticle = OtherArticle::find($id);
        return $otherArticle;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $otherArticle = OtherArticle::find($id);
        return $otherArticle;
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
            'file' => 'required',
            "title" => 'required',
            "description" => 'required',
        ]);
        $path = "";

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            // Generate a file name with extension
            $name = 'article-' . time() . '.' . $file->getClientOriginalExtension();
            // Save the file
            $path = $file->storeAs('otherArticle', $name);
        }
        $otherArticle = OtherArticle::find($id);

        if ($path === "") {
            Storage::delete($otherArticle->file);
        }

        $otherArticle->file = $path;
        $otherArticle->title = $request->title;
        $otherArticle->description = $request->description;
        $otherArticle->save();
        return $otherArticle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $otherArticle = OtherArticle::find($id);
        Storage::delete($otherArticle->file);
        $otherArticle->delete();
    }
}
