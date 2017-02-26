<?php

namespace Ashishov\EloquentCounter;

class Counter extends \Illuminate\Database\Eloquent\Model
{

    protected $table = 'counter_counter';
    protected $fillable = ['class_name', 'object_id'];

}
