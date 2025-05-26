<?php

namespace App\Http\Controllers;

use App\Notifications\InvoicePaid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{

    public function sendNotification()
    {
        $user = User::find(2);
        $user->notify(new InvoicePaid("mensaje"));
        return "enviado a " . $user->name;
    }

    public function upload(Request $request)
    {
        // $user->notify(new InvoicePaid($invoice));

        // $validation = $request->validate([
        //     'file'  =>  'required|file|image|mimes:jpeg,png,gif,jpg'
        // ]);

        // $file = $validation['file'];

        // if ($request->has('file')) {
        //     $file = $request->file('file');

        //     // Generate a file name with extension
        //     $fileName = 'notice-' . time() . '.' . $file->getClientOriginalExtension();

        //     // Save the file
        //     $path = $file->storeAs('notices', $fileName);

        //     //dd($path);

        //     $url = Storage::url('notices/' . $fileName);
        //     dd($url);
        // } else {
        //     return 'algo esta fallando';
        // }
    }
}
