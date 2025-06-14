<?php

namespace Tests\Feature\Settings;

use App\Livewire\Settings\Appearance;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AppearanceUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_appearance_page_is_displayed(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get('/settings/appearance')->assertOk();
    }

    public function test_appearance_can_be_updated(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = Livewire::test(Appearance::class)
            ->set('appearance', 'dark')
            ->call('saveAppearance');

        $response->assertHasNoErrors();

        $this->assertDatabaseHas('settings', [
            'key' => 'appearance',
            'value' => 'dark',
        ]);
    }
}
