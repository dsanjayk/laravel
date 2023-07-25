<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $parent_cats = Category::where( 'is_parent', 1 )->get();
        return view('backend.categories.create', compact('parent_cats') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate( $request, [

            'title' => 'string|required',
            'summary' => 'string|nullable',
            'is_parent' => 'sometimes|in:1',
            'parent_id' => 'nullable',
            'status' => 'nullable|in:active,inactive',
            ]

        );

        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Category::where('slug',$slug)->count();
        if($slug_count > 0){
            $slug = time().$slug;
        }
        $data['slug'] = $slug;
        $response = Category::create($data);
        if($response){
            return redirect()->route('category.index')->with('success','Successfully created category');
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
        $category = Category::where('id', $id)->first();
        $parent_cats = Category::where( 'is_parent', 1 )->get();
        return view('backend.categories.edit',compact('category','parent_cats'));
    } 

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate( $request, [

            'title' => 'string|required',
            'summary' => 'string|nullable',
            'is_parent' => 'sometimes|in:1',
            'parent_id' => 'nullable',
            'status' => 'nullable|in:active,inactive',
            ]

        );
       
        $data['title'] = $request->input('title');
        $data['summary'] = $request->input('summary');
        $data['photo'] = $request->input('photo');
        $data['status'] = $request->input('status');
        $data['is_parent'] = $request->input('is_parent');
        $data['is_parent'] = ( isset( $data['is_parent'] ) && $data['is_parent'] == 1 ) ? 1 : 0;
        $data['parent_id'] = $request->input('parent_id');
        $slug = Str::slug($request->input('title'));
        $slug_count = Category::where('slug',$slug)->count();
        if($slug_count > 0){
            $slug = time().$slug;
        }
        $data['slug'] = $slug;
        $response = Category::where('id',$id)->update($data);
        if($response){
            return redirect()->route('category.index')->with('success','Successfully updated category');
        }else{
            return back()->with('error','Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=Category::find($id);
        $response = $category->delete(); //returns true/false
        if($response){
            return redirect()->route('category.index')->with('success','Successfully deleted category');
        }else{
            return back()->with('error','Something went wrong!');
        }
    }

    public function categoryStatus(Request $request){
        $id = $request->input('id');
        $status = $request->input('mode');
        $response = array('status' => false, 'msg' => 'Error');
        if(!empty($id) && !empty($status)){
            if($status == 'true'){
                $response = Category::where('id', $id)->update(array('status' => 'active'));
                $response = array('status' => true, 'msg' => 'Status is Active');
            }else{
                $response = Category::where('id', $id)->update(array('status' => 'inactive'));
                $response = array('status' => true, 'msg' => 'Status is Inactive');
            }
        }
        return $response;
    }
}
