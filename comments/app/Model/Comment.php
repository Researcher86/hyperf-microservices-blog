<?php

declare (strict_types=1);

namespace Comments\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property $id
 * @property $post_id
 * @property $content
 * @property $status
 */
class Comment extends Model
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'post_id', 'content', 'status'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'post_id' => 'integer'];
}