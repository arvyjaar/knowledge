<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Department
 *
 * @package App
 * @property string $title
*/
class Department extends Model
{
    use SoftDeletes;

    protected $fillable = ['title'];
}
