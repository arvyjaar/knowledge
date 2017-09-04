<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Organisation
 *
 * @package App
 * @property string $title
*/
class Organisation extends Model
{
    use SoftDeletes;

    protected $fillable = ['title'];
}
