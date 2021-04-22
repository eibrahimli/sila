<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPageController extends Controller
{
    public function edit(Page $page) {
        
        return view('backend.page.edit', compact('page'));
    }

    public function update(Page $page, Request $request) {

        $data = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required',
            'lang' => 'required|min:2'
        ]);

        $if_is_exist = Page::where('title', $request->title)->where('id', '!=', $page->id)->get();

        if(count($if_is_exist) > 0): return back()->with('status', 'error'); endif;

        $page = $page->update($data);

        return back()->with('status', 'ok');
    }
}
