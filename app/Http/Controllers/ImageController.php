<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;

class ImageController extends Controller
{
    //

    public function __construct()
    {

    }

    public function postUpload(Request $request)
    {
        $form_data = $request->all();


        $validator = Validator::make($form_data, Image::$rules, Image::$messages);

        if ($validator->fails()) {

            return Response::json([
                'error' => true,
                'message' => $validator->messages()->first(),
                'code' => 400
            ], 400);

        }

        $photo = $form_data['file'];

        $originalName = $photo->getClientOriginalName();
        $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - 4);

        $filename = $this->sanitize($originalNameWithoutExt);
        $allowed_filename = $this->createUniqueFilename( $filename );
        $filenameExt = $allowed_filename .'.jpg';

        $uploadSuccess1 = $this->original( $photo, $filenameExt );

//                return Response::json([
//            'error' => false,
//            'code' => 200
//        ], 200);

        if ( !$uploadSuccess1) {
            return Response::json([
                'error' => true,
                'message' => 'Sever error while uploading',
                'code' => 500
            ], 500);
        }

        return Response::json([
            'error' => false,
            'code' => 200
        ], 200);


    }

    public function createUniqueFilename( $filename )
    {
        $full_size_dir = Config::get('images.full_size');
        $full_image_path = $full_size_dir . $filename . '.jpg';

        if ( File::exists( $full_image_path ) )
        {
            // Generate token for image
            $imageToken = substr(sha1(mt_rand()), 0, 5);
            return $filename . '-' . $imageToken;
        }

        return $filename;
    }


    function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;

        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }

    public function original( $photo, $filename )
    {
        $manager = new ImageManager();
        $image = $manager->make( $photo )->encode('jpg')->save(Config::get('images.full_size') . $filename );

        return $image;
    }

}
