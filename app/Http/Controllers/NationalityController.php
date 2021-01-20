<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\AzhrmsNationality;
use App\Menu;

class NationalityController extends Controller
{
    public function index()
    {
        $nationality = AzhrmsNationality::latest()->paginate(5);

        $menu = new Menu;
        $menuList = $menu->tree();
  
        return view('nationality.index',compact('nationality'))
            ->with('i','menulist', $menuList,(request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        
        return view('nationality.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            //'title' => 'required',
            'name' => 'required'
        ]);
  
        AzhrmsNationality::create($request->all());
   
        return redirect()->route('nationality.index')
                        ->with('success','Nationality created successfully.');
    }

    public function edit(AzhrmsNationality $nationality)
    {
        return view('nationality.edit',compact('nationality'));
    }

    public function update(Request $request, AzhrmsNationality $nationality)
    {
        $request->validate([
            // 'title' => 'required',
            'name' => 'required'
        ]);
  
        $nationality->update($request->all());
  
        return redirect()->route('nationality.index')
                        ->with('success','Nationality updated successfully');
    }

    public function destroy(AzhrmsNationality $nationality)
    {
        $nationality->delete();
  
        return redirect()->route('nationality.index')
                        ->with('success','Nationality deleted successfully');
    }

    public function show(AzhrmsNationality $nationality)
    {
        return view('nationality.show',compact('nationality'));
    }
}
