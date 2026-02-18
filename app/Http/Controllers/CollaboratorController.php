<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CollaboratorController extends Controller
{
    public function index()
    {
        return response()->json(Collaborator::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'document_number' => 'required|string|unique:collaborators',
            'email' => 'required|email|unique:collaborators',
            'phone' => 'nullable|string',
        ]);

        $collaborator = Collaborator::create($validated);

        return response()->json($collaborator, 201);
    }

    public function show(Collaborator $collaborator)
    {
        return response()->json($collaborator);
    }

    public function update(Request $request, Collaborator $collaborator)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'document_number' => 'required|string|unique:collaborators,document_number,' . $collaborator->id,
            'email' => 'required|email|unique:collaborators,email,' . $collaborator->id,
            'phone' => 'nullable|string',
        ]);

        $collaborator->update($validated);

        return response()->json($collaborator);
    }

    public function deactivate(Collaborator $collaborator)
    {
        $collaborator->update(['status' => 'inactive']);

        return response()->json(['message' => 'Colaborador desactivado']);
    }
}
