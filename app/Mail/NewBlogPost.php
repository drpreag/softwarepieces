<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Blog;
use App\User;

class NewBlogPost extends Mailable
{
    use Queueable, SerializesModels;
    protected $post;
    protected $editor;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $editor, Blog $post)
    {
        $this->post = $post;
        $this->editor = $editor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('root@softwarepieces.com')
            ->view('emails.new_blog_post')
            ->subject('New Blog Post is created')
            ->with('editor', $this->editor)            
            ->with('post', $this->post);
    }
}
