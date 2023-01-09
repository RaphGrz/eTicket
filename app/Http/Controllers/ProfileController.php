<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    //Bar de recherche
    public function search(Request $request): JsonResponse
    {
        $q = $request->input('q');

        $users = User::where('last_name', 'like', '%' . $q . '%')->get();

        return response()->json([
            'users' => $users
        ]);
    }

    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request, $profile_id)
    {
        $services = Service::orderBy('name')->get();
        $profile = User::findOrFail($profile_id);

        if (!Gate::allows('access-profile', $profile->id)) {
            abort(403);
        }

        return view('profile.edit', [
            'user' => $profile,
            'services' => $services
        ]);
    }

    /**
     * Update the user's profile information.
     *
     */
    public function update(Request $request, $profile_id)
    {
        if (!Gate::allows('access-profile', $profile_id)) {
            abort(403);
        }

        $profile = User::where('id', $profile_id);
        $profile->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'role' => $request->role,
            'email' => $request->email,
        ]);

        return Redirect::route('profile.edit', ['id' => $profile_id])->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $profile_id)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        $user = User::findOrfail($profile_id);

        $user->delete();

        return Redirect::to('/');
    }

    public function updateService(Request $request, $profile_id)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        $profile = User::findOrfail($profile_id);

        $profile->services()->attach($request->service_id);

        return Redirect::route('profile.edit', ['id' => $profile_id]);
    }

    public function destroyService(Request $request, $profile_id)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        $profile = User::findOrfail($profile_id);

        $profile->services()->detach($request->service_id);

        return Redirect::route('profile.edit', ['id' => $profile_id]);
    }

    public function list()
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        $users = User::orderBy('last_name')->get();

        return view('profile/list', [
            'users' => $users
        ]);
    }
}
