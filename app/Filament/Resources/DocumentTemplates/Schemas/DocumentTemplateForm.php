<?php

namespace App\Filament\Resources\DocumentTemplates\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;

class DocumentTemplateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
            ->required()
            ->maxLength(255),
            RichEditor::make('content')
            ->label('Document Body')
            ->toolbarButtons([
                'bold', 'italic', 'underline', 'bulletList', 'orderedList', 'link', 'h2', 'blockquote', 'codeBlock'
            ])
            ->fileAttachmentsDisk('public')
            ->fileAttachmentsDirectory('docs-attachments')
            ->columnSpanFull(),
            ]);
    }
}
