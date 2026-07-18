<?php

namespace App\Filament\Pages;

use App\Models\Report;
use App\Models\SchoolSettings;
use App\Models\User;
use BackedEnum;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Page;
use Mpdf\Mpdf;

class GenerateReport extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    protected string $view = 'filament.pages.generate-report';

    public function getTitle(): string
    {
        return __('reports.navigation.label3');
    }
    
    public static function getNavigationLabel(): string
    {
        return __('reports.navigation.label2');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('reports.navigation.group');
    }
    
    public $school_name;
    public $date;
    public $from;
    public $to;
    public $ref_number;
    public $subject;
    public $names = [];
    public $director_name;
    public $directorate;
    public $institution;
    public $municipality;
    public $location;
    public $reference_number;
    public $content;

    public function mount(): void
    {
        $school = SchoolSettings::first();

        $this->form->fill([
            'directorate' => '',
            'institution' => $school ? ($school->school_type . ' ' . $school->school_name) : '',
            'from'        => $school?->director->name ?? '',
            'to'          => '',
            'ref_number'  => '',
            'subject'     => '',
            'content'     => '',
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('directorate')->label('المديرية')->required(),
            TextInput::make('institution')->label('المؤسسة')->required(),
            TextInput::make('from')->label('من')->required(),
            TextInput::make('to')->label('إلى')->required(),
            TextInput::make('ref_number')->label('رقم الإرسال')->required(),
            TextInput::make('subject')->label('الموضوع')->required(),
            RichEditor::make('content')->label('المحتوى')->required(),
        ];
    }

    public function generateReport()
    {
        $data = $this->form->getState();

        $school = SchoolSettings::firstOrFail();

        $content = (string) ($data['content'] ?? '');

        $html = view('pdf.report', [
            'school_name'   => $school->school_type . $school->school_name ?? '',
            'date'          => now()->toDateString(),
            'from'          => $data['from'],
            'to'            => $data['to'],
            'ref_number'    => $data['ref_number'],
            'subject'       => $data['subject'],
            'director_name' => $school->director->name ?? '',
            'directorate'   => $data['directorate'],
            'institution'   => $data['institution'],
            'municipality'  => $school->municipality ?? '',
            'location'      => $school->location ?? '',
            'content'       => $content,
        ])->render();

        $directory = storage_path('app/reports');
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $fileName = 'report_' . uniqid() . '.pdf';
        $filePath = $directory . '/' . $fileName;

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
        $mpdf->WriteHTML($html);
        $mpdf->Output($filePath, 'F');

        Report::create([
            'school_name'   => $school->school_name ?? '',
            'date'          => now()->toDateString(),
            'from'          => $data['from'],
            'to'            => $data['to'],
            'ref_number'    => $data['ref_number'],
            'subject'       => $data['subject'],
            'director_name' => $school->director?->name ?? '',
            'directorate'   => $data['directorate'],
            'institution'   => $data['institution'],
            'municipality'  => $school->municipality ?? '',
            'location'      => $school->location ?? '',
            'content'       => $content,
            'file_path'     => 'reports/'.$fileName,
        ]);

        return response()->download($filePath);
    }

}
