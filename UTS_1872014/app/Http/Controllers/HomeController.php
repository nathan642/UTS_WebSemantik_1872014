<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      return view("rss");
    }

    
    public function DataRSS(Request $request)
    {
        $news = [];
          $urlrss = file_get_contents('https://www.antaranews.com/rss/terkini.xml');
          $object = simplexml_load_string($urlrss);
          $json = json_encode($object);
          $array = json_decode($json);

          foreach ($array->channel->item as $value) {
            if ($request->has('search') && $request->search != '') {
              if (strpos($value->title, $request->search)!==false) {
                array_push($news, [
                  'sourceweb' => 'Antara News',
                  'title' => $value->title,
                  'link' => $value->link
                ]);
              }
            }
            else
            {
              array_push($news, [
                'sourceweb' => 'Antara News',
                'title' => $value->title,
                'link' => $value->link
              ]);
            }
          }
          $urlrss = file_get_contents('https://www.sindonews.com/feed');
          $object = simplexml_load_string($urlrss);
          $json = json_encode($object);
          $array = json_decode($json);

          foreach ($array->channel->item as $value) {
            if ($request->has('search') && $request->search != '') {
              if (strpos($value->title, $request->search)!==false) {
                array_push($news, [
                  'sourceweb' => 'Sindo News',
                  'title' => $value->title,
                  'link' => $value->link
                ]);
              }
            }
            else
            {
              array_push($news, [
                'sourceweb' => 'Sindo News',
                'title' => $value->title,
                'link' => $value->link
              ]);
            }
          }
          $urlrss = file_get_contents('http://tribunnews.com/rss');
          $object = simplexml_load_string($urlrss);
          $json = json_encode($object);
          $array = json_decode($json);

          foreach ($array->channel->item as $value) {
            if ($request->has('search') && $request->search != '') {
              if (strpos($value->title, $request->search)!==false) {
                array_push($news, [
                  'sourceweb' => 'Tribun News',
                  'title' => $value->title,
                  'link' => $value->link
                ]);
              }
            }
            else
            {
              array_push($news, [
                'sourceweb' => 'Tribun News',
                'title' => $value->title,
                'link' => $value->link
              ]);
            }
          }
        return response()->json(compact('news'));
    }
}
