<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 *
 * @package App
 * @property string $title
*/
class Tag extends Model
{
    protected $fillable = ['title'];
}
