<?php

namespace App\Http\Requests;

use App\Models\DailyLog;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class VerifyDailyLogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $dailyLog = $this->route('daily_log');
        
        /** @var User $user */
        $user = Auth::user();
        
        // Check if log is still pending
        if (!$dailyLog->isPending()) {
            return false;
        }
        
        // Check if current user is the supervisor of log owner
        $logOwner = $dailyLog->user;
        return $logOwner->supervisor_id === $user->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'action' => ['required', 'in:approve,reject'],
            'approval_note' => ['nullable', 'string', 'max:500'],
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
            'action.required' => 'Aksi verifikasi harus dipilih.',
            'action.in' => 'Aksi harus approve atau reject.',
            'approval_note.max' => 'Catatan maksimal :max karakter.',
        ];
    }
}
