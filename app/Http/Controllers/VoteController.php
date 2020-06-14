<?php

namespace App\Http\Controllers;

use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO show candidates with thier party name and total votes
        $votes = Vote::with('voter', 'candidate')->paginate(100);
        return response()->json($votes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:users,id'
        ]);

        $hasVoted = Vote::where('voter_id', $request->user()->id)->first();

        if($hasVoted) {
            return response()->json(['errors'=> 'You already voted'], 400);
        }

        $vote =  new Vote(['voter_id'=> $request->user()->id, 'candidate_id' => $request->candidate_id]);

        $vote->save();

        return response()->json([
            'message' =>'Thanks for voting',
            'data' => $vote
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function show(Vote $vote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vote $vote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vote $vote)
    {
        //
    }
}
