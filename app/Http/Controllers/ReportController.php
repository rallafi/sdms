<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController
{
    /**
     * Show supervisor-only activity report with filters and summary.
     */
    public function activityReport(Request $request)
    {
        // Read filters from request
        $userId = $request->input('userId');
        $action = $request->input('action');
        $dateFrom = $request->input('dateFrom');
        $dateTo = $request->input('dateTo');

        // Base query with user relationship
        $logsQuery = ActivityLog::with('user');

        // Apply filters if provided
        if (!empty($userId)) {
            $logsQuery->where('user_id', $userId);
        }

        if (!empty($action)) {
            $logsQuery->where('action', $action);
        }

        if (!empty($dateFrom)) {
            $logsQuery->whereDate('created_at', '>=', $dateFrom);
        }

        if (!empty($dateTo)) {
            $logsQuery->whereDate('created_at', '<=', $dateTo);
        }

        // Clone filtered query for summary counts
        $summaryQuery = clone $logsQuery;

        // Get paginated logs ordered by latest
        $logs = $logsQuery
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Summary numbers for the (filtered) logs
        $totalLogs = $summaryQuery->count();
        $totalUploads = (clone $summaryQuery)->where('action', 'upload_document')->count();
        $totalDownloads = (clone $summaryQuery)->where('action', 'download_document')->count();
        $totalEdits = (clone $summaryQuery)->where('action', 'edit_document')->count();

        // Data for filters 
        $users = User::orderBy('name')->get();
        $actions = ActivityLog::select('action')
            ->distinct()
            ->orderBy('action')
            ->pluck('action');

        return view('reports.activity', [
            'logs' => $logs,
            'users' => $users,
            'actions' => $actions,
            'userId' => $userId,
            'actionFilter' => $action,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'totalLogs' => $totalLogs,
            'totalUploads' => $totalUploads,
            'totalDownloads' => $totalDownloads,
            'totalEdits' => $totalEdits,
        ]);
    }
}
