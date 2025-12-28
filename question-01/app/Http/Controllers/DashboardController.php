<?php

namespace App\Http\Controllers;

use App\Models\DailyLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard based on user role.
     */
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Stats for current user (all roles)
        $myLogsThisMonth = DailyLog::forUser($user->id)
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->count();

        $myPendingLogs = DailyLog::forUser($user->id)
            ->pending()
            ->count();

        $myApprovedLogs = DailyLog::forUser($user->id)
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->approved()
            ->count();

        $myRejectedLogs = DailyLog::forUser($user->id)
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->rejected()
            ->count();

        // Recent logs (last 5)
        $recentLogs = DailyLog::forUser($user->id)
            ->with('verifier')
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Stats for supervisors (users with subordinates)
        $subordinatesStats = null;
        $pendingVerifications = collect();

        if ($user->hasSubordinates()) {
            $subordinateIds = $user->subordinates()->pluck('id');

            $subordinatesStats = [
                'total_subordinates' => $subordinateIds->count(),
                'pending_logs' => DailyLog::whereIn('user_id', $subordinateIds)
                    ->pending()
                    ->count(),
                'logs_this_month' => DailyLog::whereIn('user_id', $subordinateIds)
                    ->whereMonth('date', $currentMonth)
                    ->whereYear('date', $currentYear)
                    ->count(),
            ];

            // Get recent pending logs from subordinates (for quick access)
            $pendingVerifications = DailyLog::whereIn('user_id', $subordinateIds)
                ->pending()
                ->with('user')
                ->orderBy('date', 'desc')
                ->take(5)
                ->get();
        }

        return view('dashboard', compact(
            'user',
            'myLogsThisMonth',
            'myPendingLogs',
            'myApprovedLogs',
            'myRejectedLogs',
            'recentLogs',
            'subordinatesStats',
            'pendingVerifications'
        ));
    }
}
