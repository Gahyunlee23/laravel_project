<?php

namespace App\Http\Controllers;

use App\AlertTalk;
use App\Image;
use App\Http\Requests\StoreImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class ImageController extends Controller
{

    private $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
        //$this->middleware('auth');
    }

    public function getImages()
    {
        $images = Image::paginate(10);
       // ddd($images->path);
        return view('images', ['images' => $images]);
    }
    public function getImagesLimit($count)
    {
        $images = Image::paginate($count);
       // ddd($images->path);
        return view('images', ['images' => $images]);
    }


    public function postUpload(StoreImage $request){

        $all_path='';

        foreach($request->all() as $id => $value){
            if(Str::contains($id,'file')){
                foreach($value as $file) {
                    $all_path .= Storage::disk('s3-Public')->put('images/'.Str::after($id,'file').'/'.date('Y-m-d'),$file).'|';
                }
            }
        }
        $request->merge([
            /*'size' => $file->getSize(),*/
            'path' => Str::beforeLast($all_path, '|')
        ]);
        $this->image->create(
            $request->only( 'path')
        );


        /* foreach($uploadFile as $file) {
             $all_path .= Storage::disk('s3-Public')->put('images/0/'.date('Y-m-d'),$file);
         }*/
        //Image::where('email',$request->email)->firstOr(function (){
       // $path = Storage::disk('s3-Public')->put('images/'.date('Y-m-d'), $request->file);

        /*$at= new #AlertTalk($request);
        $at->send();*/

        return json_encode([
            'result'=>'success',
            /*'filepath'=>$path*/
        ]);

    }
}
