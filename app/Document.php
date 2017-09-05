<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class Document
 *
 * @package App
 * @property string $nr
 * @property text $title
 * @property string $signed
 * @property string $valid_from
 * @property string $valid_till
 * @property string $organisation
 * @property string $category
 * @property string $changed
*/
class Document extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['nr', 'title', 'signed', 'valid_from', 'valid_till', 'organisation_id', 'category_id', 'changed_id'];
    

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setSignedAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['signed'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['signed'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getSignedAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setValidFromAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['valid_from'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['valid_from'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getValidFromAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setValidTillAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['valid_till'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['valid_till'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getValidTillAttribute($input)
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
    public function setOrganisationIdAttribute($input)
    {
        $this->attributes['organisation_id'] = $input ? $input : null;
    }

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
    public function setChangedIdAttribute($input)
    {
        $this->attributes['changed_id'] = $input ? $input : null;
    }
    
    public function organisation()
    {
        return $this->belongsTo(Organisation::class, 'organisation_id')->withTrashed();
    }
    
    public function category()
    {
        return $this->belongsTo(Doccategory::class, 'category_id')->withTrashed();
    }
    
    public function changed()
    {
        return $this->belongsTo(Document::class, 'changed_id')->withTrashed();
    }
}