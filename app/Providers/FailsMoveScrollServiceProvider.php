<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class FailsMoveScrollServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 */
	public function register()
	{
	    //
	}

	/**
	 * Bootstrap services.
	 */
	public function boot()
	{
        Component::macro('scrollOnFail', function (string $query, string $event, callable $closure) {
            /* @var Component $this */

            try {
                $closure();
            } catch (ValidationException $e) {
                ddd($e);
                $this->dispatchBrowserEvent('livewireHookEvent:'.$event, [
                    'query' => $query,
                    'evnet' => $event,
                    'target' => $e
                ]);

                throw $e;
            }
        });
	}
}
