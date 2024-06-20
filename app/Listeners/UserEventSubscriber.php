<?php
 
namespace App\Listeners;
 
class UserEventSubscriber
{
    /**
     * Handle user login events.
     */
    public static function handleUserLogin($event) {
        return $event;
    }
 
    /**
     * Handle user logout events.
     */
    public static function handleUserLogout($event) {
        return $event;
    }
 
    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventSubscriber@handleUserLogin'
        );
 
        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventSubscriber@handleUserLogout'
        );
    }
}