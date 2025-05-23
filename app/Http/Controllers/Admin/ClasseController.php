<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Logic to fetch and display all classes
        return view('admin.classes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Logic to display the form for creating a new class
        return view('admin.classes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Logic to store the new class in the database
        // ...
        return redirect()->route('admin.classes.index')->with('success', 'Classe créée avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Logic to display a specific class
        return view('admin.classes.show', ['classe' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Logic to fetch the class and display the edit form
        return view('admin.classes.edit', ['classe' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Logic to update the class in the database
        // ...
        return redirect()->route('admin.classes.index')->with('success', 'Classe mise à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Logic to delete the class from the database
        // ...
        return redirect()->route('admin.classes.index')->with('success', 'Classe supprimée avec succès!');
    }
}
