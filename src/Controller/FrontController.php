<?php


class FrontController extends Controller
{
    public function notFound()
    {
        return $this->render("Front/notFound.html.twig");
    }

    public function indexAction()
    {
		return $this->render('Front/index.html.twig');
    }

	
}
