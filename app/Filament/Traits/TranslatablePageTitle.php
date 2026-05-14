<?php

namespace App\Filament\Traits;

trait TranslatablePageTitle
{
    public function getTitle(): string
    {
        // Determine page action automatically (create/edit/view/list)
        $action = collect(['create', 'edit', 'view', 'list'])
            ->first(fn($a) => str_contains(class_basename($this), ucfirst($a)));

        if ($action === 'list' || !$action) {
            return static::getResource()::getPluralModelLabel();
        }

        return __('pages.' . $action, [
            'resource' => static::getResource()::getModelLabel(),
        ]);
    }
}
