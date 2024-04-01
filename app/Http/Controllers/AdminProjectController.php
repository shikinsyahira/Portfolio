<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.portofolio.index',[
            'portofolio'=>Project::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.portofolio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:projects',
            'image' => 'image',
            'git_link' => 'required|url:http,https',
            
        ]);

        if($request->file('image')){
            $validateData['image'] = $request->file('image')->store('image_portofolio');
        }

        $validateData['user_id'] = auth()->user()->id;

        Project::create($validateData);

        return redirect('/admin/portofolio')->with('success', 'New Project has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        //get post by ID
        $project = Project::findOrFail($id);
        //render view with post
        return view('admin.portofolio.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $check_data = [
            'title' => 'required|max:255',
            'image' => 'image',
            'git_link' => 'required|url:http,https',
        ];
        $project = Project::findOrFail($id);

        if(!$request->slug == $project){
            $check_data['slug'] = 'required|unique:projects';
        }

        $validateData = $request->validate($check_data);
        $validateData['user_id'] = auth()->user()->id;
        if ($request->file('image')) {
            if ($request->oldimage) {
                Storage::delete($request->oldimage);
            }
            $validateData['image'] = $request->file('image')->store('image_portofolio');
        }
         
        $project->update($validateData);

        return redirect('/admin/portofolio')->with('success', 'Portofolio has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Project::destroy($id);
        return redirect('/admin/portofolio')->with('success', 'This portofolio has been deleted!');
    }

    public function check_slug(Request $request)
    {
    /* $slug = SlugService::createSlug(BlogPost::class, 'slug', $request->title); */
    $slug = SlugService::createSlug(Project::class, 'slug', $request->title);
    return response()->json(['slug' =>$slug]);
    }
}