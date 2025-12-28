<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerifyDailyLogRequest;
use App\Models\DailyLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class VerificationController extends Controller
{
    /**
     * Display a listing of pending logs from subordinates.
     */
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $subordinateIds = $user->subordinates()->pluck('id');

        $query = DailyLog::whereIn('user_id', $subordinateIds)
            ->with('user')
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc');

        // Filter by status (default to pending)
        if ($request->filled('status')) {
            if ($request->status !== 'all') {
                $query->where('status', $request->status);
            }
        } else {
            $query->pending();
        }

        // Filter by subordinate
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }

        // Search by activity
        if ($request->filled('search')) {
            $query->where('activity', 'like', '%' . $request->search . '%');
        }

        $dailyLogs = $query->paginate(10)->withQueryString();
        $subordinates = $user->subordinates()->get();

        return view('verifications.index', compact('dailyLogs', 'subordinates'));
    }

    /**
     * Show verification form for a specific log.
     */
    public function show(DailyLog $dailyLog)
    {
        Gate::authorize('verify', $dailyLog);
        
        $dailyLog->load('user');

        return view('verifications.show', compact('dailyLog'));
    }

    /**
     * Process verification (approve or reject).
     */
    public function verify(VerifyDailyLogRequest $request, DailyLog $dailyLog)
    {
        Gate::authorize('verify', $dailyLog);

        $status = $request->action === 'approve' 
            ? DailyLog::STATUS_APPROVED 
            : DailyLog::STATUS_REJECTED;

        $dailyLog->update([
            'status' => $status,
            'verified_by' => Auth::id(),
            'verified_at' => now(),
            'approval_note' => $request->approval_note,
        ]);

        $message = $request->action === 'approve'
            ? 'Log harian berhasil disetujui.'
            : 'Log harian berhasil ditolak.';

        return redirect()
            ->route('verifications.index')
            ->with('success', $message);
    }
}
