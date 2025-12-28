<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateDailyLogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $dailyLog = $this->route('daily_log');
        
        // Can only update own logs that can be edited (pending or Kepala Dinas auto-approved)
        return $dailyLog->user_id === Auth::id() && $dailyLog->canBeEdited();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'date' => ['required', 'date', 'before_or_equal:today'],
            'activity' => ['required', 'string', 'min:10', 'max:1000'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'date.required' => 'Tanggal harus diisi.',
            'date.date' => 'Format tanggal tidak valid.',
            'date.before_or_equal' => 'Tanggal tidak boleh lebih dari hari ini.',
            'activity.required' => 'Aktivitas harus diisi.',
            'activity.min' => 'Aktivitas minimal :min karakter.',
            'activity.max' => 'Aktivitas maksimal :max karakter.',
        ];
    }
}
