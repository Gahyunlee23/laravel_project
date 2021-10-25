<?php

namespace App\Http\Controllers\Curators;

use App\Curator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class CuratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): \Illuminate\Http\Response
    {
        return response()
            ->view('curator.index',
                ['curators' => Curator::orderByDesc('visible')->get()],
                200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()
            ->view('curator.create',
                [],
                200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if (!Str::contains($request->user_page, ['admin', 'hotel', 'travelmaker', 'travelmakers', 'developer', 'dev'])) {
            Curator::create(
                $request->all()
            );
            Session::flash('message', $request->name . '[ ' . $request->user_id . ' ] 큐레이터 등록 완료!');
        } else {
            Session::flash('message', '페이지 명칭[ ' . $request->user_page . ' ]은(는) 등록 불가능한 명칭입니다');
        }

        return redirect()->route('curator.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Curator $curator
     * @return \Illuminate\Http\Response
     */
    public function show(Curator $curator)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Curator $curator
     * @return \Illuminate\Http\Response
     */
    public function edit(Curator $curator): \Illuminate\Http\Response
    {
        return response()
            ->view('curator.edit',
                ['curator' => $curator],
                200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Curator $curator
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Curator $curator): \Illuminate\Http\RedirectResponse
    {

        if ($request->name !== null && $curator->name !== $request->name) {
            $curator->name = $request->name;
        }
        if ($request->email !== null && $curator->email !== $request->email) {
            $curator->email = $request->email;
        }
        if ($request->tel !== null && $curator->tel !== $request->tel) {
            $curator->tel = $request->tel;
        }
        if ($request->user_id !== null && $curator->user_id !== $request->user_id) {
            $curator->user_id = $request->user_id;
        }
        if ($request->user_page !== null && $curator->user_page !== $request->user_page) {
            $curator->user_page = $request->user_page;
        }
        if ($request->user_pass !== null && $curator->user_pass !== $request->user_pass) {
            $curator->user_pass = $request->user_pass;
        }
        if ($request->explanation !== null && $curator->explanation !== $request->explanation) {
            $curator->explanation = $request->explanation;
        }
        $curator->save();
        // redirect
        Session::flash('message', ' 큐레이터 ' . $curator->name . '님 수정 완료!');
        return redirect()->route('curator.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Curator $curator
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Curator $curator): \Illuminate\Http\RedirectResponse
    {
        $curator->visible = '0';
        $curator->save();

        Session::flash('message', '큐레이터 비활성화 ' . $curator->id . ' 완료!');
        return redirect()->route('curator.index');
    }

    /**
     * re build
     *
     * @param \App\Curator $curator
     * @return \Illuminate\Http\RedirectResponse
     */
    public function build(Curator $curator): \Illuminate\Http\RedirectResponse
    {
        $curator->visible = '1';
        $curator->save();
        Session::flash('message', '큐레이터 활성화 ' . $curator->id . ' 완료!');
        return redirect()->route('curator.index');
    }
}
