<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Realisation extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
        'additional_images' 
    ];

    // Accesseur pour récupérer les images supplémentaires
    public function getAdditionalImagesAttribute($value)
    {
        if (is_null($value)) {
            return [];
        }
        
        if (is_array($value)) {
            return $value;
        }
        
        return json_decode($value, true) ?? [];
    }

    // Mutateur pour sauvegarder les images supplémentaires
    public function setAdditionalImagesAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['additional_images'] = json_encode($value);
        } else {
            $this->attributes['additional_images'] = $value;
        }
    }
}