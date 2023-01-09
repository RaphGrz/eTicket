<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Ticket;
use App\Models\Comment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //page d'acceuil
    public function index()
    {
        $tickets = Ticket::latest()->get();

        return view('dashboard', [
            'tickets' => $tickets
        ]);
    }

    //page d'acceuil
    public function dashboard()
    {
        $tickets = Ticket::latest()->get();

        return view('dashboard', [
            'tickets' => $tickets
        ]);
    }

    //Bar de recherche
    public function search(Request $request): JsonResponse
    {
        $q = $request->input('q');

        $tickets = Ticket::where('title', 'like', '%' . $q . '%')->get();

        return response()->json([
            'tickets' => $tickets
        ]);
    }

    //page d'un ticket
    public function ticket($id)
    {
        $ticket = Ticket::findOrFail($id);

        if (Gate::allows('access-ticket', $ticket) || Gate::allows('access-admin')) {
            return view('ticket/ticket', [
                'ticket' => $ticket
            ]);
        } else
            abort(403);
    }

    //page pour créer un ticket
    public function create()
    {
        $services = Service::orderBy('name')->get();

        return view('ticket/create-ticket', [
            'services' => $services
        ]);
    }

    //fonction pour créer un ticket
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5',
            'content' => 'required|min:10',
        ]);

        $ticket = Ticket::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user_id,
            'is_public' => $request->is_public,
            'service_id' => $request->service_id
        ]);

        return redirect('/');
    }

    //fonction pour mettre a jour un ticket
    public function update(Request $request, $ticket_id)
    {
        $ticket = Ticket::findOrFail($ticket_id);
        $ticket->update([
            'status' => $request->status
        ]);

        return view('ticket/ticket', ['ticket' => $ticket]);
    }

    //fonction qui créé un commentaire
    public function comment(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment = Comment::create([
            'user_id' => $request->user_id,
            'ticket_id' => $request->ticket_id,
            'content' => $request->content,
        ]);

        //création d'un fichier si celui est envoyé
        if ($request->file != NULL) {
            $filename = time() . "." . $request->file->extension();
            $path = $request->file('file')->storeAs('upload', $filename, 'public');

            $file = Image::create([
                'path' => $path,
                'comment_id' => $comment->id
            ]);
        }

        return redirect()->route('ticket', ['id' => $request->ticket_id]);
    }

    //fonction pour DL une pièce jointe
    public function download($id)
    {
        $comment = Comment::findOrfail($id);
        $image = Image::where('comment_id', $id)->first();
        Storage::download('public/' . $image->path);
        return redirect()->route('ticket', ['id' => $comment->ticket_id]);
    }
}
