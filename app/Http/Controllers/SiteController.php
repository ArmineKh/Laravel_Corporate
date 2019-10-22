<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MenusRepository;
use Menu;

class SiteController extends Controller
{
    //
    protected $p_rep;
    protected $s_rep;
    protected $a_rep;
    protected $m_rep;

    protected $template;
    protected $vars = array();

    protected $contentRightBar = false;
    protected $contentLeftBar = false;


    protected $bar = false;

    public function __construct(MenusRepository $m_rep){
        $this->m_rep = $m_rep;

    }

    protected function renderOutput()
    {
        $menu = $this->getMenu();



        $navigation = view('pink.navigation')->with('menu', $menu)->render();
        $this->vars['navigation'] = $navigation;
		 return view($this->template)->with($this->vars);   
    }

    protected function getMenu(){
        $menu = $this->m_rep->get();
        // dd($menu);
        $mBuilder = Menu::make('MyNav', function($m) use ($menu){
            foreach ($menu as $item) {
                if($item->parent == 0){
                    $m->add($item->title, $item->path)->id($item->id);
                } else{
                    if($m->find($item->parent)){
                        $m->find($item->parent)->add($item->title, $item->path)->id($item->id);

                    }
                }
            }
        });
        // dd($mBuilder);

        return $mBuilder;
    }


}
