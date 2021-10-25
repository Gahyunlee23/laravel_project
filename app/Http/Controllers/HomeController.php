<?php

namespace App\Http\Controllers;

use App\Curator;
use App\Hotel;
use App\HotelFaq;
use App\HotelImage;
use App\HotelOption;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Orchid\Experiment\Experiment;
use Psr\SimpleCache\InvalidArgumentException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $banner;

    public function __construct()
    {
        $experiment = new Experiment('AB');
        $experiment->startAndSaveCookie([
            'A' => 1,
            'B' => 0,
        ]);
    }

    public function healthCheck()
    {
        return response('Hello World', 200)
            ->header('Content-Type', 'text/plain');
    }
    /**
     * Show the application dashboard.
     *
     * @param string $curator_page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Support\Renderable|\Illuminate\Http\RedirectResponse|Response|\Illuminate\Routing\Redirector
     */
    public function index($curator_page ='')
    {
        if (Str::of(request()->getHttpHost())->contains(['livinginhotel.kr', 'livinginhotel.co.kr'])) {
            return redirect('https://www.livinginhotel.com' . Str::of(url()->current())->after('livinginhotel.kr')->after('livinginhotel.co.kr'));
        }
        if (!Str::of(request()->getHttpHost())->contains(['www', 'dev'])) {
            return redirect('https://www.livinginhotel.com' . Str::of(url()->current())->after('livinginhotel.com'));
        }
        $curator = null;
        if ($curator_page !== '' && $curator_page !== null) {
            $curator = Curator::whereVisible('1')->whereUserPage($curator_page)->first() ?? abort(404);
        }
            $hotels = Hotel::with(['options' => function ($query) {
                $query->whereDisable('N');
                $query->orderBy('id');
            },
                'images' => function ($query) {
                    $query->whereDisable('N');
                    $query->orderBy('id');
                },
                'faqs' => function ($query) {
                    $query->orderBy('id');
                },
                'rooms' => function ($query) {
                    $query->whereDisable('N');
                    $query->orderBy('id');
                },
                'checkPoints' => function ($query) {
                    $query->whereDisable('N');
                    $query->orderBy('id');
                }])
                ->curator($curator)
                ->orderByRaw('hotels.order is null asc')->orderBy('order', 'ASC')
                ->whereStatus('2')
                ->get();

        return response()
            ->view('main',
                [
                    'hotels' => $hotels,
                    'curator' => $curator
                ],
        200);
    }
    public function hotelNamingView($hotel_name, $curator_page ='')
    {
        if (Str::of(request()->getHttpHost())->contains(['livinginhotel.kr', 'livinginhotel.co.kr'])) {
            return redirect('https://www.livinginhotel.com' . Str::of(url()->current())->after('livinginhotel.kr')->after('livinginhotel.co.kr'));
        }
        if (!Str::of(request()->getHttpHost())->contains(['www'])) {
            return redirect('https://www.livinginhotel.com' . Str::of(url()->current())->after('livinginhotel.com'));
        }
        $curator = null;
        if ($curator_page !== '' && $curator_page !== null) {
            $curator = Curator::whereVisible('1')->whereUserPage($curator_page)->first();
        }
        $hotel_name = Str::of($hotel_name)->replace('-',' ');
        $naming_check = HotelOption::whereTitleEn($hotel_name)->where('disable','=','N')->get();

        if($naming_check->count()>=1){
            $hotel_check = $naming_check->first()->hotel()->where('status','=','2')->first();
            if ($hotel_check) {
                $hotel = Hotel::with(['options' => function ($query) {
                    $query->whereDisable('N');
                    $query->orderBy('id');
                },
                    'images' => function ($query) {
                        $query->whereDisable('N');
                        $query->orderBy('id');
                    },
                    'faqs' => function ($query) {
                        $query->orderBy('id');
                    },
                    'rooms' => function ($query) {
                        $query->whereDisable('N');
                        $query->orderBy('id');
                    },
                    'room_types' => function ($query) {
                        $query->whereVisible('1');
                        $query->orderBy('order');
                    },
                    'checkPoints' => function ($query) {
                        $query->whereDisable('N');
                        $query->orderBy('id');
                    }])->orderByRaw('hotels.order is null asc')->orderBy('order', 'ASC')->whereId($hotel_check->id)->whereStatus('2')->first();

                return response()->view('view', [
                    'hotel' => $hotel,
                    'curator' => $curator
                ]);
            }
        }

        abort(404);
    }
    public function view($hotel_id, $curator_page ='')
    {
        if (Str::of(request()->getHttpHost())->contains(['livinginhotel.kr', 'livinginhotel.co.kr'])) {
            return redirect('https://www.livinginhotel.com' . Str::of(url()->current())->after('livinginhotel.kr')->after('livinginhotel.co.kr'));
        }
        if (!Str::of(request()->getHttpHost())->contains(['www', 'dev'])) {
            return redirect('https://www.livinginhotel.com' . Str::of(url()->current())->after('livinginhotel.com'));
        }
        $curator = null;
        if ($curator_page !== '' && $curator_page !== null) {
            $curator = Curator::whereVisible('1')->whereUserPage($curator_page)->first();
        }
        if (Hotel::whereStatus('2')->findOrFail($hotel_id)) {
            $hotel = Hotel::with(['options' => function ($query) {
                $query->whereDisable('N');
                $query->orderBy('id');
            },
                'images' => function ($query) {
                    $query->whereDisable('N');
                    $query->orderBy('id');
                },
                'faqs' => function ($query) {
                    $query->orderBy('id');
                },
                'rooms' => function ($query) {
                    $query->whereDisable('N');
                    $query->orderBy('id');
                },
                'room_types' => function ($query) {
                    $query->whereVisible('1');
                    $query->orderBy('order');
                },
                'checkPoints' => function ($query) {
                    $query->whereDisable('N');
                    $query->orderBy('id');
                }])->orderByRaw('hotels.order is null asc')->orderBy('order', 'ASC')->whereId($hotel_id)->whereStatus('2')->first();

            return response()->view('view', [
                'hotel' => $hotel,
                'curator' => $curator
            ]);
        }

        abort(404);
    }

    public function dev($curator_page =''): Response
    {
        $curator = null;
        if ($curator_page) {
            $curator = Curator::whereVisible('1')->whereUserPage($curator_page)->first();
        }
        $hotels = Hotel::with(['options' => function ($query) {
            $query->whereDisable('N');
            $query->orderBy('id');
        },
            'images' => function ($query) {
                $query->whereDisable('N');
                $query->orderBy('id');
            },
            'faqs' => function ($query) {
                $query->orderBy('id');
            },
            'rooms' => function ($query) {
                $query->whereDisable('N');
                $query->orderBy('id');
            },
            'checkPoints' => function ($query) {
                $query->whereDisable('N');
                $query->orderBy('id');
            }])->orderByRaw('hotels.order is null asc')->orderBy('order', 'ASC')->where('status', '=', 1)->orwhere('status', '=', 2)->get();

        return response()->view('dev.main', [
            'hotels' => $hotels,
            'curator' => $curator,
        ]);
    }

    public function devView($hotel_id, $curator_page =''): Response
    {
        $curator = null;
        if ($curator_page) {
            $curator = Curator::whereVisible('1')->whereUserPage($curator_page)->first();
        }
        if (Hotel::findOrFail($hotel_id)) {
            $hotel = Hotel::with(['options' => function ($query) {
                $query->whereDisable('N');
                $query->orderBy('id');
            },
                'images' => function ($query) {
                    $query->whereDisable('N');
                    $query->orderBy('id');
                },
                'faqs' => function ($query) {
                    $query->orderBy('id');
                },
                'rooms' => function ($query) {
                    $query->whereDisable('N');
                    $query->orderBy('id');
                },
                'room_types' => function ($query) {
                    $query->whereVisible('1');
                    $query->orderBy('order');
                },
                'checkPoints' => function ($query) {
                    $query->whereDisable('N');
                    $query->orderBy('id');
                }])->whereId($hotel_id)->first();

            return response()->view('dev.view', [
                'hotel' => $hotel,
                'curator' => $curator
            ]);
        }
    }

}
