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
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\Log;

class GenerateReport extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    protected string $view = 'filament.pages.generate-report';

    public static function canAccess(): bool
    {
        return Auth::user()->isHeadmaster();
    }

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

    protected ?SchoolSettings $school = null;

    public function mount(): void
    {
        $this->school = SchoolSettings::first();

        if(!$this->school){
             Notification::make()
            ->warning()
            ->title(__("reports.notifications.warning_title"))
            ->body(__("reports.notifications.warning_body"))
            ->persistent()
            ->send();
        }

        $this->form->fill([
            'directorate' => '',
            'institution' => $this->school ? ($this->school->school_type . ' ' . $this->school->school_name) : '',
            'from'        => $this->school?->director->name ?? '',
            'to'          => '',
            'ref_number'  => '',
            'subject'     => '',
            'content'     => '',
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('directorate')->label(__('reports.form.directorate'))->required(),
            TextInput::make('institution')->label(__('reports.form.institution'))->readOnly()->required(),
            TextInput::make('from')->label(__('reports.form.from'))->readOnly()->required(),
            TextInput::make('to')->label(__('reports.form.to'))->required(),
            TextInput::make('ref_number')->numeric()->label(__('reports.form.ref_number'))->required(),
            TextInput::make('subject')->label(__('reports.form.subject'))->required(),
            RichEditor::make('content')->label(__('reports.form.content'))->required(),
        ];
    }

    public function generateReport()
    {
        $data = $this->form->getState();
        $school = $this->school ?? SchoolSettings::firstOrFail();
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

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'default_font' => 'dejavusans', 'tempDir' => storage_path('app/mpdf-tmp'),]);
        $mpdf->WriteHTML($html);
        $mpdf->Output($filePath, 'F');

        $report = Report::create([
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
            'file_path'     => 'reports/' . $fileName,
        ]);

        return response()->download($filePath);
    }

}
