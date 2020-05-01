<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tutor;

class TutorController extends Controller
{

    public function index()
    {
        $latestTutor = Tutor::latest()->get();

        return view('admin.tutor.index', ['tutor' => $latestTutor]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
