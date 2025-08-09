<?php
namespace App\Http\Controllers;
class AcaraController extends Controller
{
    private $events = [
        'perangkap-daging' => [
            'title'=>'Perangkap Daging',
            'date'=>'19 Juli 2025',
            'time'=>'20:30 - 23:00 WIB',
            'location'=>'Gedung Indoor UPTD. Taman Seni dan Budaya Aceh',
            'image'=>'img/perangkapdaging.jpg',
            'description'=>'Perangkap Daging adalah pertunjukan monolog karya Azhari Aiyub...',
        ],
        'gelumbang-raya'=>[
            'title'=>'Gelumbang Raya',
            'date'=>'12 Juli 2025',
            'time'=>'20:15 WIB',
            'location'=>'Gedung Indoor Taman Budaya',
            'image'=>'img/gelumbangraya.jpg',
            'description'=>'Gelumbang Raya merupakan seri dari proses pengembangan...',
        ],
        'sound-of-nanggroe'=>[
            'title'=>'Sound of Nanggroe',
            'date'=>'06 Juli 2025',
            'location'=>'Depan Kantor UPTD UPTD. Taman Seni dan Budaya Aceh',
            'image'=>'img/son.jpg',
            'description'=>'Acara lintas generasi...',
        ],
        'panoptycon'=>[
            'title'=>'PanopTycon',
            'date'=>'22 Juni 2025',
            'time'=>'20:00 WIB',
            'location'=>'Gedung Indoor Taman Budaya',
            'image'=>'img/panoptycon.jpg',
            'description'=>'Kita diawasi...',
        ],
    ];

    public function index()
    {
        // Format the events data to include proper date objects
        $formattedEvents = [];
        foreach ($this->events as $slug => $event) {
            $event['date'] = \Carbon\Carbon::parse($event['date']);
            $formattedEvents[$slug] = $event;
        }
        
        // Sort events by date
        uasort($formattedEvents, function($a, $b) {
            return $a['date'] <=> $b['date'];
        });
        
        return view('pages.acara', ['events' => $formattedEvents]);
    }

    public function show($slug)
    {
        $event = $this->events[$slug] ?? abort(404);
        return view('pages.acara_detail', compact('event'));
    }
}