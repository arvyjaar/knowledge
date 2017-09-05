<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comment
 *
 * @package App
 * @property string $question
 * @property string $name
 * @property string $email
 * @property text $text
 * @property string $file
*/
class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'text', 'file', 'question_id'];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setQuestionIdAttribute($input)
    {
        $this->attributes['question_id'] = $input ? $input : null;
    }
    
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id')->withTrashed();
    }
    
}
