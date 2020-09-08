<?php

namespace App\Providers;

use App\Events\PickPickedEvent;
use App\Events\PickQuantityRequiredChangedEvent as PickQuantity_RequiredChangedEvent_Alias;
use App\Events\PickRequestCreatedEvent as PickRequest_CreatedEvent_Alias;
use App\Events\PickUnpickedEvent;
use App\Listeners\Inventory\Created\AddToProductTotalQuantityListener;
use App\Listeners\Inventory\Deleted\DeductFromProductTotalQuantityListener;
use App\Listeners\Inventory\Updated\UpdateProductTotalQuantityListener;
use App\Listeners\Order\Created\PublishSnsNotificationListener;
use App\Listeners\Order\StatusChanged\CreatePickRequestsListener;
use App\Listeners\Order\StatusChanged\DeletePickRequestsListener;
use App\Listeners\Pick\Picked\FillPickRequestsPickedQuantityListener;
use App\Listeners\Pick\QuantityRequiredChanged\MovePickRequestToNewPickListener;
use App\Listeners\Pick\Unpicked\ClearPickRequestsQuantityPickedListener;
use App\Listeners\PickRequest\Created\AddQuantityToPicklistListener;
use App\Listeners\PickRequest\Deleted\RemoveQuantityFromPicklistListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class EventServiceProvider
 * @package App\Providers
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

        // App
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        // Product
        \App\Events\Product\CreatedEvent::class => [
            \App\Listeners\Product\Created\PublishSnsNotificationListener::class,
        ],

        \App\Events\Product\UpdatedEvent::class => [
            \App\Listeners\Product\Updated\PublishSnsNotificationListener::class
        ],

        // Order
        \App\Events\Order\CreatedEvent::class => [
            PublishSnsNotificationListener::class
        ],

        \App\Events\Order\UpdatedEvent::class => [
            \App\Listeners\Order\Updated\PublishSnsNotificationListener::class
        ],

        \App\Events\Order\StatusChangedEvent::class => [
            CreatePickRequestsListener::class,
            DeletePickRequestsListener::class,
        ],

        // Pick
        PickPickedEvent::class => [
            FillPickRequestsPickedQuantityListener::class,
        ],

        PickUnpickedEvent::class => [
            ClearPickRequestsQuantityPickedListener::class,
        ],

        PickQuantity_RequiredChangedEvent_Alias::class => [
            MovePickRequestToNewPickListener::class,
        ],

        // PickRequest
        PickRequest_CreatedEvent_Alias::class => [
            AddQuantityToPicklistListener::class,
        ],

        \App\Events\PickRequest\DeletedEvent::class => [
            RemoveQuantityFromPicklistListener::class
        ],

        // Inventory
        \App\Events\Inventory\CreatedEvent::class => [
            AddToProductTotalQuantityListener::class,
        ],

        \App\Events\Inventory\UpdatedEvent::class => [
            UpdateProductTotalQuantityListener::class,
        ],

        \App\Events\Inventory\DeletedEvent::class => [
            DeductFromProductTotalQuantityListener::class,
        ],


        // Other

    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
