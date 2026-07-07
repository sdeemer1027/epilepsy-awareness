<?php

/**
 * Epilepsy Support Platform (ESP)
 *
 * File: BaseModel.php
 * Purpose: Base Eloquent model for all ESP application models.
 *
 * @since 1.0.0-alpha
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use HasFactory;

    /**
     * Child models should override this property.
     *
     * @var array<int,string>
     */
    protected $fillable = [];

    /**
     * Child models should override this property.
     *
     * @var array<string,string>
     */
    protected $casts = [];
}
