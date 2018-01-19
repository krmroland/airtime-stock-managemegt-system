<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Network extends Model
{

    /**
     * the mass assignable fields
     * @var array
     */
    protected $fillable=["name","stock_id"];
    /**
     * unique indentifier
     *
     * @var string
     */
    protected $primaryKey="network_id";
    
    /**
     * network  has many denominations
     *
     * @return     HasMany
     */
    
    public function denominations()
    {
        return $this->hasMany(Denomination::class, "network_id", "network_id");
    }
    /**
     * a newtwork belongs to stock
     *
     * @return     \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stock()
    {
        return $this->belongsTo(Stock::class,"stock_id");
    }

    /**
     * Gets the saved attribute.
     *
     * @return     integer  The saved attribute.
     */
    public function getSavedAttribute()
    {
        return $this->gross*($this->saving/100);
    }
}
