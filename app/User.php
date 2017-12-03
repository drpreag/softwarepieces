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
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role as Role;
use App\News as News;
use App\Blog as Blog;

/**
 * User
 *
 * @category Model
 * @package  App
 * @author   Predrag Vlajkovic <predrag.vlajkovic@gmail.com>
 * @license  http://softwarepieces.com/licence Private owned
 * @link     http://softwarepieces.com/
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'active', 'role', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * Relation
     *
     * @return App\Role
     */
    public function hasRole()
    {
        return $this->belongsTo('App\Role', 'role', 'id');
    }

    /**
     * Number of news articles that user shared
     *
     * @return integer
     */
    public function sharedNewsCount()
    {
        return News::where('creator', $this->id)->count();
    }

    /**
     * Number of news articles that user wrote
     *
     * @return integer
     */
    public function writtenBlogCount()
    {
        return Blog::where('creator', $this->id)->count();
    }    
}
