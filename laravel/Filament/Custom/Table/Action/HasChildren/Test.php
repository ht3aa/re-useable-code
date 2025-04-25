<?php

namespace App\Models;

class Test extends Model
{

	public function getChildrenTemplate(): array
	{

		return [
			[
				'count' => $this->count(),
				'tableLabel' => __('test', ['count' => $this->count()]),
				'tableHeaders' => [
					__('test.title'),
				],
				'model' => Test2::class, // child model
				'viewPageRoute' => 'filament.sis.resources.test.view',
				'tableRecords' => $this->test2()->get()->map(function ($item) {
					return [
						'Id' => $item->Id,
						'record' => $item,
						'cellsLabel' => [
							$item?->FullName,
						],
					];
				}),
			],
		];
	}

	// this method determaine if the model has children or not
	public function hasChildren(): bool {}
}
