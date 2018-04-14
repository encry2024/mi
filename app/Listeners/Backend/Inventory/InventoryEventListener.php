<?php

namespace App\Listeners\Backend\Inventory;

/**
 * Class InventoryEventListener.
 */
class InventoryEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info($event->doer.' Created Item "'.$event->item.'"');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info($event->doer.' Updated Item "'.$event->item.'"');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info($event->doer.' Deleted Item "'.$event->item.'"');
    }

    /**
     * @param $event
     */
    public function onPermanentlyDeleted($event)
    {
        \Log::info($event->doer.' Permanently Deleted Item "'.$event->item.'"');
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        \Log::info($event->doer.' Restored Item "'.$event->item.'"');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Inventory\InventoryCreated::class,
            'App\Listeners\Backend\Inventory\InventoryEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Inventory\InventoryUpdated::class,
            'App\Listeners\Backend\Inventory\InventoryEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Inventory\InventoryDeleted::class,
            'App\Listeners\Backend\Inventory\InventoryEventListener@onDeleted'
        );

        $events->listen(
            \App\Events\Backend\Inventory\InventoryPermanentlyDeleted::class,
            'App\Listeners\Backend\Inventory\InventoryEventListener@onPermanentlyDeleted'
        );

        $events->listen(
            \App\Events\Backend\Inventory\InventoryRestored::class,
            'App\Listeners\Backend\Inventory\InventoryEventListener@onRestored'
        );
    }
}
