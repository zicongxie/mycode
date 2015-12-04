<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SensitiveWords extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sensitive_words';
	
	protected $dates = ['updated_at'];

    protected $dateFormat = 'U';

    protected $guarded = array();
	
	public function getReplace()
	{
		
	}

	public function getSensitive()
	{
		
	}
}
