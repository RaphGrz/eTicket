<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //accès pour les admins
        Gate::define('access-admin', function (User $user) {
            return $user->role == 'admin';
        });

        //accès pour les profils edit
        Gate::define('access-profile', function (User $user, $profile_id) {
            return ($user->role == 'admin' || $user->id == $profile_id);
        });

        //accès privé
        Gate::define('access-private', function (User $user, $profile_id) {
            return ($user->id == $profile_id);
        });


        //accès pour les tickets
        Gate::define('access-ticket', function (User $user, Ticket $ticket) {
            $res = false;
            //ticket public donc visible par l'auteur et ceux du groupe
            if ($ticket->is_public) {
                foreach ($user->services as $service) {
                    if ($user->id == $ticket->User->id || $service->id == $ticket->service_id)
                        $res = true;
                }
            } else //privé donc visible par l'auteur, les gestionnaires du groupe
            {
                foreach ($user->services as $service) {
                    if ($user->id == $ticket->User->id || $user->role == 'gestionnaire' && $service->id == $ticket->service_id)
                        return $res = true;
                }
            }

            return $res;
        });

        //accès pour les gestionnaires du service
        Gate::define('access-gestionnaire', function (User $user, Ticket $ticket) {
            $res = false;
            foreach ($user->services as $service) {
                if ($user->role == 'gestionnaire' && $service->id == $ticket->service_id)
                    $res = true;
            }
            return $res;
        });
    }
}
