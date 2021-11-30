<?php


namespace App\Http\Requests\API\User;

use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileAPIRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = User::$update_profile_rules;

        $rules['email'] = [
            'required',
            'max:255',
            'email',
            Rule::unique((new User())->getTable())->ignore($this->user()->id),
        ];

        return $rules;
    }

    /**
     * Get the validation labels that apply to the request.
     *
     * @return array
     */
    public function attributes(): array
    {
        return User::$rules_labels;
    }
}
