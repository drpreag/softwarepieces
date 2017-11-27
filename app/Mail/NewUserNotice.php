<?php
/**
 * PHP version 7.1
 *
 * @category Model
 * @package  App
 * @author   Predrag Vlajkovic <predrag.vlajkovic@gmail.com>
 * @license  http://softwarepieces.com/licence Private owned
 * @link     http://softwarepieces.com/
 */

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

/**
 * NewUserNotice, used to notify all administrators that new user is registered
 *
 * @category Mail
 * @package  App
 * @author   Predrag Vlajkovic drPreAG <predrag.vlajkovic@gmail.com>
 * @license  http://softwarepieces.com/licence Private owned
 * @link     http://softwarepieces.com/
 */
class NewUserNotice extends Mailable
{
    use Queueable, SerializesModels;
    protected $newUser;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $registeredUser)
    {
        $this->newUser = $registeredUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $totalUsers = User::count();

        return $this->from('root@softwarepieces.com')
            ->view('emails.new_user_notification')
            ->subject('New user registered notification')
            ->with('totalUsers', $totalUsers)
            ->with('user', $this->newUser);
    }
}
