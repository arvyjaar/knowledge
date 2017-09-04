<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class Question
 *
 * @package App
 * @property text $question
 * @property text $answer
 * @property tinyInteger $approved
 * @property string $author
 * @property string $category
 * @property string $department
*/
class Question extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['question', 'answer', 'approved', 'author', 'category_id', 'department_id'];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCategoryIdAttribute($input)
    {
        $this->attributes['category_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setDepartmentIdAttribute($input)
    {
        $this->attributes['department_id'] = $input ? $input : null;
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withTrashed();
    }
    
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id')->withTrashed();
    }
}
