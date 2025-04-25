<?php

namespace App\Filament\Custom\Tables;

use Filament\Tables\Actions\Action;
use Illuminate\Support\HtmlString;

class HasChildrenAction extends Action
{
	protected function setUp(): void
	{
		parent::setUp();

		$this->label(__('system.has_children'))
			->icon('heroicon-o-information-circle')
			->color('danger')
			->requiresConfirmation()
			->modalDescription(new HtmlString(''))
			->modalContentFooter(fn($record) => new HtmlString(view('has-children', [
				'templates' => $this->getRecord()->getChildrenTemplate(),
			])))
			->modalSubmitAction(false)
			->authorize(fn($record) => $record->hasChildren());
	}
}

