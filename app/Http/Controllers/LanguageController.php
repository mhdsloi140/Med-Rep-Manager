<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function swap(Request $request)
    {



        $availableLocales = config('app.available_locales', []);

        // تحقق من أن اللغة المطلوبة موجودة ضمن اللغات المتاحة
        if (!in_array($request->locale, $availableLocales)) {
            session()->flash('error', 'Invalid locale');
            return redirect()->back();
        }

        // حفظ اللغة الجديدة في الجلسة
        session()->put('locale', $request->locale);
        session()->flash('message', 'Language changed successfully');

        return redirect()->back();
    }
}
