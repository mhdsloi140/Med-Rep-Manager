<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Doctor;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\HttpCache\Store;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */ 
    public function __construct(protected CommentService $commentService)
    {

    }
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */ 
    public function create($id)
    {  
        // dd($id);
        $doctor=Doctor::find($id); 
        
   
        return view('comment.create',compact('doctor'));

    }
    public function store(StoreCommentRequest $request)
    {
        $data=$request->afterValidation();
        $comment=$this->commentService->store($data);
        return redirect()->route('doctor.index')->with('success',__('locale.comment_created'));
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
