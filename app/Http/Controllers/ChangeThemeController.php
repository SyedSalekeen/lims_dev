<?php

namespace App\Http\Controllers;

use App\ChangeTheme;
use Illuminate\Http\Request;

class ChangeThemeController extends Controller
{
    public function vendor_change_theme(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'sidebar_color' => 'required',
            'navbar_color' => 'required',
            'sidebar_text' => 'required',
            'navbar_text' => 'required',
            'button_color' => 'required',
            'button_text' => 'required',
         
        ]);

        $checkThemeAlreadyExist = ChangeTheme::find(auth()->id());
        if ($checkThemeAlreadyExist) {
            $save_vendor_theme = ChangeTheme::where("vendor_id", auth()->id())->first();
            // return $save_vendor_theme;
            $save_vendor_theme->vendor_id = auth()->id();
            $save_vendor_theme->sidebar_color = $request->sidebar_color;
            $save_vendor_theme->navbar_color = $request->navbar_color;
            $save_vendor_theme->button_color = $request->button_color;
            $save_vendor_theme->sidebar_text = $request->sidebar_text;
            $save_vendor_theme->navbar_text = $request->navbar_text;
            $save_vendor_theme->button_text = $request->button_text;
            $save_vendor_theme->save();
            session()->put('vendor_theme_updated', true);
            return redirect()->route('vendor_theme_change.index');
        } else {
            $save_vendor_theme = new ChangeTheme();
            $save_vendor_theme->vendor_id = auth()->id();
            $save_vendor_theme->sidebar_color = $request->sidebar_color;
            $save_vendor_theme->navbar_color = $request->navbar_color;
            $save_vendor_theme->button_color = $request->button_color;
            $save_vendor_theme->sidebar_text = $request->sidebar_text;
            $save_vendor_theme->navbar_text = $request->navbar_text;
            $save_vendor_theme->button_text = $request->button_text;
            $save_vendor_theme->save();
            session()->put('vendor_theme_saved', true);
            return redirect()->route('vendor_theme_change.index');
        }
    }
    public function branch_theme_change(Request $request)
    {
        $this->validate($request, [
            'sidebar_color' => 'required',
            'navbar_color' => 'required',
            'sidebar_text' => 'required',
            'navbar_text' => 'required',
            'button_color' => 'required',
            'button_text' => 'required',
            'branch_id' => 'required',
        ]);
        $checkBranch_theme = ChangeTheme::where('branch_id', $request->branch_id)->first();
        if ($checkBranch_theme) {
            $save_branch_theme = ChangeTheme::where('branch_id', $request->branch_id)->first();
            $save_branch_theme->branch_id = $request->branch_id;
            $save_branch_theme->sidebar_color = $request->sidebar_color;
            $save_branch_theme->navbar_color = $request->navbar_color;
            $save_branch_theme->button_color = $request->button_color;
            $save_branch_theme->sidebar_text = $request->sidebar_text;
            $save_branch_theme->navbar_text = $request->navbar_text;
            $save_branch_theme->button_text = $request->button_text;
            $save_branch_theme->save();
            session()->put('branch_theme_saved', true);
            return redirect()->route('vendor_theme_change.index');
        } else {
            $save_branch_theme = new ChangeTheme();
            $save_branch_theme->branch_id = $request->branch_id;
            $save_branch_theme->sidebar_color = $request->sidebar_color;
            $save_branch_theme->navbar_color = $request->navbar_color;
            $save_branch_theme->button_color = $request->button_color;
            $save_branch_theme->sidebar_text = $request->sidebar_text;
            $save_branch_theme->navbar_text = $request->navbar_text;
            $save_branch_theme->button_text = $request->button_text;
            $save_branch_theme->save();
            session()->put('branch_theme_updated', true);
            return redirect()->route('vendor_theme_change.index');
        }
    }
}
