<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\News;

class NewNewsShared extends Mailable
{
    use Queueable, SerializesModels;
    protected $newz;
    protected $editor;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $editor, News $newz)
    {
        $this->newz = $newz;
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
            ->view('emails.new_news_shared')
            ->subject('New News is shared')
            ->with('editor', $this->editor)            
            ->with('newz', $this->newz);
    }
}
