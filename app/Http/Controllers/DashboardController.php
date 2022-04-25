<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
        return view('work');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();  

        $request->image->move(public_path('images'), $imageName);

        $work = new Work();
        $work->title = $request->title;
        $work->description = $request->description;
        $work->image = $imageName;
        $work->user_id = auth()->user()->id;
        $work->save();

        return back()
            ->with('success','You have successfully upload image.');
    }

    public function show()
    {
        if(Auth::user()->is_admin == 1){
            $works = Work::all();
        }else{
            $works = Work::where('user_id', auth()->user()->id)->get();
        }
        
        return view('workTable', compact('works'));
    }

    public function edit($id)
    {
        $work = Work::find($id);
        return response()->json($work);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();  

        $request->image->move(public_path('images'), $imageName);

        $work = Work::find($id);
        $work->title = $request->title;
        $work->description = $request->description;
        $work->image = $imageName;
        $work->user_id = auth()->user()->id;
        $work->save();

        return response()->json(['success'=>'You have successfully edit detailes.']);
    }

    public function destroy($id)
    {
        $work = Work::find($id);
        $work->delete();
        return response()->json(['success'=>'You have successfully delete detailes.']);
    }

    public function create(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();  

        $request->image->move(public_path('images'), $imageName);

        $work = new Work();
        $work->title = $request->title;
        $work->description = $request->description;
        $work->image = $imageName;
        $work->user_id = auth()->user()->id;
        $work->save();

        return response()->json(['success'=>'You have successfully create detailes.']);

    }

}
