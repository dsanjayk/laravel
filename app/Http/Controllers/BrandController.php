<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('backend.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate( $request, [

            'title' => 'string|required',
            'status' => 'nullable|in:active,inactive',
            ]
        );

        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Brand::where('slug',$slug)->count();
        if($slug_count > 0){
            $slug = time().$slug;
        }
        $data['slug'] = $slug;
        $response = Brand::create($data);
        if($response){
            return redirect()->route('brand.index')->with('success','Successfully created brand');
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
        $brand = Brand::where('id',$id)->first();
        return view('backend.brands.edit', compact('brand') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate( $request, [

            'title' => 'string|required',
            'status' => 'nullable|in:active,inactive',
            ]

        );
       
        $data['title'] = $request->input('title');
        $data['status'] = $request->input('status');
        $slug = Str::slug($request->input('title'));
        $slug_count = Brand::where('slug',$slug)->count();
        if($slug_count > 0){
            $slug = time().$slug;
        }
        $data['slug'] = $slug;
        $response = Brand::where('id',$id)->update($data);
        if($response){
            return redirect()->route('brand.index')->with('success','Successfully updated brand');
        }else{
            return back()->with('error','Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand=Brand::find($id);
        $response = $brand->delete(); //returns true/false
        if($response){
            return redirect()->route('brand.index')->with('success','Successfully deleted brand');
        }else{
            return back()->with('error','Something went wrong!');
        }
    }

    public function brandStatus(Request $request){
        $id = $request->input('id');
        $status = $request->input('mode');
        $response = array('status' => false, 'msg' => 'Error');
        if(!empty($id) && !empty($status)){
            if($status == 'true'){
                $response = Brand::where('id', $id)->update(array('status' => 'active'));
                $response = array('status' => true, 'msg' => 'Status is Active');
            }else{
                $response = Brand::where('id', $id)->update(array('status' => 'inactive'));
                $response = array('status' => true, 'msg' => 'Status is Inactive');
            }
        }
        return $response;
    }
}
