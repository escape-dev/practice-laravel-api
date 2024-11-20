<?php

namespace App\Rules;

use App\Models\Contact;
use Illuminate\Contracts\Validation\Rule;

class UniqueUserContacts implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $contact = Contact::where('phone', $value)
            ->where('user_id', auth()->id())
            ->exists();

        return !$contact;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Contact is already exists';
    }
}
