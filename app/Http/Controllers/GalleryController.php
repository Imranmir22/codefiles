<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Auth;
class GalleryController extends Controller
{
    public function index()
    {
        $galleryImages = Image::orderBy('display_order')->get();
        return view('gallery.index', compact('galleryImages'));
    }

    public function addImages()
    {

    }
    public function upload(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png|max:2048'
        ]);
        $userId = Auth::id();
        foreach ($request->file('images') as $image) {
            $order = Image::orderBy('id')->where('user_id',$userId)->max('display_order');
            if($order)
                $order = $order + 1;
            else
                $order = 1;
            $filename = $image->move('uploads/',$image->getClientOriginalName());
            Image::create(['file_path' => $filename,'user_id'=>$userId ,'display_order'=>$order ]);
        }

        return redirect()->back()->with('success', 'Images uploaded successfully.');
    }

    public function reorder(Request $request)
    {
        $newOrder = $request->input('order');
        foreach ($newOrder as $index => $itemId) {
            Image::where('id', $itemId)->update(['display_order' => $index]);
        }

        return response()->json(['message' => 'Order updated successfully.']);
    }
}
