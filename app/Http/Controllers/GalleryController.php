<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Gallery;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\GalleryRequest;

class GalleryController extends Controller
{
    public function store(GalleryRequest $req)
    {
        $images = $req->rows;
        try{
            foreach($images as $image){
                $image['image_uploader'] = auth()->user()->name;
                $filename = $image['image_name']. '_' . uniqid() . "_" . "." . $image['image_path']->extension();
                $image['image_path']->storeAs('gallery',$filename,'public');
                $image['image_path'] = $filename;
                Gallery::create($image);
            }
            return redirect()->back()->with('success','Upload complete.');
        }catch(Exception $exception){
            Log::error("@gallery",[
                "msg"=>$exception->getMessage()
            ]);
            return redirect()->back()->with('failed','Upload Error.');
        }
    }

}
