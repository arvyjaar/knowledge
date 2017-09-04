<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Appeal
 *
 * @package App
 * @property text $description
 * @property text $report
 * @property string $appellant
 * @property string $date
 * @property string $court_decision
*/
class Appeal extends Model
{
    use SoftDeletes;

    protected $fillable = ['description', 'report', 'appellant', 'date', 'court_decision_id'];
    

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCourtDecisionIdAttribute($input)
    {
        $this->attributes['court_decision_id'] = $input ? $input : null;
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'appeal_tag');
    }
    
    public function reason()
    {
        return $this->belongsToMany(Reason::class, 'appeal_reason');
    }
    
    public function court_decision()
    {
        return $this->belongsTo(CourtDecision::class, 'court_decision_id');
    }
}
