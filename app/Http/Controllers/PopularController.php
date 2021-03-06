<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
require('test.php');

class PopularController extends Controller
{
 
    public function getem()
    {
         if (!isset($_GET['page'])) $_GET['page'] = 1;
         $base_url = "https://gogoanime.sh/";
         $rec = get_recent(file_get_html($base_url));

         $base_url = "https://gogoanime.sh/popular.html?page=".$_GET['page'];
   		 $re = file_get_html($base_url);
   
   		 $main = $re->find('.main_body')[0];
         $lis = $re->find('.items li');
         $news = array();
         foreach ($lis as $li)
         {
            $new = array(
                'img'=> $li->find('.img img')[0]->src,
                'href' => $li->find('.img a')[0]->href,
                'name' => $li->find('.name')[0]->innertext
            );
            array_push($news, $new);
         }

         $pages = $re->find('.anime_name_pagination')[0]->outertext;
        return view('pages.popular', compact('rec','news','pages'));
        
    }



}
