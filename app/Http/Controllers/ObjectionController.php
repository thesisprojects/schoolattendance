<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Auth;
use App\Objection;

class ObjectionController extends Controller
{
    public function index()
    {
        $company = Auth::user()->company->with([
            'objections' => function ($query) {
                $query->with('campaign');
            },
            'campaigns' => function ($query) {
                $query->select(['id', 'company_id', 'name']);
            }
        ])->first();
        return view('pages.objections.index')->with('company', $company);
    }

    public function postCreate(Request $request)
    {
        try {
            $this->validate($request, [
                'campaign_id' => 'required',
                'name' => 'required|min:2|max:100',
                'short_description' => 'required',
                'body' => 'required'
            ]);
            $data = $request->all();
            $objection = new Objection($data);;
            $objection->id = Uuid::uuid1();
            $objection->company_id = Auth::user()->company->id;
            $objection->save();
            return back()->with('status', 'Objection created.');
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
