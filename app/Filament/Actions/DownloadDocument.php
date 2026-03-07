<?php

namespace App\Filament\Actions;

use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class DownloadDocument
{
    /**
     * Create a reusable Filament action that downloads a PDF for any record.
     *
     * Usage inside `table()` or `getHeaderActions()`/`getActions()`:
     *
     * DownloadDocument::make()
     */
    public static function make(string $name = 'downloadPdf'): Action
    {
        return Action::make($name)
            ->label('Download PDF')
            ->icon('heroicon-o-arrow-down-tray')
            ->color('success')
            ->action(function (Model $record) {
                $html = self::resolveHtml($record);
                $fileName = self::resolveFileName($record);

                $wrapped = view('documents.pdf', [ 'html' => $html ])->render();

                // Generate PDF using DomPDF (pure PHP, no Node.js/Puppeteer required)
                $pdf = Pdf::loadHTML($wrapped)
                    ->setPaper('a4', 'portrait')
                    ->setOption('margin_top', 10)
                    ->setOption('margin_right', 10)
                    ->setOption('margin_bottom', 10)
                    ->setOption('margin_left', 10);

                // Stream the PDF download
                return $pdf->download($fileName);
            });
    }

    protected static function resolveHtml(Model $record): string
    {
        // Prefer attribute accessor with header if available
        if (isset($record->content_with_header)) {
            return (string) $record->content_with_header;
        }

        // If a generic toHtml() method exists on the model, use it and prepend header
        if (method_exists($record, 'toHtml')) {
            $body = (string) $record->toHtml();
            $header = view('documents.partials.header')->render();
            return $header . $body;
        }

        // Fallback: try `content` field and prepend header if present
        $body = (string) data_get($record, 'content', '');
        $header = view('documents.partials.header')->render();
        return $header . $body;
    }

    protected static function resolveFileName(Model $record): string
    {
        $base = (string) (data_get($record, 'name')
            ?? data_get($record, 'title')
            ?? class_basename($record) . '-' . $record->getKey());

        $base = trim($base) !== '' ? $base : 'document';
        return Str::slug($base) . '.pdf';
    }
}


