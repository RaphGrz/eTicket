<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Comment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function service()
    {
        $services = Service::orderBy('name')->get();

        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        return view('service/service', [
            'services' => $services
        ]);
    }

    public function store(Request $request)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        $request->validate([
            'name' => 'required'
        ]);

        Service::create([
            'name' => $request->name
        ]);

        return redirect('/service');
    }
    public function destroy($id)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        $service = Service::findOrFail($id);
        $service->delete();

        return redirect('/service');
    }
}
