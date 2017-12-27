<?php
/**
 * Created by PhpStorm.
 * User: stoyan
 * Date: 12/24/17
 * Time: 11:49 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;


class Note extends Model
{
    protected $fillable =
        ['title', 'description', 'completed', 'user_id'];

    protected $hidden =
        ['created_at', 'updated_at', 'id'];
}