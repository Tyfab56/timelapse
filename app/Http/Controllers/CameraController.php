<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use Illuminate\Http\Request;

class CameraController extends Controller

{

    public function home()
    {
        return view('welcome');
    }

    public function camera($id)
    {
        // Verification que le id est dispo

        $camera = Camera::where('camera_id', '=', $id)->first();


        if (!$camera) {
            return to_route('home')->withErrors($message = 'Pas de caméra à ce nom');
        }
        return view('camera', compact('camera'));
    }

    public function find(Request $request)
    {
        $validated = $request->validate([
            'camera' => 'required|max:50',
        ]);
        $id = $request->camera;
        return to_route('camera.id', [$id]);
    }
}
