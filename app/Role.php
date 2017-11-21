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
 * Role
 *
 * @category Model
 * @package  App
 * @author   Predrag Vlajkovic drPreAG <predrag.vlajkovic@gmail.com>
 * @license  http://softwarepieces.com/licence Private owned
 * @link     http://softwarepieces.com/
 */
class Role extends Model
{
    /**
     * Relation
     *
     * @return App\User
     */
    public function users()
    {
        return $this->hasMany('App\User', 'role');
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
