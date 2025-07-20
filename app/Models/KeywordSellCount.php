<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeywordSellCount extends Model
{
    //
	protected $table = 'keyword_sell_count';
	
	protected $fillable = ['name','count','cat1_amount','cat2_amount','cat3_amount'];	
}
