<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SensitiveContent extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sensitive_content';
	
	protected $dates = ['updated_at'];

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type',  'content_id', 'author_uid', 'words'];
	
    protected $dateFormat = 'U';
}
