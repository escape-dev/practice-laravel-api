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
        'user_id',
    ];

    public function getAllContacts($user_id) {
        return $this->select('id', 'name', 'phone', 'user_id')
                    ->where('user_id', '=', $user_id)
                    ->get();
    }

    public function contactAttributes() {
        return [
            'id'      => $this->id,
            'name'    => $this->name,
            'phone'   => $this->phone,
            'user_id' => $this->user_id,
        ];
    }
}
