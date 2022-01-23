<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionMeals extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['fio', 'phone', 'mealsName', 'orderDate', 'periodStart', 'periodEnd', 'subscriptionType', 'days','comment'];
}
