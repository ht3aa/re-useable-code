<?php

namespace App\Filament\Custom\Actions;

use Filament\Forms\Components\CheckboxList;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel as LabelInterface;
use Illuminate\Contracts\Support\Arrayable;
use UnitEnum;

class CustomCheckList extends CheckboxList
{
    public function getDescriptions(): array
    {
        $descriptions = $this->evaluate($this->options)->mapWithKeys(fn($item, $key) => [$key => $item['description']]);

        if ($descriptions instanceof Arrayable) {
            $descriptions = $descriptions->toArray();
        }

        if (
            empty($descriptions) &&
            is_string($this->options) &&
            enum_exists($this->options) &&
            is_a($this->options, HasDescription::class, allow_string: true)
        ) {
            $descriptions = array_reduce($this->options::cases(), function (array $carry, HasDescription & UnitEnum $case): array {
                if (filled($description = $case->getDescription())) {
                    $carry[$case?->value ?? $case->name] = $description;
                }

                return $carry;
            }, []);
        }

        return $descriptions;
    }

    public function getOptions(): array
    {
        $options = $this->evaluate($this->options)->mapWithKeys(fn($item, $key) => [$key => $item['label']]) ?? [];

        if (
            is_string($options) &&
            enum_exists($enum = $options)
        ) {
            if (is_a($enum, LabelInterface::class, allow_string: true)) {
                return array_reduce($enum::cases(), function (array $carry, LabelInterface & UnitEnum $case): array {
                    $carry[$case?->value ?? $case->name] = $case->getLabel() ?? $case->name;

                    return $carry;
                }, []);
            }

            return array_reduce($enum::cases(), function (array $carry, UnitEnum $case): array {
                $carry[$case?->value ?? $case->name] = $case->name;

                return $carry;
            }, []);
        }

        if ($options instanceof Arrayable) {
            $options = $options->toArray();
        }

        return $options;
    }
}
