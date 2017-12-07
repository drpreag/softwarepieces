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
 * News
 *
 * @category Model
 * @package  App
 * @author   Predrag Vlajkovic drPreAG <predrag.vlajkovic@gmail.com>
 * @license  http://softwarepieces.com/licence Private owned
 * @link     http://softwarepieces.com/
 */
class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'url', 'title', 'imgurl', 'post', 'category', 'creator', 'created_at', 'updated_at'
    ];    

    /**
     * Relation
     *
     * @return App\Category
     */
    public function inCategory()
    {
    	return $this->belongsTo('App\Category', 'category', 'id');
    }

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
