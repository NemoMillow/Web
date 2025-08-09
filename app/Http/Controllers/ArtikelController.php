<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class ArtikelController extends Controller
{
    private $articles = [
        'sheila-on-7'=>[
            'judul'=>'Sheila on 7 Live in Aceh',
            'gambar'=>'img/noimage.jpg',
            'tanggal'=>'25 Juni 2025',
            'kutipan'=>'Konser spesial yang menghadirkan nuansa nostalgia...',
            'konten'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit...',
            'kategori' => 'Musik'
        ],
        'festival-2024'=>[
            'judul'=>'Festival Budaya Aceh 2024',
            'gambar'=>'img/noimage.jpg',
            'tanggal'=>'20 Juni 2025',
            'kutipan'=>'Perayaan budaya terbesar di Aceh...',
            'konten'=>'Lorem ipsum dolor sit amet...',
            'kategori' => 'Festival'
        ],
        'pameran-seni-rupa'=>[
            'judul'=>'Pameran Seni Rupa Kontemporer',
            'gambar'=>'img/noimage.jpg',
            'tanggal'=>'15 Juni 2025',
            'kutipan'=>'Karya seni dari seniman muda Aceh...',
            'konten'=>'Lorem ipsum dolor sit amet...',
            'kategori' => 'Pameran'
        ],
        'workshop-batik'=>[
            'judul'=>'Workshop Membatik Khas Aceh',
            'gambar'=>'img/noimage.jpg',
            'tanggal'=>'10 Juni 2025',
            'kutipan'=>'Belajar teknik membatik tradisional Aceh...',
            'konten'=>'Lorem ipsum dolor sit amet...',
            'kategori' => 'Workshop'
        ],
        'pawai-budaya'=>[
            'judul'=>'Pawai Budaya Nusantara',
            'gambar'=>'img/noimage.jpg',
            'tanggal'=>'5 Juni 2025',
            'kutipan'=>'Menampilkan keragaman budaya Indonesia...',
            'konten'=>'Lorem ipsum dolor sit amet...',
            'kategori' => 'Budaya'
        ],
        'lomba-marawis'=>[
            'judul'=>'Lomba Marawis Se-Aceh',
            'gambar'=>'img/noimage.jpg',
            'tanggal'=>'1 Juni 2025',
            'kutipan'=>'Kompetisi marawis terbesar di Aceh...',
            'konten'=>'Lorem ipsum dolor sit amet...',
            'kategori' => 'Lomba'
        ],
        'pameran-foto'=>[
            'judul'=>'Pameran Fotografi Sejarah Aceh',
            'gambar'=>'img/noimage.jpg',
            'tanggal'=>'28 Mei 2025',
            'kutipan'=>'Mengungkap sejarah Aceh melalui lensa kamera...',
            'konten'=>'Lorem ipsum dolor sit amet...',
            'kategori' => 'Pameran'
        ],
        'seminar-budaya'=>[
            'judul'=>'Seminar Budaya Aceh',
            'gambar'=>'img/noimage.jpg',
            'tanggal'=>'25 Mei 2025',
            'kutipan'=>'Diskusi tentang pelestarian budaya Aceh...',
            'konten'=>'Lorem ipsum dolor sit amet...',
            'kategori' => 'Seminar'
        ],
        'pementasan-teater'=>[
            'judul'=>'Pementasan Teater Rakyat',
            'gambar'=>'img/noimage.jpg',
            'tanggal'=>'20 Mei 2025',
            'kutipan'=>'Kisah-kisah rakyat Aceh dalam pertunjukan teater...',
            'konten'=>'Lorem ipsum dolor sit amet...',
            'kategori' => 'Teater'
        ],
        'workshop-tari'=>[
            'judul'=>'Workshop Tari Tradisional',
            'gambar'=>'img/noimage.jpg',
            'tanggal'=>'15 Mei 2025',
            'kutipan'=>'Belajar berbagai tarian tradisional Aceh...',
            'konten'=>'Lorem ipsum dolor sit amet...',
            'kategori' => 'Workshop'
        ],
        'festival-kuliner'=>[
            'judul'=>'Festival Kuliner Aceh',
            'gambar'=>'img/noimage.jpg',
            'tanggal'=>'10 Mei 2025',
            'kutipan'=>'Nikmati kelezatan kuliner khas Aceh...',
            'konten'=>'Lorem ipsum dolor sit amet...',
            'kategori' => 'Kuliner'
        ]
    ];

    public function index(Request $request)
    {
        $perPage = 9; // Items per page
        $currentPage = $request->get('page', 1);
        
        // Convert array to collection
        $items = collect($this->articles);
        
        // Get current page items
        $currentPageItems = $items->forPage($currentPage, $perPage);
        
        // Create paginator instance
        $articles = new LengthAwarePaginator(
            $currentPageItems,
            $items->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query()
            ]
        );

        // Convert the paginator items to array with keys preserved
        $articlesArray = [];
        foreach ($currentPageItems as $key => $item) {
            $articlesArray[$key] = $item;
        }

        return view('pages.artikel_index', [
            'articles' => $articlesArray,
            'pagination' => $articles
        ]);
    }

    public function show($slug)
    {
        $article = $this->articles[$slug] ?? abort(404);
        return view('pages.artikel_detail', compact('article'));
    }
}