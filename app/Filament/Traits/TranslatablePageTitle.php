<?php

namespace App\Filament\Traits;

trait TranslatablePageTitle
{
    public function getTitle(): string
    {
        // Determine page action automatically (create/edit/view)
        $action = collect(['create', 'edit', 'view'])
            ->first(fn($a) => str_contains(class_basename($this), ucfirst($a)));

        return __('pages.' . $action, [
            'resource' => static::getResource()::getModelLabel(),
        ]);
    }
}
