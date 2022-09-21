<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\User_role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

use function PHPSTORM_META\type;

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

        $permissions = Cache::get('permissions');
        if (is_null($permissions)) {

            $permissions = DB::table('permissions')->pluck('code')->toArray();

            Cache::put('permissions', $permissions, 60);
        }
        foreach ($permissions as $permission_code) {
            Gate::define($permission_code, function ($user) use ($permission_code) {
                return $this->checkPermissions($user, $permission_code);
            });
        }
    }

    protected function checkPermissions($user, $code)
    {

        $permission_code = Cache::get('permission_code:'.$user->id.'');
        if (is_null($permission_code)) {

            $role_ids = DB::table('user_roles')->where('user_id', $user->id)->pluck('role_id')->toArray();
            $permission_ids = DB::table('permission_roles')->whereIn('role_id', $role_ids)->get();
            $permission_code = DB::table('permissions')->whereIn('id', $permission_ids->pluck('permission_id'))->pluck('code')->toArray();
            Cache::put('permission_code:'.$user->id.'', $permission_code, 60);
        }

        return in_array($code, $permission_code, true) === true ? true : false;
    }
}
