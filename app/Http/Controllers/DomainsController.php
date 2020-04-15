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
        $document = new Document($domain->name, true);
        $domain->h1 = $document->has('h1') ? $document->first('h1')->text() : "Нет заголовка";
        $domain->keywords = $document->has('meta[name=keywords]') ?
                            $document->find('meta[name=keywords]')[0]->attr('content') : "Нет ключей";
        $domain->description = $document->has('meta[name=description]') ?
                            $document->find('meta[name=description]')[0]->attr('content') : "Нет описания";
        $domain->save();
    }

    public function store(Request $request)
    {
        $url = $request->input('url');
        $domain = Domains::create(['name' => $url]);
        
        $this->handle($domain);
        return redirect()->route('domains.show', ['id' => $domain->id]);
    }

    public function index()
    {
        $allUrls = Domains::paginate(10);
        return view('domains/index', compact('allUrls'));
    }

    public function show($id)
    {
        $url = Domains::findOrFail($id);
        return view('domains/show', ['url' => $url]);
    }
}
