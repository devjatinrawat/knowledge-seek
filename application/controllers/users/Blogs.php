<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('users/Blogs_model', 'blog');
	}

    public function index()
	{
		$this->load->helper('text');
        $data['allArticles'] ='';
        $data['category'] = $this->blog->getCategory();
        $data['latestArticle'] = $this->blog->get_article();
        if($data['latestArticle'] != "null"){
            $id = $data['latestArticle']['id'];
            $data['allArticles'] = $this->blog->getAllArticles($id);
        }
        $data['sidemenu'] = $this->blog->getSideMenu();
        $data['act'] = "blog";
        $data['subAct'] = "main";
        $this->load->view('users/blogs/blogs', $data);
	}

	public function getCategoryArticle(){
		$this->load->helper('text');
		$id = $this->input->get("cat_id");
		$Adata['latestOne'] =  $this->blog->get_article($id);

		$article_id = $Adata['latestOne']['id'];
		$Adata['allCategoryArticle'] = $this->blog->getAllArticles($article_id, $id);
	
		$html = "";

        $html .= '<div class="card mb-5 HeadingCards">';
            if (!empty($Adata['latestOne']) && $Adata['latestOne']['status']==1) {
             $html .= '<div class="card-img"></div>'.
                    '<div class="card-img-overlay">'.
                     '<h5 class="card-title">'. $Adata['latestOne']['category_name'] .'</h5>'.
                    '</div>';
            } else {
             $html .= '<img src="' . base_url().'public/uploads/articles/No-Image.jpg'.'" class="card-img-top datnotfoundImg" alt="..." />' .
                ' <div class="card-body">' .
                ' <h5 class="card-title text-center" style="font-size: 50px; ">' .
                ' DATA NOT FOUND' .
                ' </h5>' .
                '</div>';
            }

           $html .= '</div>' .
              '<div class="row">';

            if (!empty($Adata['allCategoryArticle'])) {
          foreach($Adata['allCategoryArticle'] as $element){
            if($element['status'] == 1){
                $html .= '<div class="col-sm-12 col-md-6 col-lg-6 col-12 mb-5">' .
                    '<div class="card secondaryCard">' .
                    ' <a href="'. base_url().'blogpost/'. $element['id'] .'"><img src="' . base_url().'public/uploads/articles/' . $element['image'] . '" class="card-img-top"  alt="..."></a>' .
                    '<div class="card-body">' .
                    '<h5 class="card-title">' . $element['category_name'] . '</h5>' .
                    '<h3 class="card-title">' . word_limiter(strip_tags($element['title']), 4) . '</h3>' .
                    '<p class="card-text text-justify">' .
                    word_limiter(strip_tags($element['discription']), 20) .
                    '<a href="'. base_url().'blogpost/'. $element['id'] .'" class="text-primary"> read more</a>' .
                    '</p >' .
                    '<div class="d-flex justify-content-between">' .
                    ' <p class="card-text"><small class="text-muted">Author - <span>' .
                    $element['author'] .
                    '</span></small></p>' .
                    '<p class="card-text"><small class="text-muted">' .
                      date("y-M-d",strtotime($element['created_at'])).
                    '</small></p>' .
                    '</div>' .
                    '</div>' .
                    '</div>' .
                    '</div>';
          }
        }
       }else{
				$html .= "<h1>DATA NOT FOUND</h1>";
			  }
          
           $html .= '</div >';

		echo json_encode($html);
	}

	

}
