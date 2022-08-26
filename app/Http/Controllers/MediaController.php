<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Product;
// use Facade\FlareClient\Stacktrace\File;
// use Illuminate\Http\Request;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        //
        return view("backend.medias.create",['product_id'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'image_link' => 'required|image|mimes:jpeg,png,jpg'
        ]);
        $product = Product::find($request->product_id);
        $media = New Media();
        $media->product_id = $request->product_id;

        $file = $request->image_link;
        $imageName = "images/products/" . time() . "_" . $file->getClientOriginalName();
        $file->move(public_path("images/products"), $imageName);
        $media->image_link = $imageName;
        $media->image_description = '';

        if ($media->save()) {
            return redirect()->route('product.index')->withSuccess("image Added");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $medias = Media::where('product_id', $id)->orderBy('created_at', 'desc')->get();
            return view('backend.medias.show', ['medias'=>$medias]);
    }

    public function showmedias($id)
    {
        $product_id = Product::where('slug',$id)->get();
        $media = Media::where('product_id', $product_id)->orderBy('created_at', 'desc')->get();
        return response(['media'=>$media]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        //
        $image_path = public_path($media->image);
        //dd($image_path);
        // if (File::exists($image_path)) {
        //     unlink($image_path);
        // }
        $media->delete();
        return redirect()->route('product.index')->withSuccess("image deleted");
    }
}
