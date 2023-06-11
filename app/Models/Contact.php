<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
    ];

    public function getAllContacts() {
        return $this->select('id', 'name', 'phone')->get();
    }

    public function contactAttributes() {
        return [
            "id"    => $this->id,
            "name"  => $this->name,
            "phone" => $this->phone,
        ];
    }
}
