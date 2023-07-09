<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::all();
        return view('backend.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate( $request, [

            'title' => 'string|required',
            'description' => 'string|nullable',
            'photo' => 'required',
            'condition' => 'nullable|in:banner,promo',
            'status' => 'nullable|in:active,inactive',
            ]

        );

        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Banner::where('slug',$slug)->count();
        if($slug_count > 0){
            $slug = time().$slug;
        }
        $data['slug'] = $slug;
        $response = Banner::create($data);
        if($response){
            return redirect()->route('banner.index')->with('success','Successfully created banner');
        }else{
            return back()->with('error','Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banner = Banner::where('id', $id)->first();
        return view('backend.banners.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate( $request, [

            'title' => 'string|required',
            'description' => 'string|nullable',
            'photo' => 'required',
            'condition' => 'nullable|in:banner,promo',
            'status' => 'nullable|in:active,inactive',
            ]

        );
       
        $data['title'] = $request->input('title');
        $data['description'] = $request->input('description');
        $data['photo'] = $request->input('photo');
        $data['status'] = $request->input('status');
        $data['condition'] = $request->input('condition');
        $slug = Str::slug($request->input('title'));
        $slug_count = Banner::where('slug',$slug)->count();
        if($slug_count > 0){
            $slug = time().$slug;
        }
        $data['slug'] = $slug;
        $response = Banner::where('id',$id)->update($data);
        if($response){
            return redirect()->route('banner.index')->with('success','Successfully updated banner');
        }else{
            return back()->with('error','Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner=Banner::find($id);
        $response = $banner->delete(); //returns true/false
        if($response){
            return redirect()->route('banner.index')->with('success','Successfully deleted banner');
        }else{
            return back()->with('error','Something went wrong!');
        }
    }

    public function bannerStatus(Request $request){
        $id = $request->input('id');
        $status = $request->input('mode');
        $response = array('status' => false, 'msg' => 'Error');
        if(!empty($id) && !empty($status)){
            if($status == 'true'){
                $response = Banner::where('id', $id)->update(array('status' => 'active'));
                $response = array('status' => true, 'msg' => 'Status is Active');
            }else{
                $response = Banner::where('id', $id)->update(array('status' => 'inactive'));
                $response = array('status' => true, 'msg' => 'Status is Inactive');
            }
        }
        return $response;
    }
}
