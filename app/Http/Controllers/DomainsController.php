<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains;
use GuzzleHttp\Client;
use DiDom\Document;
use Session;

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
        $domain->h1 = $document->has('h1') ? $document->first('h1')->text() : "-";
        $domain->keywords = $document->has('meta[name=keywords]') ?
                            $document->find('meta[name=keywords]')[0]->attr('content') : "-";
        $domain->description = $document->has('meta[name=description]') ?
                            $document->find('meta[name=description]')[0]->attr('content') : "-";
        $domain->save();
    }

    public function store(Request $request)
    {
        $messages = array(
            'url.required' =>
            trans('validation.required'),
            'url.min' =>
            trans('validation.min.string'),
            'url.regex' =>
            trans('validation.regex')
        );
        $this->validate($request, [
            'url' => 'required|min:5|regex:/^http(s)?:\/\/([a-z0-9]{2,63}\.)?[a-z0-9]{2,63}\.[a-z]{2,6}\/?$/'
        ], $messages);

        $url = $request->input('url');
        $domain = Domains::create(['name' => $url]);
        
        $this->handle($domain);
        return redirect()->route('domains.show', ['id' => $domain->id]);
    }

    public function index()
    {
        $allUrls = Domains::orderBy('id', 'DESC')->paginate(10);
        return view('domains/index', compact('allUrls'));
    }

    public function show($id)
    {
        $url = Domains::findOrFail($id);
        return view('domains/show', ['url' => $url]);
    }
}
