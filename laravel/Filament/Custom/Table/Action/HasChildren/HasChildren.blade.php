@php
    use Vinkla\Hashids\Facades\Hashids;
    use App\Models\Student;
    use App\Models\Course;
    use Illuminate\Support\Facades\Auth;

@endphp
<div>

    @foreach ($templates as $template)
        @if ($template['count'])
            <div style="margin: 10px 0;">
                <p style="font-size: .9rem">
                    {{ $template['tableLabel'] }}
                </p>
            </div>
            <x-filament-tables::container class="height-sm" style="overflow: auto;">
                <x-filament-tables::table>

                    @foreach ($template['tableHeaders'] as $header)
                        <x-filament-tables::header-cell :wire:key="$header">
                            {{ $header }}
                        </x-filament-tables::header-cell>
                    @endforeach

                    @foreach ($template['tableRecords'] as $record)
                        <x-filament-tables::row x-data="{
                            href: `{{ route($template['viewPageRoute'], Hashids::connection($template['model'])->encode($record['Id'])) }}`,
                            canView: `{{ isset($record['record']) ? Auth::user()->can('view', [$template['model'], $record['record']]) : false }}`,
                        }" recordUrl="true" :wire:key="$record['Id']">
                            @if ($record['Id'])
                                @foreach ($record['cellsLabel'] as $label)
                                    <x-filament-tables::cell>
                                        <template x-if="canView">
                                            <a style="padding: 12px 16px; display: block;" x-bind:href="href">
                                                {{ $label }}
                                            </a>
                                        </template>
                                        <template x-if="! canView">
                                            <p style="padding: 12px 16px;">
                                                {{ $label }}
                                            </p>
                                        </template>
                                    </x-filament-tables::cell>
                                @endforeach
                            @endif
                        </x-filament-tables::row>
                    @endforeach
                </x-filament-tables::table>

            </x-filament-tables::container>
        @endif
    @endforeach


</div>
