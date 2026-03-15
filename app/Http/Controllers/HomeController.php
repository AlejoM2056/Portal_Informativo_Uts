<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Pagina principal
    public function index()
    {
        // Noticias destacadas 
        $noticiasDestacadas = Noticia::where('destacada', true)
            ->where('estado', 'publicada')
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

        // Obtener solo las noticias publicadas
        $noticias = Noticia::where('estado', 'publicada')
            ->orderBy('fecha', 'desc')
            ->get()
            ->map(function ($noticia) {
                return [
                    'id'               => $noticia->id,
                    'titulo'           => $noticia->titulo,
                    'categoria'        => $noticia->categoria,
                    'descripcion'      => $noticia->descripcion,
                    'contenido_completo' => $noticia->contenido,
                    'fecha'            => \Carbon\Carbon::parse($noticia->fecha)->format('d/m/Y'),
                    'imagen'           => $noticia->imagen ?? 'placeholder-noticia.jpg',
                    'estado'           => $noticia->estado
                ];
            })
            ->toArray();

        return view('home', compact('noticias', 'noticiasDestacadas'));
    }

    public function login()
    {
        return view('login');
    }

    // Dashboard administrador
    public function dashboard()
    {
        // Obtener las últimas 5 noticias
        $noticiasRecientes = Noticia::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $stats = [
            'total_noticias' => Noticia::count(),
            'noticias_publicadas' => Noticia::where('estado', 'publicado')->count(),
            'noticias_borrador' => Noticia::where('estado', 'borrador')->count(),
            'noticias_mes' => Noticia::whereMonth('created_at', now()->month)->count(),
        ];

        return view('admin.dashboard', compact('stats', 'noticiasRecientes'));
    }
}
