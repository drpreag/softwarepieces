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
use App\User as User;

/**
 * Category
 *
 * @category Model
 * @package  App
 * @author   Predrag Vlajkovic drPreAG <predrag.vlajkovic@gmail.com>
 * @license  http://softwarepieces.com/licence Private owned
 * @link     http://softwarepieces.com/
 */
class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name', 'sortid', 'creator', 'active'
    ];

    /**
     * Relation
     *
     * @return App\User
     */
    public function isCreator()
    {
    	return $this->belongsTo('App\User', 'creator', 'id');
    }

    /**
     * Relation
     *
     * @return App\User
     */
    public function news()
    {
    	return $this->hasMany('App\News');
    }

}
