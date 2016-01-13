<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('templates.main');
//});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::get('/', ['as' => 'upload', 'uses' => 'ImageController@getUpload']);
Route::post('upload', ['as' => 'upload-post', 'uses' =>'ImageController@postUpload']);
Route::post('upload/delete', ['as' => 'upload-remove', 'uses' =>'ImageController@deleteUpload']);



// Example from:
//



// Example From:
//


Route::group(['middleware' => ['web']], function () {
//    Route::get('upload', function() {
//        return View::make('pages.upload');
//    });

    Route::post('apply/upload', 'UploadWithNoJQueryController@upload');

    Route::get('multiple_upload', function() {
        return View::make('pages.multiple_upload');
    });

    Route::post('apply/multiple_upload', 'UploadWithNoJQueryController@multiple_upload');
});











// Example from:
// http://ryantablada.com/post/working-with-jquery-ajax-uploader-and-laravel-php
Route::get('basic', function() {
    return View::make('upload.basic');
});

Route::post('api/basic', function()
{
    // Grab our files input
    $files = Input::file('files');
    // We will store our uploads in public/uploads/basic
    $assetPath = '/uploads/basic';
    $uploadPath = public_path($assetPath);
    // We need an empty arry for us to put the files back into
    $results = array();

    foreach ($files as $file) {
        // store our uploaded file in our uploads folder
        $file->move($uploadPath, $file->getClientOriginalName());
        // set our results to have our asset path
        $name = $assetPath . '/' . $file->getClientOriginalName();
        $results[] = compact('name');
    }

    // return our results in a files object
    return array(
        'files' => $results
    );
});

// Jqueryupload by Eunseok

Route::get('jqupload', function() {


//    $options = array(
//        'upload_dir' => 'uploads',
//        'accept_file_types' => '/\.(gif|jpe?g|png)$/i'
//    );
//
//    $upload_handler = new App\Library\UploadHandler($options);



    return view('minimum.minimum');
});




Route::post('jqupload', function() {



//    $files = Input::file('file');

//    $file_count = count($files);

    $file = input::file('file');
    $destinationPath = 'uploads';
    $filename = str_random(12);
    $upload_success = Input::file('file')->move($destinationPath, $filename);


    if( $upload_success ) {
        return Response::json('success', 200);
    } else {
        return Response::json('error', 400);
    }




    Log::info('ajax 처리 신호 옴');

    Log::warning('Something could be going wrong.');

    Log::error('Something is really going wrong.');


//    'upload_url' => $this->get_full_url().'/test/',
//
//    $options = array(
//        'upload_dir' => 'test/uploads',
//        'accept_file_types' => '/\.(gif|jpe?g|png)$/i',
//        'image_versions' => array()
//
//
//    );
//
//    $upload_handler = new App\Library\UploadHandler($options);

//    return Response::json($upload_handler->get_response());





//    return view('minimum.minimum');
});

// Ajax Sample

Route::get('ajax', function() {
    return view('minimum.ajax');
});

Route::post('ajax', function(\Illuminate\Http\Request $request) {

    $random = $request->input('random');
    $input = $request->all();

    Config::get("");


    return Response::json($input);
});




// Dropzone
//Route::get('dropzone', function(\Illuminate\Http\Request $request){
//    return view('dropzone.upload');
//});

Route::group(['middleware' => ['web']], function () {

});



Route::post('dropzone/upload', function(\Illuminate\Http\Request $request){



    $input = $request->all();
//        $rules = array(
//            'file' => 'image|max:3000',
//        );
//
//        $validation = Validator::make($input, $rules);
//
//        if ($validation->fails())
//        {
//            return Response::make($validation->errors->first(), 400);
//        }

    $file = $request->file('file');

    $extension = $request->file('file')->getClientOriginalExtension();
    $directory = public_path().'uploads/'.sha1(time());
    $filename = sha1(time().time()).".{$extension}";

//        $upload_success = $request->upload('file', $directory, $filename);
    $upload_success = $request->file('file')->move($directory, $filename);

    if( $upload_success ) {
        return Response::json('success', 200);
    } else {
        return Response::json('error', 400);
    }


});

Route::get('dropzone', 'DropzoneController@index');
Route::post('dropzone/uploadFiles', 'DropzoneController@uploadFiles');


use Illuminate\Support\Facades\Input;
Route::get('gett', function(){



    return Response::json(Input::all());
});


