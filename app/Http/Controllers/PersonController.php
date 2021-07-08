<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        $items = Person::all();
        return view('index', ['items' => $items]);
    }

    public function find(Request $request)
    {
        return view('find', ['input' => '']);
    }

    public function search(Request $request)
    {
        $item = Person::where('name', $request->input)->first();
        $param = [
            'input' => $request->input,
            'item' => $item
        ];
        return view('find', $param);
    }

    public function add(Request $request)
    {
        return view('add');
    }

    public function create(Request $request)
    {
        $this->validate($request, Person::$rules);
        $form = $request->all();
        Person::create($form);
        return redirect('/');
    }

    public function edit(Request $request)
    {
        $person = Person::find($request->id);
        return view('edit', ['form' => $person]);
    }

    public function update(Request $request)
    {
        $this->validate($request, Person::$rules);
        $form = $request->all();
        // $form = $request->except('_token');
        // $form = $request->only('name', 'age');
        Person::where('id', $request->id)->update($form);
        return redirect('/');
    }

    // public function bind(Person $person)
    // {
    //     $data = [
    //         'item' => $person,
    //     ];
    //     return view('person.binds', $data);
    // }
}
