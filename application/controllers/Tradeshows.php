<?php
/**
 * Created by PhpStorm.
 * User: Ali Shan
 * Date: 2/28/2019
 * Time: 4:29 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Tradeshows extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Tradeshow_Model');
        $this->load->model('Listingquery_Model');
        $this->load->model('Listingfilterquery_Model');
        $this->load->model('Listings_Model');
        $this->load->model('Blocks_Model');
        $this->load->library("pagination");
    }

    public function index()
    {
        $limit = 20;
        $trade_shows = $this->Tradeshow_Model->get_all($limit);
        $total_rows = count($trade_shows);
        $this->load->view('frontend/tradeshows/all-tradeshows', ['tradeshows' => $trade_shows, 'total_rows' => $total_rows]);
    }

    public function load_more_data()
    {
        $total_rows = $_POST['rows'] + 10;
        $limit = 10;
        $offset = $_POST['rows'];
        $tradeshows = $this->Tradeshow_Model->get_limited_data($limit, $offset);

        $html = '';
        if (isset($tradeshows) && !empty($tradeshows)):
            foreach ($tradeshows as $tradeshow) :
            	$trade_image = $tradeshow->featured_image;
            	$image = (empty($tradeshow->featured_image)) ? volgo_get_no_image_url() : IMG_BASE_URL . 'tradeshows/' . volgo_maybe_unserialize($trade_image) . '?x-oss-process=image/auto-orient,1/quality,q_50/format,jpg';        
                $html .= '<div class="col-sm-6 spacing">';
                $html .= '<div class="item-box">';
                $html .= '<div class="position-relative d-flex tradeshow-' . $tradeshow->id . '">';
                $html .= '<div class="text-uppercase purple event-date">'. date('d M Y', strtotime($tradeshow->date_time));
                $html .= '</div>';
                $html .= '<img class="img-fluid event-img" src="'. $image . '"  />';
                $html .= '</div>';
                $html .= '<div class="content">';
                $html .= '<h1 class="title">';
                $html .=  $tradeshow->title;
                $html .= '</h1>';
                $html .= '<p class="post-by">By <a href="">George S.Henry</a></p>';
                $html .= '<p class="description">';
                $html .= $tradeshow->content;
                $html .= '</p>';
                $html .= '<div class="date-venue">';
                foreach ($tradeshow->post_meta  as $meta_info) :
                    if ($meta_info->meta_key === 'starting_date') :
                        $html .= '<span class="date start-date">Start Date: </span><span>';
                        $html .= date('d M Y', strtotime($meta_info->meta_value));
                        $html .= '</span>';
                    endif;
                    if ($meta_info->meta_key === 'ending_date') :
                        $html .= '<span class="date end-date">End Date: </span><span>';
                        $html .= date('d M Y', strtotime($meta_info->meta_value));
                        $html .= '</span>';
                    endif;
                    if ($meta_info->meta_key === 'ts_venue') :
                        $html .= '<span class="venue">Venue: </span><span>';
                        $html .= $meta_info->meta_value;
                        $html .= '</span>';
                    endif;
                endforeach;
                $html .= '	</div>';
                $html .= '	<a class="btn btn-default mt-3 orange-bg" href="' . base_url('tradeshow/' . $tradeshow->slug).
                '" >View details</a>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
            endforeach;
        endif;
        echo json_encode(['rows' => $total_rows, 'trade_shows' => $html]);
        exit;
    }

    public function show_by_slug($slug = '')
    {
        $tradeshow = [
            'tradeshow_detail' => $this->Tradeshow_Model->get_by_slug($slug)
        ];

        $related_post_current_id = $tradeshow['tradeshow_detail']['0']['post_info']['post_id'];
        $next_previous = $tradeshow['tradeshow_detail']['0']['post_info']['post_id'];

        $tradeshow['related_tradeshows'] = $this->Tradeshow_Model->get_trade_related_posts($related_post_current_id);
        $tradeshow['next_previous_trade'] = $this->Tradeshow_Model->get_trade_next_previous_posts($next_previous);


        $this->load->view('frontend/tradeshows_detail_page/tradeshows_detail', $tradeshow);
    }

}
