<?php

namespace App\Observers;

use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\BlogPost;

class BlogPostObserver
{

    /**
     * Handle the blog post "creating" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
    */
    public function creating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);
       
        $this->setSlug($blogPost);

        $this->setHtml($blogPost);

        $this->setUser($blogPost);
    }

    /**
     * Handle the blog post "created" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "updating" event.
     * 
     * @param  \App\Models\BlogPost $blogPost
     * @return void
    */
    public function updating(BlogPost $blogPost)
    {
       $this->setPublishedAt($blogPost);
       
       $this->setSlug($blogPost);
    }

    /**
     *
     * @param  \App\Models\BlogPost $blogPost
     * @return void
    */
    protected function setPublishedAt(BlogPost $blogPost)
    {
        $conditionPublished = empty($blogPost->published_at) && $blogPost->is_published;

        if($conditionPublished) {
           $blogPost->published_at = Carbon::now();
        }
    }

    /**
     * @param  \App\Models\BlogPost $blogPost
     * @return void
    */
    protected function setSlug(BlogPost $blogPost)
    {
        $conditionSlug = empty($blogPost->slug);

        if ($conditionSlug) {
            $blogPost->slug = Str::slug($blogPost->title);
        }
    }

    /**
     * @param  \App\Models\BlogPost $blogPost
     * @return void
    */
    protected function setHtml(BlogPost $blogPost)
    {
        $conditionHtml = $blogPost->isDirty('content_raw');

        if ($conditionHtml) {
            $blogPost->content_html = $blogPost->content_raw;
        }
    }

    /**
     * @param  \App\Models\BlogPost $blogPost
     * @return void
    */
    protected function setUser(BlogPost $blogPost)
    {
        $blogPost->user_id = auth()->id() ?? BlogPost::UNKNOWN_USER;
    }

    /**
     * Handle the blog post "updated" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
        //
    }


    /**
     * Handle the blog post "deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "restored" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "force deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }
}
