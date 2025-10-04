<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'father_name' => 'test',
        'mother_name'   => 'test',
        'phone_number'  => '123123',
        'address'       => 'asfdsdfasdfas',
        'dob'           => '1980-08-27',
        'gender'        => 'asdfasdf',
        'occupation'    => 'asfdasdf',
        'marital_status'=> 'asfdsafsfd',
        'referal_source'=> 'asdfasdfsa',
        'medical_history'=> 'adfasdfasdf',
        'emergency_contact'=>'adfsafdasdf',
        ]);
    }
}
