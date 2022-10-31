<?php

namespace App\Models;

use App\Mail\NewMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Message extends Model
{
    use HasFactory;
    public $fillable = ['name', 'email', 'subject', 'message'];

    public static function boot()
    {
        parent::boot();
        static::created(function ($item) {
            $adminMail = "elcaptain.yousef.official@gmail.com";
            Mail::to($adminMail)->send(new NewMessage($item));
        });
    }
}
