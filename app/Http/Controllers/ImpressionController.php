<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImpressionController extends Controller
{
    public function store(Request $request)
    {
        \Log::info('🎯 ImpressionController hit');

        $logPath = storage_path('logs/daily-impressions.log');
        $today = now()->format('Y-m-d');
        $action = $request->input('action', 'impression');

        try {
            // Read and parse log
            $lines = \File::exists($logPath) ? explode("\n", trim(\File::get($logPath))) : [];

            $data = collect($lines)->filter(fn($line) => str_contains($line, ':'))
                ->mapWithKeys(function ($line) {
                    [$date, $rest] = explode(': ', $line, 2);
                    [$impressions, $clicks] = array_pad(explode(' | ', $rest), 2, 0);
                    return [$date => [
                        'impressions' => (int) $impressions,
                        'clicks' => (int) $clicks
                    ]];
                });

            // Ensure today has default counts
            if (!isset($data[$today])) {
                $data[$today] = ['impressions' => 0, 'clicks' => 0];
            }

            if ($action === 'click') {
                $data[$today]['clicks'] += 1;
                \Log::info("🖱️ Click counted: {$data[$today]['clicks']}");
            } else {
                $data[$today]['impressions'] += 1;
                \Log::info("👁️ Impression counted: {$data[$today]['impressions']}");
            }

            // Save back
            $content = $data->map(fn($counts, $date) => "$date: {$counts['impressions']} | {$counts['clicks']}")->implode("\n");
            \File::put($logPath, $content);

            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            \Log::error('❌ Error in ImpressionController: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}