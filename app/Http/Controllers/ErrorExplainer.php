<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ErrorExplainer extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    
    public function errorFinder(Request $request)
                {
                            $request->validate([
                    'language' => 'required',
                    'error_message' => 'required|max:2000'
                ]);

                $language = $request->language;
                $error    = $request->error_message;

                $prompt = "
                Language: {$language}
                Error: {$error}

                Explain the error simply and show how to fix it.
                ";

                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                    'Content-Type'  => 'application/json',
                ])->post('https://api.openai.com/v1/chat/completions', [
                    'model' => 'gpt-4o-mini',
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are an expert programmer who explains errors clearly.'],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'max_tokens' => 300,
                ]);


                $answer = $response['choices'][0]['message']['content'];

                return view('users.result', compact('answer'));
            }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
