<?php

namespace App\Livewire\CallCenter;

use App\Models\AgentEvaluationMonth;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AgentAudioReport extends Component
{
    public $startMonth;
    public $endMonth;
    public $agentId;

    // public function __invoke()
    // {
    //     $response = [];

    //     $response = $this->getReportData();
    //     $arrayResponse = [];
    //     foreach ($response as $row) {
    //         $arrayResponse[] = [
    //         'agent_name' => $row->agent->name,
    //         'month' => $row->month,
    //         'total_score' => $row->total_score,
    //         'remarks' => $row->remarks,
    //         'evaluated_files' => count($row->fileEvaluatedPermonth),
    //         'total_files' => count($row->filesPerMonth)
    //         ];
    //     }

    //     $response = $arrayResponse;


    //     // ✅ Check for malformed UTF-8
    //     $this->checkUtf8($response);

    //     return response()->json($response);
    // }

    private function checkUtf8($data, $path = '')
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $this->checkUtf8($value, $path . "[$key]");
            }
        } elseif (is_string($data) && !mb_check_encoding($data, 'UTF-8')) {
            logger()->warning("⚠️ Invalid UTF-8 at $path: " . substr($data, 0, 100));
        }
    }

    public function mount()
    {
        $activeMonth = Setting::where('key', 'active_month')->first();
        $startMonth = date('Y-m', strtotime($activeMonth->value . ' -1 month'));
        $endMonth = $activeMonth->value;

        $this->startMonth = $startMonth;
        $this->endMonth = $endMonth;
    }

    public function getReportData()
    {
        $reportData = AgentEvaluationMonth::query();

        if ($this->agentId) {
            $reportData->where("agent_id", $this->agentId);
        }

        $reportData = $reportData->whereBetween("month", [$this->startMonth, $this->endMonth])
            ->with("agent")
            ->paginate(10);

        return $reportData;
    }

    public function export()
    {
        $filename = 'agent-evaluation-' . now()->format('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Agent name', 'Month', 'Score', 'Remark', 'Evaluated files', 'Total files']);

            $reportData = $this->getReportData();
            foreach ($reportData as $row) {
                fputcsv($file, [
                    $row->agent->name,
                    $row->month,
                    $row->total_score,
                    $row->remarks,
                    count($row->fileEvaluatedPermonth),
                    count($row->filesPerMonth)
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf()
    {
        $filename = 'agent-evaluation-' . now()->format('Y-m-d') . '.pdf';

        $reportData = $this->getReportData();

        $mappedReportData = $reportData->map(function ($row) {
            return [
                'agent_name' => $this->sanitize($row->agent->name ?? ''),
                'month' => $this->sanitize($row->month ?? ''),
                'total_score' => $row->total_score,
                'remarks' => $this->sanitize($row->remarks ?? ''),
                'evaluated_files' => count($row->fileEvaluatedPermonth ?? []),
                'total_files' => count($row->filesPerMonth ?? []),
            ];
        });

        $pdf = Pdf::loadView('livewire.call-center.agent-audio-report-pdf', [
            'reportData' => $mappedReportData,
            'startMonth' => $this->startMonth,
            'endMonth' => $this->endMonth,
        ]);

        // return $pdf->download($filename);
        return response()->stream(function () use ($pdf) {
            echo $pdf->output();
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    private function sanitize($string)
    {
        return mb_convert_encoding($string, 'UTF-8', 'UTF-8');
    }

    function onOptionSelected($agentId, $startMonth, $endMonth)
    {
        if ($startMonth) {
            $this->startMonth = $startMonth;
        }

        if ($endMonth) {
            $this->endMonth = $endMonth;
        }

        if ($agentId) {
            $this->agentId = $agentId;
        }
    }

    public function render()
    {
        $months = AgentEvaluationMonth::distinct('month')->pluck('month');
        if (!in_array($this->startMonth, $months->toArray())) {
            $months->prepend($this->startMonth);
        }

        return view('livewire.call-center.agent-audio-report', [
            'reportData' => $this->getReportData(),
            'agents' => AgentEvaluationMonth::distinct('agent_id')->with('agent')->get()->pluck('agent'),
            'months' => $months,
        ]);
    }
}
