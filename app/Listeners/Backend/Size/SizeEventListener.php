<?php

namespace App\Listeners\Backend\Size;

/**
 * Class SizeEventListener.
 */
class SizeEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info($event->doer.' Created Size "'.$event->size.'"');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info($event->doer.' Updated Size "'.$event->size.'"');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info($event->doer.' Deleted Size "'.$event->size.'"');
    }

    /**
     * @param $event
     */
    public function onPermanentlyDeleted($event)
    {
        \Log::info($event->doer.' Permanently Deleted Size "'.$event->size.'"');
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        \Log::info($event->doer.' Restored Size "'.$event->size.'"');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Size\SizeCreated::class,
            'App\Listeners\Backend\Size\SizeEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Size\SizeUpdated::class,
            'App\Listeners\Backend\Size\SizeEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Size\SizeDeleted::class,
            'App\Listeners\Backend\Size\SizeEventListener@onDeleted'
        );

        $events->listen(
            \App\Events\Backend\Size\SizeConfirmed::class,
            'App\Listeners\Backend\Size\SizeEventListener@onConfirmed'
        );

        $events->listen(
            \App\Events\Backend\Size\SizeUnconfirmed::class,
            'App\Listeners\Backend\Size\SizeEventListener@onUnconfirmed'
        );

        $events->listen(
            \App\Events\Backend\Size\SizePasswordChanged::class,
            'App\Listeners\Backend\Size\SizeEventListener@onPasswordChanged'
        );

        $events->listen(
            \App\Events\Backend\Size\SizeDeactivated::class,
            'App\Listeners\Backend\Size\SizeEventListener@onDeactivated'
        );

        $events->listen(
            \App\Events\Backend\Size\SizeReactivated::class,
            'App\Listeners\Backend\Size\SizeEventListener@onReactivated'
        );

        $events->listen(
            \App\Events\Backend\Size\SizeSocialDeleted::class,
            'App\Listeners\Backend\Size\SizeEventListener@onSocialDeleted'
        );

        $events->listen(
            \App\Events\Backend\Size\SizePermanentlyDeleted::class,
            'App\Listeners\Backend\Size\SizeEventListener@onPermanentlyDeleted'
        );

        $events->listen(
            \App\Events\Backend\Size\SizeRestored::class,
            'App\Listeners\Backend\Size\SizeEventListener@onRestored'
        );
    }
}
