<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Events\Verified;
use App\Models\User;

class EmailVerificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user_id = $this->user_id();
        $hash_in_route = $this->route('hash');

        $user = $this->user_by_id($user_id);

        if (!hash_equals((string) $user_id, (string) $user->getKey())) {
            return false;
        }

        if (!hash_equals((string) $hash_in_route, sha1($user->getEmailForVerification()))) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
      /**
     * Get the user id from route
     *
     * @return int
     */
    public function user_id()
    {
        return $this->route('id');
    }

    /**
     * Get the user from database by id from route
     *
     * @return model
     */
    public function user_by_id()
    {
        $user_id = $this->user_id();
        return User::find($user_id);
    }

    /**
     * Fulfill the email verification request.
     *
     * @return void
     */
    public function fulfill()
    {
        $user = $this->user_by_id();

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();

            event(new Verified($user));
        }
    }
}
