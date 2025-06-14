<?php

namespace App\Livewire\Settings;

use App\Models\Setting;
use Livewire\Component;

class Appearance extends Component
{
    public string $appearance = 'system';

    public function mount(): void
    {
        $this->appearance = setting('appearance', 'system');
    }

    public function saveAppearance(): void
    {
        Setting::updateOrCreate(
            ['key' => 'appearance'],
            ['value' => $this->appearance]
        );

        $this->dispatch('appearance-updated');
    }
}
