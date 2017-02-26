<?php

namespace Ashishov\EloquentCounter;

class UserCounter extends \Illuminate\Database\Eloquent\Model
{

    const ACTION_LIKE = 'like';
    const ACTION_VIEW = 'view';

    protected $table    = 'counter_user_counter';
    protected $fillable = ['class_name', 'object_id', 'user_id', 'action'];

}
