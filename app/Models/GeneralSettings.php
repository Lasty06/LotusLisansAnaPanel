<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSettings extends Model
{
    use HasFactory;

    protected $table = "generalsettings";

    protected $fillable = ['botTokens','chatId','panelName','creditAlert','title','content','creditAlertContent','startDate','endDate'];
}
