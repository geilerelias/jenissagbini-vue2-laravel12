<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\NoticeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PublishedArticleController;
use App\Http\Controllers\OtherArticleController;
use App\Http\Controllers\EntrepreneurshipController;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ThesisController;
use App\Http\Controllers\JuryController;

Route::get('/clear-cache', function () {
    try {
        $exitCode = Artisan::call('cache:clear');
        $exitCode = Artisan::call('config:cache');
        return 'DONE'; //Return anything
    } catch (Throwable $th) {
        //throw $th;
    }
});


Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/example', function () {
    return Inertia\Inertia::render('Example');
})->name('example');

Route::get('/', function () {
    return Inertia\Inertia::render('Inicio');
})->name('inicio');

Route::get('/quien-soy', function () {
    return Inertia\Inertia::render('QuienSoy');
})->name('quienSoy');

Route::get('/proyectos', function () {
    return Inertia\Inertia::render('Proyectos');
})->name('proyectos');

Route::get('/articulo', function () {
    return Inertia\Inertia::render('Articulo');
})->name('articulo');

Route::get('/servicios', function () {
    return Inertia\Inertia::render('Servicios');
})->name('servicios');

Route::get('/contacto', function () {
    return Inertia\Inertia::render('Contacto');
})->name('contacto');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/services', function () {
    return Inertia\Inertia::render('Dashboard/Services');
})->name('dashboard.services');

Route::middleware(['auth:sanctum', 'verified', 'can:view rol'])
    ->get('/role/all', [RoleController::class, 'all']);
Route::middleware(['auth:sanctum', 'verified', 'can:assign permissions'])
    ->post('/role/assign/permissions', [RoleController::class, 'assignPermissions']);
Route::middleware(['auth:sanctum', 'verified', 'can:get permissions'])
    ->get('/role/{role}/permissions', [RoleController::class, 'getPermissions']);
Route::middleware(['auth:sanctum', 'verified', 'can:view rol'])
    ->resource('role', RoleController::class);

Route::middleware(['auth:sanctum', 'verified', 'can:view permission'])
    ->get('/permission/all', [PermissionController::class, 'all']);
Route::middleware(['auth:sanctum', 'verified', 'can:view permission'])
    ->resource('permission', PermissionController::class);

Route::middleware(['auth:sanctum', 'verified', 'can:assign roles'])
    ->post('/user/assign/roles', [UserController::class, 'assignRole']);
Route::middleware(['auth:sanctum', 'verified', 'can:remove roles'])
    ->post('/user/remove/roles', [UserController::class, 'removeRole']);
Route::middleware(['auth:sanctum', 'verified', 'can:view rol'])
    ->get('/user/{user}/roles', [UserController::class, 'getRoleNames']);

Route::middleware(['auth:sanctum', 'verified'])->resource('user', UserController::class);


//notices
Route::get('notices/all', [NoticeController::class, 'all']);
Route::middleware(['auth:sanctum', 'verified', 'can:view notices'])->group(function () {
    Route::resource('/notices', NoticeController::class);
    Route::post('/notices/update/{id}', [NoticeController::class, 'update']);
});

//quien soy
Route::get('about/all', [AboutController::class, 'all']);
Route::middleware(['auth:sanctum', 'verified', 'can:view about'])->group(function () {
    Route::resource('/about', AboutController::class);
    Route::post('/about/update/{id}', [AboutController::class, 'update']);
});

Route::get('/publishedArticle/all', [PublishedArticleController::class, 'all']);
Route::get('/othersArticle/all', [OtherArticleController::class, 'all']);
Route::middleware(['auth:sanctum', 'verified', 'can:view articles'])->group(function () {

    Route::get('/articles', function () {
        return Inertia\Inertia::render('Dashboard/Articles/MainArticle');
    })->name('articles');

    Route::resource('/articles/published', PublishedArticleController::class);
    Route::post('/articles/published/update/{id}', [PublishedArticleController::class, 'update']);

    Route::resource('/articles/others', OtherArticleController::class);
    Route::post('/articles/others/update/{id}', [OtherArticleController::class, 'update']);
});

Route::get('/entrepreneurship/all', [EntrepreneurshipController::class, 'all']);
Route::get('/software/all', [SoftwareController::class, 'all']);
Route::get('/business/all', [BusinessController::class, 'all']);
Route::get('/thesis/all', [ThesisController::class, 'all']);
Route::get('/jury/all', [JuryController::class, 'all']);
Route::middleware(['auth:sanctum', 'verified', 'can:view project'])->group(function () {
    Route::get('/project', function () {
        return Inertia\Inertia::render('Dashboard/Projects/MainProjects');
    })->name('project');
    Route::resource('/entrepreneurship', EntrepreneurshipController::class);
    Route::resource('/software', SoftwareController::class);
    Route::resource('/business', BusinessController::class);
    Route::resource('/thesis', ThesisController::class);
    Route::resource('/jury', JuryController::class);
});

//services
Route::middleware(['auth:sanctum', 'verified', 'can:view services'])->group(function () {
    Route::get('/services', function () {
        return Inertia\Inertia::render('Dashboard/Services/Services');
    })->name('services');
});

Route::resource('/roles', 'RoleController')->middleware('auth:api');
Route::resource('/students', 'StudentController')->middleware('auth:api');
Route::resource('/courses', 'CourseController')->middleware('auth:api');

Route::get('books', 'BookController@index');
Route::group(['prefix' => 'book'], function () {
    Route::post('add', 'BookController@store');
    Route::get('edit/{id}', 'BookController@edit');
    Route::post('update/{id}', 'BookController@update');
    Route::delete('delete/{id}', 'BookController@destroy');
});

//Email Verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//Resetting Passwords
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

//send mail contact
Route::post('/send-mail', [\App\Http\Controllers\SendMailController::class, 'send'])
    ->name('send-email');


Route::get('/storage/{folder}/{filename}', function ($folder, $filename) {
    try {
        $path = storage_path("app/{$folder}/{$filename}");

        //si no se encuentra lanzamos un error 404.
        if (!File::exists($path)) {
            abort(404, 'Archivo no encontrado');
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        return Response::make($file, 200)->header("Content-Type", $type);
    } catch (Throwable $th) {
        return $th->getMessage();
    }
});


Route::get('/src/{page?}/{folder?}/{sub?}/{filename}', function ($page = "null", $folder = "null", $sub = "null", $filename) {
    try {
        $path = '';
        if ($page == "null") {
            $path = base_path() . '/resources/img/' . $filename;
        } elseif ($folder == "null") {
            $path = base_path() . '/resources/img/' . $page . '/' . $filename;
        } elseif ($sub == "null") {
            $path = base_path() . '/resources/img/' . $page . '/' . $folder . '/' . $filename;
        } else {
            $path = base_path() . '/resources/img/' . $page . '/' . $folder . '/' . $sub . '/' . $filename;
            //$path = storage_path() . '/app/' . $folder . '/' . $filename;
        }
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    } catch (Throwable $th) {
        return $th->getMessage();
    }
});
