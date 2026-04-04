<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('contact.index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->all();

        $genderLabels = [
            'male' => '男性',
            'female' => '女性',
            'other' => 'その他',
        ];

        $genderLabel = $genderLabels[$contact['gender']] ?? '';

        $category = Category::find($contact['category_id']);
        $categoryContent = $category ? $category->content : '';

        return view('contact.confirm', compact('contact', 'genderLabel', 'categoryContent'));
    }

    public function back(Request $request)
    {
        return redirect('/')->withInput();
    }

    public function thanks(Request $request)
    {
        $genderMap = [
            'male' => 1,
            'female' => 2,
            'other' => 3,
        ];

        Contact::create([
            'category_id' => $request->category_id,
            'gender' => $genderMap[$request->gender] ?? null,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'tel' => $request->tel1 . $request->tel2 . $request->tel3,
            'address' => $request->address,
            'building' => $request->building,
            'detail' => $request->detail,
        ]);
        
        return view('contact.thanks');
    }
}
