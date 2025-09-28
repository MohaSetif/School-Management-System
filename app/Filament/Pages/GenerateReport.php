<?php

namespace App\Filament\Pages;

use App\Models\Report;
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
        $this->form->fill([
            'date' => now()->toDateString(),
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('school_name')->label('اسم المدرسة')->required(),
            TextInput::make('directorate')->label('المديرية')->required(),
            TextInput::make('institution')->label('المؤسسة')->required(),
            TextInput::make('municipality')->label('البلدية')->required(),
            TextInput::make('location')->label('المكان')->required(),
            DatePicker::make('date')->label('التاريخ')->required(),
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

        $content = (string) ($data['content'] ?? '<p></p>');

        $html = view('pdf.report', [
            'school_name'   => $data['school_name'],
            'date'          => $data['date'],
            'from'          => $data['from'],
            'to'            => $data['to'],
            'ref_number'    => $data['ref_number'],
            'subject'       => $data['subject'],
            'director_name' => User::where('role', 'headmaster')->first()->name,
            'directorate'   => $data['directorate'],
            'institution'   => $data['institution'],
            'municipality'  => $data['municipality'],
            'location'      => $data['location'],
            'content'       => $content,
        ])->render();

        // Ensure the directory exists
        $directory = storage_path('app/reports');
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $fileName = 'report_' . time() . '.pdf';
        $filePath = $directory . '/' . $fileName;

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
        $mpdf->WriteHTML($html);
        $mpdf->Output($filePath, 'F'); // Save to file

        Report::create([
            'school_name'  => $data['school_name'],
            'directorate'  => $data['directorate'],
            'institution'  => $data['institution'],
            'municipality' => $data['municipality'],
            'location'     => $data['location'],
            'date'         => $data['date'],
            'from'         => $data['from'],
            'to'           => $data['to'],
            'ref_number'   => $data['ref_number'],
            'subject'      => $data['subject'],
            'content'      => $content,
            'file_path'    => 'reports/'.$fileName, // relative path for download
        ]);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

}
