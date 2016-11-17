<?php

namespace App;
use Image;
use App\Photo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'minimun_sale', 'bought', 'due_date', 'supplier_id', 'category_id'];
    protected $dates = ['due_date'];

       /**
     * set due_date attribute
     *
     *
     * @return void
    public function setDueDateAttribute($date)
    {
        $this->attributes['due_date'] = Carbon::parse($date);
    }

     */

    /**
     * set up asseter 
     *
     * @return Carbon 
     */
    public function getDueDateAttribute($date)
    {
        return new Carbon($date);
    }

     /**
     *  Check if bough exceed sale
     *
     * @return Boolean
     */

   public function isSaleExceed()
    {
        return $this->bought >= $this->minimun_sale;
   }

       /**
     * check if user can bough the product
     *
     * @return boolean
     */
    
    public function canBuy()
    {
        return $this->isSaleExceed() && $this->isDue();

    }
    public function due()
    {
        return $this->isSaleExceed() && $this->isDue();
    } 

    public function cannotBuy()
    {
        return !$this->isSaleExceed() && !$this->isDue();

    }

    public function expired(){
        return !$this->isSaleExceed() && $this->isDue();
    }

  /**
     * Check whether the date is due
     *
     * @return boolean
     */
    public function isDue()
    {
        return $this->due_date->lt(Carbon::now());
    }




        /**
     * The orders the belong to the products 
     * 
     * @return 
     */

    public function orders()
    {
        return $this->belongsToMany('App\Order', 'order_details');
    }

  
    /**
     * undocumented function
     *
     * @return void
     */
    public function photos()
    {
        return $this->hasMany('App\Photo');
    }
    
    /**
     * undocumented function
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }
    
    
    public function scopePending()
    {
        return $this->where([
            ['due_date', '>', Carbon::now()],
            ['minimun_sale', '>', DB::raw('bought')]
        ]);
    }

    public function scopeSuccess(){

        return $this->where([ 
            ['due_date', '<', Carbon::now()],
            ['minimun_sale', '<', DB::raw('bought')]
        ]);

    }

    public function scopeFail(){

        return $this->where([ 
            ['due_date', '<', Carbon::now()],
            ['minimun_sale', '>', DB::raw('bought')]
        ]);

    }

    public function scopeLatest(){
        return $this->where([ 
            ['due_date', '>', Carbon::now()],
        ]);
    }

    public function scopeSearch($query, $val){
        return $query->where([ 
            ['name', 'like', $val], 
            ['due_date', '>', Carbon::now()],
        ]);
    }



    public function addPhoto(Photo $photo, $main){
        if($main){
            $photo->main = true;
            return $this->photos()->save($photo)->createThumbnail();
        }
            return $this->photos()->save($photo);
    }

    
}
