<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('category')->paginate(7);

        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    public function search(Request $request)
    {
        $query = Contact::with('category');

        if (!empty($request->keyword)) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }

        if (!empty($request->gender)) {
            $query->where('gender', $request->gender);
        }

        if (!empty($request->category_id)) {
            $query->where('category_id', $request->category_id);
        }

        if (!empty($request->date)) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->paginate(7)->appends($request->all());

        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    public function reset()
    {
        return redirect('/admin');
    }
    
    public function export(Request $request)
    {
        $query = Contact::with('category');

        if (!empty($request->keyword)) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }

        if (!empty($request->gender)) {
            $query->where('gender', $request->gender);
        }

        if (!empty($request->category_id)) {
            $query->where('category_id', $request->category_id);
        }

        if (!empty($request->date)) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->get();

        $response = response()->streamDownload(function () use ($contacts) {
            $stream = fopen('php://output', 'w');

            $row = [
                'お名前',
                '性別',
                'メールアドレス',
                'お問い合わせの種類',
                'お問い合わせ内容',
            ];

            $row = array_map(fn($value) => mb_convert_encoding((string) $value, 'SJIS-win', 'UTF-8'), $row);

            foreach ($contacts as $contact) {
                $gender = match ($contact->gender) {
                    1=> '男性',
                    2=> '女性',
                    default => 'その他',
                };

                $row = [
                    $contact->last_name . ' ' . $contact->first_name,
                    $gender,
                    $contact->email,
                    $contact->category->content ?? '',
                    $contact->detail,
                ];

                $row = array_map(fn ($value) => mb_convert_encoding((string) $value, 'SJIS-win', 'UTF-8'), $row);
                fputcsv($stream, $row);
            }

            fclose($stream);
        }, 'contacts.csv');

        $response->headers->set('Content-Type', 'text/csv; charset=SJIS-win');

        return $response;
    }

    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();

        return redirect('/admin');
    }
}
