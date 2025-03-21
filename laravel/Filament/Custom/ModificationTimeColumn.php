<?php

namespace App\Filament\Custom;

use Filament\Tables\Columns\TextColumn;

class ModificationTimeColumn extends TextColumn
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('system.modification_time'));
        $this->sortable();
    }
}
