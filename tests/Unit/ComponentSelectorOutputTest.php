<?php

namespace Tests\Unit;

use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Exceptions\RootTagMissingFromViewException;
use Livewire\Livewire;
use Livewire\LivewireManager;
use function Livewire\str;

class ComponentSelectorOutputTest extends TestCase
{
    /** @test */
    public function component_renders_like_normale()
    {
        $component = Livewire::test(ComponentSelectorOutputStub::class);

        $this->assertTrue(
            str($component->payload['effects']['html'])->contains([$component->id(), 'foo'])
        );
    }

    /** @test */
    public function on_selector_output_contains_selector_and_selector_output()
    {
        $component = Livewire::test(ComponentSelectorOutputStub::class);

        $component->call('click');

        $this->assertTrue(
            str($component->payload['effects']['html'])->is('Clicked')
        );
        $this->assertTrue(
            str($component->payload['effects']['selector'])->is('#output')
        );

        $this->assertSame('Clicked', $component->lastRenderedDom);
    }
}

class ComponentSelectorOutputStub extends Component
{
    public function click()
    {
        $this->renderSelector('#output', 'Clicked');
    }

    public function render()
    {
        return app('view')->make('null-view');
    }
}
