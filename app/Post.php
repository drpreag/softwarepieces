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

use Illuminate\Database\Eloquent\Model;

/**
 * Post
 *
 * @category Model
 * @package  App
 * @author   Predrag Vlajkovic drPreAG <predrag.vlajkovic@gmail.com>
 * @license  http://softwarepieces.com/licence Private owned
 * @link     http://softwarepieces.com/
 */
class Post extends Model
{
    public function inCategory()
    {
    	return $this->belongsTo('App\Category', 'id', 'category');
    }

//    public function comments()
//    {
//    	return $this->hasMany('App\Comment');
//    }

    /**
     * Relation
     *
     * @return App\User
     */
     public function isCreator()
    {
        return $this->belongsTo('App\User', 'creator', 'id');
    }  
}
