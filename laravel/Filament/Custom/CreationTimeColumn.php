<?php

namespace App\Filament\Custom;

use Filament\Tables\Columns\TextColumn;

class CreationTimeColumn extends TextColumn
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('system.creation_time'));
        $this->sortable();
    }
}
