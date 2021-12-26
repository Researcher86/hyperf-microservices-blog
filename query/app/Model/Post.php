<?php

declare (strict_types=1);

namespace Query\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property $id
 * @property $post_id
 * @property $title
 * @property $comments
 */
class Post extends Model
{
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'post_id', 'title', 'comments'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'post_id' => 'integer', 'comments' => 'array'];
}