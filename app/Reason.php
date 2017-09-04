<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reason
 *
 * @package App
 * @property string $title
*/
class Reason extends Model
{
    protected $fillable = ['title'];
}
