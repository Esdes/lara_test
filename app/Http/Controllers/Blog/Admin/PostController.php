<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogPostUpdateRequest;
use App\Http\Requests\BlogPostCreateRequest;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use App\Models\BlogPost;

class PostController extends BaseController
{
    /**
     * @var BlogPostRepository
    */
    private $blogPostRepository;

    /**
     * @var BlogCategoryRepository
    */
    private $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();

        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $paginator = $this->blogPostRepository->getAllWithPaginate();

        return view('blog.admin.posts.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $categoryList = $this->blogCategoryRepository->getForCombobox();

        return view('blog.admin.posts.create', compact('categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\BlogPostCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogPostCreateRequest $request)
    {
        $data = $request->input();

        $item =(new BlogPost())->create($data);

        if($item instanceof BlogPost) {
            return redirect()
                ->route('admin.blog.posts.edit', $item->id)
                ->with(['success' => 'Success saved']);
        } else {
            back()
            ->withErrors(['message' => 'Error save'])
            ->withInput();
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->blogPostRepository->getEdit($id);

        if (empty($item)) {
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForCombobox();

         return view('blog.admin.posts.edit', compact('categoryList', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BlogPostUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogPostUpdateRequest $request, $id)
    {
        $item = $this->blogPostRepository->getEdit($id);

        if(empty($item)){
            return back()
                ->withErrors(['message' => "id=[{$id}] not found"])
                ->withInput();
        }

        $data = $request->all();

        $result = $item->update($data);

        if($result){
            return redirect()
                ->route('admin.blog.posts.edit', $item->id)
                ->with(['success' => 'Success saved']);
        }else {
            return back()
                ->withErrors(['message' => 'Error save'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //soft delete, post stay in db 
        $result = BlogPost::destroy($id);

        //delete post delete from db
        //$result = BlogPost::find($id)->forceDelete();         

        if($result) {
            return redirect()
                ->route('admin.blog.posts.index')
                ->with(['success' => "Post with id [$id] was deleted"]);
        } else {
            return back()
                ->withErrors(['errors' => "Error of delete post with id [$id]"]);
        }
    }
}
