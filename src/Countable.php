<?php

namespace Ashishov\EloquentCounter;

trait Countable
{
    protected $_counter = null;
    
    /**
     * Return the most liked content
     *
     * @return Integer
     */
    public function scopeMostLiked($query)
    {
        return $query->leftJoin('counter_counter', 'counter_counter.object_id', '=', $this->getTable() . '.id')
                ->whereClassName(static::class)
                ->orderBy('counter_counter.like_counter', 'DESC');
    }

    /**
     * Return the most viewed content
     *
     * @return Integer
     */
    public function scopeMostViewed($query)
    {
        return $query->leftJoin('counter_counter', function ($join) {
                    $join->on('counter_counter.object_id', '=', $this->getTable() . '.id')
                         ->where('counter_counter.class_name', '=', static::class);
                })
                ->orderBy('counter_counter.view_counter', 'DESC');
    }

    public function getCounter()
    {
        if (!isset($this->_counter)) {
            $class_name    = static::class;
            $this->_counter = Counter::firstOrCreate(['class_name' => $class_name, 'object_id' => $this->id]);
        }
        
        return $this->_counter;
    }

    public function user_counters()
    {
        return $this->hasMany(UserCounter::class, 'object_id')
                    ->where('class_name', static::class);
    }

    /**
     * Return authentificated users who viewed we know
     *
     * @return Integer
     */
    public function views()
    {
        
    }

    public function view()
    {
        if (!$this->isViewed()) {
            if (\Auth::user()) {
                $this->user_counters()->create(array(
                    'class_name' => static::class,
                    'object_id'  => $this->id,
                    'user_id'    => \Auth::user()->id,
                    'action'     => UserCounter::ACTION_VIEW
                ));
                $this->getCounter()->increment('view_counter');

                return true;
            } else {
                \Session::put($this->get_view_key(), time());
                $this->getCounter()->increment('view_counter');

                return true;
            }
        }
        return false;
    }

    /**
     * Return views count
     *
     * @return Integer
     */
    public function views_count()
    {
        return $this->getCounter()->view_counter;
    }

    /**
     * Is object already viewed by user?
     *
     * @return Boolean
     */
    public function isViewed()
    {
        if (!\Auth::user()) {
            $viewed = \Session::get($this->get_view_key());
            if (!empty($viewed)) {
                return true;
            }
        } else {
            $user_action = $this->user_counters()
                ->where('action', UserCounter::ACTION_VIEW)
                ->where('class_name', static::class)
                ->where('object_id', $this->id)
                ->where('user_id', \Auth::user()->id)
                ->count();

            if ($user_action > 0) {
                return true;
            }
        }
        return false;
    }

    /**
     * get session storage key for view
     *
     * @return String
     */
    private function get_view_key()
    {
        return 'viewed_' . static::class . '_' . $this->id;
    }

    /**
     * Return authentificated users who liked we know
     *
     * @return Integer
     */
    public function likes()
    {
        
    }

    /**
     * Do a like on this object
     * returns success or failure
     *
     * @return Boolean
     */
    public function like()
    {
        if (!$this->isLiked()) {
            if (\Auth::user()) {
                $this->user_counters()->create(array(
                    'class_name' => static::class,
                    'object_id'  => $this->id,
                    'user_id'    => \Auth::user()->id,
                    'action'     => UserCounter::ACTION_LIKE
                ));
                $this->getCounter()->increment('like_counter');

                return true;
            } else {
                \Session::put($this->get_like_key(), time());
                $this->getCounter()->increment('like_counter');

                return true;
            }
        }
        return false;
    }

    /**
     * Unlike on this object
     * returns success or failure
     *
     * @return Boolean
     */
    public function unlike()
    {
        if ($this->isLiked()) {
            if (\Auth::user()) {
                $this->user_counters()->where([
                    'class_name' => static::class,
                    'object_id'  => $this->id,
                    'user_id'    => \Auth::user()->id,
                    'action'     => UserCounter::ACTION_LIKE
                ])->delete();
                $this->getCounter()->decrement('like_counter');

                return true;
            } else {
                \Session::forget($this->get_like_key());
                $this->getCounter()->decrement('like_counter');

                return true;
            }
        }
        return false;
    }

    /**
     * Return likes count
     *
     * @return Integer
     */
    public function likes_count()
    {
        return $this->getCounter()->like_counter;
    }

    /**
     * Is object already liked by user?
     *
     * @return Boolean
     */
    public function isLiked()
    {
        if (!\Auth::user()) {
            $viewed = \Session::get($this->get_like_key());
            if (!empty($viewed)) {
                return true;
            }
        } else {
            $user_action = $this->user_counters()
                ->where('action', UserCounter::ACTION_LIKE)
                ->where('class_name', static::class)
                ->where('object_id', $this->id)
                ->where('user_id', \Auth::user()->id)
                ->count();
            if ($user_action > 0) {
                return true;
            }
        }
        return false;
    }

    /**
     * get session storage key for like
     *
     * @return String
     */
    private function get_like_key()
    {
        return 'liked_' . static::class . '_' . $this->id;
    }

}
