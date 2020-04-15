<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains;
use GuzzleHttp\Client;
use DiDom\Document;

class DomainsController extends Controller
{
    private function handle($domain)
    {
        $client = new Client();
        $response = $client->get($domain->name);
        $domain->responseCode = $response->getStatusCode();
        $domain->contentLength = $response->getHeader('Content-Length') ?
                                 implode('', $response->getHeader('Content-Length')) :
                                 strlen($response->getBody());
        $domain->body = $response->getBody()->getContents();
        $domain->h1 = $response->getBody()->getContents();
        $domain->save();
    }
    // $table->text('body')->nullable();
    // $table->text('h1')->nullable();
    // $table->text('keywords')->nullable();
    // $table->text('description')->nullable();

    public function store(Request $request)
    {
        $url = $request->input('url');
        $domain = Domains::create(['name' => $url]);
        
        $this->handle($domain);
        return redirect()->route('domains.show', ['id' => $domain->id]);
    }

    public function index()
    {
        $allUrls = Domains::paginate();
        return view('domains/index', compact('allUrls'));
    }

    public function show($id)
    {
        $url = Domains::findOrFail($id);
        return view('domains/show', ['url' => $url]);
    }
}
