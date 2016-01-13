<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;


class DropZoneController extends Controller
{
    public function index() {

        return view('dz.dz_demo');
    }

    public function uploadFiles(Request $request) {

        $input = Input::all();

//        $rules = array(
//            'file' => 'image|max:3000',
//        );
//
//        $validation = Validator::make($input, $rules);
//
//        if ($validation->fails()) {
//            return Response::make($validation->errors->first(), 400);
//        }


        $destinationPath = 'uploads'; // upload path
        $extension = Input::file('file')->getClientOriginalExtension(); // getting file extension
        $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
        $upload_success = Input::file('file')->move($destinationPath, $fileName); // uploading file to given path

//        if ($request->file('file')->isValid()) {
//            return Response::json('success', 200);
//        } else {
//            return Response::json('error', 400);
//        }
//        return Response::json('success');
    }
}
