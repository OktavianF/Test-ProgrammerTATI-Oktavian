<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDailyLogRequest;
use App\Http\Requests\UpdateDailyLogRequest;
use App\Models\DailyLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DailyLogController extends Controller
{
    /**
     * Display a listing of the user's daily logs.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $query = DailyLog::forUser($user->id)
            ->with('verifier')
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
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

        return view('daily-logs.index', compact('dailyLogs'));
    }

    /**
     * Show the form for creating a new daily log.
     */
    public function create()
    {
        return view('daily-logs.create');
    }

    /**
     * Store a newly created daily log.
     */
    public function store(StoreDailyLogRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Kepala Dinas: auto-approve (no verification needed)
        $isKepalaDinas = $user->isKepalaDinas();
        
        $dailyLog = DailyLog::create([
            'user_id' => $user->id,
            'date' => $request->date,
            'activity' => $request->activity,
            'status' => $isKepalaDinas ? DailyLog::STATUS_APPROVED : DailyLog::STATUS_PENDING,
            'verified_by' => $isKepalaDinas ? $user->id : null,
            'verified_at' => $isKepalaDinas ? now() : null,
            'approval_note' => $isKepalaDinas ? 'Auto-approved (Kepala Dinas)' : null,
        ]);

        $message = $isKepalaDinas 
            ? 'Log harian berhasil ditambahkan dan otomatis disetujui.'
            : 'Log harian berhasil ditambahkan.';

        return redirect()
            ->route('daily-logs.index')
            ->with('success', $message);
    }

    /**
     * Display the specified daily log.
     */
    public function show(DailyLog $dailyLog)
    {
        Gate::authorize('view', $dailyLog);
        
        $dailyLog->load(['user', 'verifier']);

        return view('daily-logs.show', compact('dailyLog'));
    }

    /**
     * Show the form for editing the specified daily log.
     */
    public function edit(DailyLog $dailyLog)
    {
        Gate::authorize('update', $dailyLog);

        return view('daily-logs.edit', compact('dailyLog'));
    }

    /**
     * Update the specified daily log.
     */
    public function update(UpdateDailyLogRequest $request, DailyLog $dailyLog)
    {
        Gate::authorize('update', $dailyLog);

        $dailyLog->update([
            'date' => $request->date,
            'activity' => $request->activity,
        ]);

        return redirect()
            ->route('daily-logs.index')
            ->with('success', 'Log harian berhasil diperbarui.');
    }

    /**
     * Remove the specified daily log.
     */
    public function destroy(DailyLog $dailyLog)
    {
        Gate::authorize('delete', $dailyLog);

        $dailyLog->delete();

        return redirect()
            ->route('daily-logs.index')
            ->with('success', 'Log harian berhasil dihapus.');
    }
}
