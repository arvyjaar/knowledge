<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Doccategory
 *
 * @package App
 * @property string $title
 * @property text $description
*/
class Doccategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description'];
    
    
}
