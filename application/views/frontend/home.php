<?php include_once realpath(__DIR__) . '/includes/header.php'; ?>

<style>
    .spinner-loader-wrapper {
        position: relative;
        min-height: 10px;
        text-align: center;
        display: none;
    }

    .dynamic-form-wrapper .spinner-loader {
        color: white;
        position: absolute;
        margin: 0 auto;
        text-align: center;
    }
</style>

<section class="main-section volgo_home">
    <div class="container-fluid containerBanner mainWrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="bannerHolder">
                    <img src="<?php echo base_url('uploads/general/banner.jpg'); ?>" alt="Classified Banner"
                         class="lazyload img-fluid">
                    <?php if (isset($main_categories)): ?>
                        <div class="bannerInner">
                            <div class="tabsHolder">
                                <label class="searchIn">Search in:</label>
                                <nav>
                                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">

                                        <?php foreach ($main_categories as $main_category): ?>

                                            <?php

                                            // Skipping Buying Lead and Seller Lead
                                            if ($main_category['parent']->slug === 'buying-lead' || $main_category['parent']->slug === 'seller-lead'){
                                                continue;
                                            }
                                            ?>

                                            <a class="nav-item nav-link" data-toggle="tab"
                                               href="#nav-<?php echo volgo_make_slug(strtolower($main_category['parent']->name)); ?>"
                                               aria-controls="nav-auto">
                                                <i class="<?php echo $main_category['parent']->image_icon; ?>"
                                                   aria-hidden="true"></i><?php echo ucwords($main_category['parent']->name); ?>
                                            </a>

                                        <?php endforeach; ?>

                                    </div>
                                </nav>
                                <form action="<?php echo base_url('listing/search/'); ?>" method="get">
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="searchHolder" id="searchHolder_single">
                                            <div class="form-group searchField">
                                                <input type="text" name="search_query" class="form-control"
                                                       placeholder="What you are looking for ?">
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-search">Submit</button>
                                        </div>
                                </form>
                                <?php foreach ($main_categories as $main_category): ?>

                                    <?php

                                    // Skipping Buying Lead and Seller Lead
                                    if ($main_category['parent']->slug === 'buying-lead' || $main_category['parent']->slug === 'seller-lead'){
                                        continue;
                                    }
                                    ?>

                                    <div class="tab-pane fade mx-2"
                                         id="nav-<?php echo volgo_make_slug(strtolower($main_category['parent']->name)); ?>">
                                        <a href="javascript:void(0)" class="closeTab">
                                            <i class="fa fa-close" aria-hidden="true"></i>
                                        </a>
                                        <form action="<?php echo base_url('listingsearch/sidebar'); ?>" method="get">
                                            <div class="form-group">
                                                <div class="row m-0">
                                                    <div class="col-sm-6 place-cell">
                                                        <select name="select_state" class="select_state form-control">
                                                            <option value="">------Select State-------</option>
                                                            <?php foreach ((array)volgo_get_country_states_by_session_country_id() as $state): ?>
                                                                <option
                                                                    value="<?php echo $state->id; ?>"><?php echo $state->name; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6 place-cell">
                                                        <select name="parent_cat_select"
                                                                class="parent_cat_select form-control">
                                                            <option value="">------Select Category-------</option>

                                                            <?php foreach ($main_categories as $mp) : ?>

                                                                <option
                                                                    data-target_nav="#nav-<?php echo volgo_make_slug(strtolower($mp['parent']->name)); ?>" <?php echo ($main_category['parent']->id === $mp['parent']->id) ? 'selected' : ''; ?>
                                                                    value="<?php echo $mp['parent']->id; ?>"><?php echo ucwords($mp['parent']->name); ?></option>

                                                            <?php endforeach; ?>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row m-0">
                                                    <div class="col-sm-6 place-cell">
                                                        <select
                                                            data-parent_id="<?php echo $main_category['parent']->id; ?>"
                                                            name="child_cats" class="child_cats form-control">
                                                            <option value="">------Select Category-------</option>

                                                            <?php foreach ($main_category['childs'] as $child) : ?>

                                                                <option
                                                                    value="<?php echo $child->id; ?>"><?php echo ucwords($child->name); ?></option>

                                                            <?php endforeach; ?>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                class="form-group dynamic-form-wrapper dynamic-header-form-wrapper-<?php echo $main_category['parent']->id; ?>">
                                                <!-- Form will populate here dynamically -->
                                                <div id="dynamic-header-form"></div>
                                                <div class="spinner-loader-wrapper">
                                                    <div class="spinner-loader fa fa-spinner fa-spin fa-2x fa-fw"></div>
                                                </div>
                                            </div>

                                            <div class="searchHolder" style="position:relative;">
                                                <div class="form-group searchField">
                                                    <input type="text" class="form-control" name="search_query"
                                                           placeholder="What you are looking for ?">
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-search">Submit</button>
                                            </div>

                                        </form>
                                    </div>

                                <?php endforeach; ?>

                            </div>

                        </div>
                    <?php endif; ?>
                    <!--<div class="searchHolder">
                      <div class="form-group searchField">
                        <input type="text" class="form-control" placeholder="What you are looking for ?">
                      </div>
                      <button type="submit" class="btn btn-primary btn-search">Submit</button>
                    </div>-->
                </div>
            </div>
            <div class="marqueeHolder">
                <span class="latest-offer">Latest Buy Offers</span>
                <marquee behavior="scroll" direction="left" scrollamount="5" onmouseover="this.stop();"
                         onmouseout="this.start();">
                    <ul class="marqueeNav list-unstyled">
                        <?php foreach ($new_listings as $new_listing):
                            $new_listing = (object) $new_listing;
                            ?>
                            <li class="listing-item listing-item-<?php echo $new_listing->id; ?>">
                                <a href="<?php echo base_url($new_listing->slug); ?>"><?php echo $new_listing->title; ?>
                                    <em><?php echo date('M d, Y', strtotime($new_listing->created_at)); ?></em></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </marquee>
            </div>
        </div>
    </div>
    </div>
</section>
<!--Js Masonry-->
<div class="container-fluid masonryHolder desktopHideOnMobile">
    <div class="container-fluid mainWrapper">
        <div class="row">
            <div class="col-md-8 positionStatic desktopHideOnMobile">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" data-toggle="tab" href="#nav-recomend"
                           aria-controls="nav-recomend">Recommended</a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-featured"
                           aria-controls="nav-featured">Featured Products</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-recomend">
                        <div class="masonry">
                            <?php
                            $listings = (array)$listings;
                            if (!empty($listings) && isset($listings['recommended'])): ?>
                                <?php foreach ($listings['recommended'] as $recommended_listing) : ?>

                                    <?php
                                    $recommended_listing_array = (array)$recommended_listing;

                                    $listing_price = 0;
                                    $currency_code = volgo_get_currency_unit_by_country_id();
                                    $main_category_name = $recommended_listing_array['category_name'];
                                    $metas = json_decode($recommended_listing_array['meta_values'],true);

                                    foreach ($metas as $meta_key => $meta): ?>

                                        <!-- Listing Image -->
                                        <?php if ($meta_key === 'images_from' && (!empty($meta))) {

                                            if(is_array($meta))
                                                $images = $meta;
                                            else
                                                $images = unserialize($meta);

                                            if (!empty($images) && isset($images[0])) {
                                                $listing_image = IMG_BASE_URL . 'listing_images/' . $images[0] . '?x-oss-process=image/auto-orient,1/quality,q_20/watermark,image_d2F0ZXJtYXJrLWxvZ28ucG5nP3gtb3NzLXByb2Nlc3M9aW1hZ2UvcmVzaXplLFBfMzU,g_se,x_0,y_0/format,jpg';

                                                /*
                                                 * @todo: Taking too much time on load.
                                                 * if(! @getimagesize($listing_image)){
                                                    $listing_image = volgo_get_no_image_url();
                                                }*/
                                            } else{

                                                if (trim($main_category_name) === "Jobs" || trim($main_category_name) === "Jobs Wanted") {
                                                    $listing_image = volgo_get_job_wanted_image_url();
                                                } else {

                                                    $listing_image = volgo_get_no_image_url();
                                                }

                                            }
                                        }
                                        ?>

                                        <!-- Listing Price -->
                                        <?php if ($meta_key === 'price' && (!empty($meta))) $listing_price = $meta; ?>

                                        <!-- Price Unit -->
                                        <?php if ($meta_key === 'currency_code' && (!empty($meta))) $currency_code = $meta; ?>


                                    <?php endforeach;

                                    ?>

                                    <div
                                        class="item item-<?php echo $recommended_listing_array['id']; ?>">
                                        <a href="<?php echo base_url() . $recommended_listing_array['slug']; ?>"
                                           class="grid-item-link"><img
                                                src="<?php echo $listing_image; ?>" alt="Image"
                                                class="img-fluid"></a>
                                        <div class="detail-thumb">
                                            <a href="<?php echo base_url() . $recommended_listing_array['slug']; ?>"
                                               class="grid-item-link"><span
                                                    class="mas-title"><?php echo $recommended_listing_array['title']; ?></span></a>
                                            <a href="<?php echo base_url() . strtolower(volgo_make_slug($recommended_listing_array['category_name'])); ?>">
                                                <p class="mas-detail">
                                                    Category: <?php echo $recommended_listing_array['category_name']; ?></p>
                                            </a>
                                            <span class="detail-thumb-price">
                                                    <?php
                                                    if(trim($main_category_name) !== "Services" && trim($main_category_name) !== "Jobs" && trim($main_category_name) !== "Jobs Wanted") {
                                                        if (isset($listing_price) && !empty($listing_price)) { ?>
                                                            <span class="currency-code">
                                                        <?php echo volgo_get_currency_unit_by_country_id(); ?>
                                                    </span>
                                                            <span class="detail-price">
                                                        <?php echo number_format(intval($listing_price)); ?>
                                                    </span>
                                                        <?php } else {
                                                            echo 'N/A';
                                                        }
                                                    }?>
                                                </span>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-featured">
                        <div class="masonry">
                            <?php if (!empty($listings) && isset($listings['featured'])): ?>
                                <?php foreach ($listings['featured'] as $f_listing) : ?>

                                    <?php
                                    $f_listing_array = (array)$f_listing;
                                    $listing_image = base_url() . 'uploads/general/no-image.jpg';
                                    $listing_price = 0;
                                    $main_category_name = $f_listing_array['category_name'];
                                    if(trim($main_category_name) === "Jobs" || trim($main_category_name) === "Jobs Wanted"){
                                        $listing_image = volgo_get_job_wanted_image_url();
                                    }else{
                                        $listing_image = volgo_get_no_image_url();
                                    }
                                    $metas = json_decode($f_listing_array['meta_values'],true);

                                    foreach ($metas as $meta_key => $meta): ?>

                                        <!-- Listing Image -->
                                        <?php

                                        if ($meta_key === 'images_from' && (!empty($meta))) {
                                            $listing_image = "";
                                            $lm = "";
                                            if(is_array($meta)){
                                                $lm = $meta;
                                            }else{
                                                $lm = unserialize($meta);
                                            }


                                            if (!empty($lm) && isset($lm[0])) {
                                                $listing_image = IMG_BASE_URL . 'listing_images/' . ($lm[0]) . '?x-oss-process=image/auto-orient,1/quality,q_20/watermark,image_d2F0ZXJtYXJrLWxvZ28ucG5nP3gtb3NzLXByb2Nlc3M9aW1hZ2UvcmVzaXplLFBfMzU,g_se,x_0,y_0/format,jpg';
                                            } else {

                                                if (trim($main_category_name) === "Jobs" || trim($main_category_name) === "Jobs Wanted") {
                                                    $listing_image = volgo_get_job_wanted_image_url();
                                                } else {

                                                    $listing_image = volgo_get_no_image_url();
                                                }

                                            }
                                        }

                                        ?>

                                        <!-- Listing Price -->
                                        <?php if (($meta_key === 'price') && (!empty($meta))) $listing_price = $meta; ?>

                                        <!-- Price Unit -->
                                        <?php if ($meta_key === 'currency_code' && (!empty($meta))) $currency_code = $meta; ?>


                                    <?php endforeach; ?>
                                    <div class="item item-<?php echo $f_listing_array['id']; ?>">
                                        <a href="<?php echo base_url() . $f_listing_array['slug']; ?>"
                                           class="grid-item-link">
                                            <img src="<?php echo $listing_image; ?>" alt="Image" class="img-fluid">
                                        </a>
                                        <div class="detail-thumb">
                                            <a href="<?php echo base_url() . $f_listing_array['slug']; ?>">
                                                <span class="mas-title"><?php echo $f_listing_array['title']; ?></span></a>
                                            <a href="<?php echo base_url() . strtolower(volgo_make_slug($f_listing_array['category_name'])); ?>">
                                                <p class="mas-detail">
                                                    Category: <?php echo $f_listing_array['category_name']; ?></p>
                                            </a>
                                            <span class="detail-thumb-price">
                                                    <?php
                                                    if(trim($main_category_name) !== "Services" && trim($main_category_name) !== "Jobs" && trim($main_category_name) !== "Jobs Wanted") {
                                                        if (isset($listing_price) && !empty($listing_price)) { ?>
                                                            <span class="currency-code">
                                                        <?php echo volgo_get_currency_unit_by_country_id(); ?>
                                                    </span>
                                                            <span class="detail-price">
                                                        <?php echo number_format(intval($listing_price)); ?>
                                                    </span>
                                                        <?php } else {
                                                            echo 'N/A';
                                                        }
                                                    }?>
                                                </span>

                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 desktopHideOnMobile">
                <div class="sidebarAds">
                    <div class="masonry masonry-sidebar">
                        <?php
                        $buying_and_seller_leads = (array) $buying_and_seller_leads;
                        if (isset($buying_and_seller_leads, $buying_and_seller_leads['buying_lead'])): ?>
                            <?php foreach ($buying_and_seller_leads['buying_lead'] as $lead) :
                                $lead_array = (array)$lead;
                                $listing_price = 0;
                                $listing_image = base_url() . 'uploads/general/no-image.jpg';
                                $metas = json_decode($lead_array['meta_values'],true);
                                foreach ($metas as $meta_key=>$meta):
                                    if ($meta_key === 'images_from' && (!empty($meta))) {
                                        if(is_array($meta))
                                            $lm = $meta;
                                        else
                                            $lm = unserialize($meta);
                                        if (!empty($lm))
                                            $listing_image = IMG_BASE_URL . 'listing_images/' . ($lm[0]) . '?x-oss-process=image/auto-orient,1/quality,q_20/watermark,image_d2F0ZXJtYXJrLWxvZ28ucG5nP3gtb3NzLXByb2Nlc3M9aW1hZ2UvcmVzaXplLFBfMzU,g_se,x_0,y_0/format,jpg';
                                    }

                                    if ($meta_key === 'listing_price' && (!empty($meta))) $listing_price = $meta;
                                endforeach;
                                ?>


                                <div class="item item-<?php echo $lead_array['id']; ?> ">
                                    <a href="<?php echo base_url($lead_array['slug']); ?>"
                                       class="grid-item-link"><img
                                            src="<?php echo $listing_image; ?>" alt="Image"
                                            class="img-fluid"></a>
                                    <div class="detail-thumb">
                                        <a href="<?php echo base_url() . $lead_array['slug']; ?>">
                                            <span class="mas-title"><?php echo $lead_array['title']; ?></span></a>
                                        <a href="<?php echo base_url() . strtolower(volgo_make_slug($lead_array['category_name'])); ?>">
                                            <p class="mas-detail">
                                                Category: <?php echo $lead_array['category_name']; ?></p>
                                        </a>
                                        <!--                                        <span class="detail-thumb-price">-->
                                        <?php //echo (!empty($listing_price)) ? volgo_get_currency_unit_by_country_id() . ' ' . number_format($listing_price) : 'N/A';
                                        ?><!--</span>-->
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if (isset($buying_and_seller_leads, $buying_and_seller_leads['seller_lead'])): ?>
                            <?php foreach ($buying_and_seller_leads['seller_lead'] as $lead) :

                                $lead_array = (array)$lead;
                                $listing_price = 0;
                                $listing_image = base_url() . 'uploads/general/no-image.jpg';
                                $metas = json_decode($lead_array['meta_values'],true);
                                foreach ($metas as $meta_key=>$meta):
                                    if ($meta_key === 'images_from' && (!empty($meta))) {
                                        if(is_array($meta))
                                            $lm = $meta;
                                        else
                                            $lm = unserialize($meta);
                                        if (!empty($lm))
                                            $listing_image = IMG_BASE_URL . 'listing_images/' . ($lm[0]) . '?x-oss-process=image/auto-orient,1/quality,q_20/watermark,image_d2F0ZXJtYXJrLWxvZ28ucG5nP3gtb3NzLXByb2Nlc3M9aW1hZ2UvcmVzaXplLFBfMzU,g_se,x_0,y_0/format,jpg';
                                    }

                                    if ($meta_key === 'listing_price' && (!empty($meta))) $listing_price = $meta;
                                endforeach;
                                ?>


                                <div class="item item-<?php echo $lead_array['id']; ?> ">
                                    <a href="<?php echo base_url($lead_array['slug']); ?>"
                                       class="grid-item-link"><img
                                            src="<?php echo $listing_image; ?>" alt="Image"
                                            class="img-fluid"></a>
                                    <div class="detail-thumb">
                                        <a href="<?php echo base_url() . $lead_array['slug']; ?>">
                                            <span class="mas-title"><?php echo $lead_array['title']; ?></span></a>
                                        <a href="<?php echo base_url() . strtolower(volgo_make_slug($lead_array['category_name'])); ?>">
                                            <p class="mas-detail">
                                                Category: <?php echo $lead_array['category_name']; ?></p>
                                        </a>
                                        <!--                                        <span class="detail-thumb-price">-->
                                        <?php //echo (!empty($listing_price)) ? volgo_get_currency_unit_by_country_id() . ' ' . number_format($listing_price) : 'N/A';
                                        ?><!--</span>-->
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($ad_banners)): ?>
                        <?php foreach ($ad_banners as $banner): ?>
                            <?php if ($banner->ad_type === 'image'): ?>
                                <div class="adBanner image-type">
                                    <a href="<?php echo base_url('ad-post') ?>" class="d-block">
                                        <img alt="<?php echo $banner->title; ?>"
                                             src="<?php echo UPLOADS_URL . '/adbanners/' . $banner->ad_code_image; ?>"
                                             class="img-fluid">
                                    </a>
                                </div>
                            <?php else: ?>
                                <div class="adBanner code-type">
                                    <?php echo($banner->ad_code_image); ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mainWrapper mb-3 desktopHideOnMobile">
    <h1 class="styled-heading"> TRADE SHOWS
        <span class="heading-text-trad"> What’s happening in Trade World?</span>
    </h1>
    <div class="row mb-3"><!--class="row mb-3 flex_container"-->

        <?php
        $counter = 0;
        foreach ($metas_trade_show as $trade_show_single_meta):
            $trade_show_single_meta = json_encode($trade_show_single_meta);
            $trade_show_single_meta = json_decode($trade_show_single_meta,true);

            if ($counter >= 2)
                break;

            $trade_img_height = HOME_TRADE_IMG_H;
            $trade_img_width = HOME_TRADE_IMG_W;
            if(isset($trade_img_height) && !empty($trade_img_height)) {
                $trade_show_image = IMG_BASE_URL . 'tradeshows/' . volgo_maybe_unserialize($trade_show_single_meta['tradeshow_info']['featured_image'])  . '?x-oss-process=image/resize,m_fixed,h_' . $trade_img_height . '/auto-orient,1/quality,q_20/watermark,image_d2F0ZXJtYXJrLWxvZ28ucG5nP3gtb3NzLXByb2Nlc3M9aW1hZ2UvcmVzaXplLFBfMzU,g_se,x_0,y_0/format,jpg';
            }elseif(isset($trade_img_width) && !empty($trade_img_width)){
                $trade_show_image = IMG_BASE_URL . 'tradeshows/' . volgo_maybe_unserialize($trade_show_single_meta['tradeshow_info']['featured_image'])  . '?x-oss-process=image/resize,m_fixed,w_' . $trade_img_width . '/auto-orient,1/quality,q_20/watermark,image_d2F0ZXJtYXJrLWxvZ28ucG5nP3gtb3NzLXByb2Nlc3M9aW1hZ2UvcmVzaXplLFBfMzU,g_se,x_0,y_0/format,jpg';
            }elseif ((isset($trade_img_height) && !empty($trade_img_height)) && (isset($trade_img_width) && !empty($trade_img_width))){
                $trade_show_image = IMG_BASE_URL . 'tradeshows/' . volgo_maybe_unserialize($trade_show_single_meta['tradeshow_info']['featured_image'])  . '?x-oss-process=image/resize,m_fixed,h_' . $trade_img_height . ',w_' . $trade_img_width . '/auto-orient,1/quality,q_20/watermark,image_d2F0ZXJtYXJrLWxvZ28ucG5nP3gtb3NzLXByb2Nlc3M9aW1hZ2UvcmVzaXplLFBfMzU,g_se,x_0,y_0/format,jpg';
            }else{
                $trade_show_image = IMG_BASE_URL . 'tradeshows/' . volgo_maybe_unserialize($trade_show_single_meta['tradeshow_info']['featured_image']) . '?x-oss-process=image/resize,m_fixed,h_210,w_260/auto-orient,1/quality,q_20/watermark,image_d2F0ZXJtYXJrLWxvZ28ucG5nP3gtb3NzLXByb2Nlc3M9aW1hZ2UvcmVzaXplLFBfMzU,g_se,x_0,y_0/format,jpg';
            }

            ?>


            <div class="col-lg-6 flex_column">
                <div class="tradeHolder clearfix">

                    <div class="tradeHolderImg">
                        <img
                            src="<?php echo (empty($trade_show_single_meta['tradeshow_info']['featured_image'])) ? volgo_get_no_image_url() : $trade_show_image; ?>"
                            alt="Image" class="img-fluid">
                    </div>

                    <div class="tradebyDetail">

                        <span
                            class="tradeTitle"><?php echo $trade_show_single_meta['tradeshow_info']['title'] ?> </span>
                        <em class="tradeTitleDetail"><?php echo $trade_show_single_meta['tradeshow_info']['content'] ?>
                        </em>
                        <div class="hr-dotted">&nbsp;</div>
                        <ul class="sec-text">
                            <?php foreach ($trade_show_single_meta['metas'] as $trade_show_meta): ?>

                                <?php

                                if ($trade_show_meta['meta_key'] === 'starting_date') {
                                    echo '<li>
                            <strong>Start Date:</strong>
                            <span>';
                                    echo $trade_show_meta['meta_value'];
                                    echo '</span>
                        </li>';
                                }

                                ?>
                                <?php
                                if ($trade_show_meta['meta_key'] === 'ending_date') {
                                    echo '<li>
                            <strong>End Date:</strong>
                            <span>';
                                    echo $trade_show_meta['meta_value'];
                                    echo '</span>
                        </li>';
                                }

                                ?>

                                <?php
                                if ($trade_show_meta['meta_key'] === 'ts_venue') {
                                    echo '<li>
                            <strong>Venue: </strong>
                            <span>';
                                    echo $trade_show_meta['meta_value'];
                                    echo '</span>
                        </li>';
                                }

                                ?>

                            <?php endforeach; ?>
                        </ul>
                        <a href="<?php echo base_url('tradeshow/' . $trade_show_single_meta['tradeshow_info']['slug']); ?>"
                           class="btn btn-primary btn-event">Event Detail</a>
                    </div>
                </div>
            </div>

            <?php $counter++;
        endforeach; ?>

    </div>
    <div class="btn-center">
        <a href="<?php echo base_url('tradeshows'); ?>" class="btn btn-primary">View More</a>
    </div>
</div>
<div class="container-fluid mainWrapper mb-3 subscribeFormHolder desktopHideOnMobile">
    <div class="row">
        <div class="col-lg-8 mb-md-3">
            <a href="https://www.volgoplus.com/ad-post" class="postad-img">
                <img src="<?php echo base_url('uploads/general/post-add-image.jpg'); ?>" alt="Image" class="lazyload img-fluid">
            </a>
        </div>
        <div class="col-lg-4">
            <div class="error-wrapper alert alert-success" id="subscribe_success_msg" style="display: none;"></div>
            <div class="error-wrapper alert alert-danger" id="subscribe_danger_msg" style="display: none;"></div>
            <form action="<?php echo base_url('subscribers/create'); ?>" class="subscribeForm needs-validation"
                  method="post" novalidate>
                <fieldset>
                    <span class="subTitle">CONNECTED WITH MILLIONS OF BUYERS AND SELLERS GLOBALLY</span>
                    <em class="subtTitleAction">SUBSCRIBE NOW</em>
                    <div class="form-group">
                        <input id="subscribe-name" name="name" type="text" class="form-control"
                               placeholder="Name" required>
                        <div class="form-error text text-danger" id="subscribe_name_error"></div>
                    </div>
                    <div class="form-group">
                        <input id="subscribe-email" name="email" type="email" class="form-control"
                               placeholder="Email" required>
                        <div class="form-error text text-danger" id="subscribe_email_error"></div>
                    </div>
                    <button type="button" class="btn btn-primary btn-subscribe-submit">Submit</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<div class="popup-overlay"></div>
<?php if (!empty($this->session->flashdata('subscriber_error'))): ?>
    <!--Creates the popup content-->
    <div class="popup-content">
        <img src="<?php echo base_url('assets/images/warning_icon.png') ?>" alt="close-button-image">
        <div class="error-msg">

            <?php echo $this->session->flashdata('subscriber_error'); ?>
        </div>
        <!--popup's close button-->
        <button class="btn btn-danger btn_close">Go Back</button>
    </div>
<?php endif; ?>

<?php if (!empty($this->session->flashdata('subscriber_success'))): ?>
    <!--Creates the popup content-->
    <div class="popup-content popup3">
        <div class="icon-box">
            <i class="fa fa-check"></i>
        </div>
        <div class="success-msg" style="margin: 90px 0 0 0;">
            <?php echo $this->session->flashdata('subscriber_success'); ?>
        </div>
        <!--popup's close button-->
        <button class="btn btn-success btn_close">Go Back</button>
    </div>
<?php endif; ?>

<div class="dynamic-form-wrapper" style="display: none;">
    <?php
    $new_dynamic_forms = $dynamic_forms->data;
    foreach ($new_dynamic_forms as $form): ?>
        <div class="cat-wrapper" data-child_cat_id="<?php echo($form->child_cat_id); ?>"
             data-parent_cat_id="<?php echo($form->parent_cat_id); ?>">
            <div class="form_category"><?php echo($form->forms->form_category); ?></div>
            <div class="basic_sidebar_search_form"><?php echo($form->forms->basic_sidebar_search_form); ?></div>
            <div class="advance_sidebar_search_form"><?php echo($form->forms->advance_sidebar_search_form); ?></div>
            <div class="homepage_category_form_search"><?php echo($form->forms->homepage_category_form_search); ?></div>
        </div>
    <?php endforeach; ?>
</div>

<?php include_once realpath(__DIR__) . '/includes/footer.php'; ?>

<script>
    $('.checklength ul li').each(function () {

        var count_li = 0;
        var i = 1;


        $(".checklength ul li").each(function () {

            count_li++;
            console.log(count_li);
            if (count_li > 5 && i == 1) {
                var a = $(".checklength ul li").append('<ul id="newlist"></ul>');

                $('#newlist').append($(this).nextUntil($(this).last()).andSelf());
                i++;
                console.log("test");
            }
        });
    });
</script>
<!--<script>
    (function () {
        'use strict';
        window.addEventListener('load', function () {

            var forms = document.getElementsByClassName('needs-validation');

            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>-->
<script>
    $('.btn-subscribe-submit').on('click', function(e) {
        e.stopPropagation();
        var input = $(this);
        var name = $("#subscribe-name").val();
        var email = $("#subscribe-email").val();
        console.log(name);
        console.log(email);
        if (name === '') {
            $("#subscribe_name_error").html("This is Required Field");
        }
        if (email === '') {
            $("#subscribe_email_error").html("This is Required Field");
        }
        $('.error-wrapper').html('');
        if (name != '' && email != '') {
            $.ajax({
                url: $(this).closest('form').attr('action'),
                type:$(this).closest('form').attr('method'),
                dataType: "json",
                data: {name : name, email : email},
                success: function(data) {
                    console.log(data);
                    if(!$.isEmptyObject(data.success_msg)){
                        $('#subscribe_success_msg').html(data.success_msg).css('display','block');
                    }else if(!$.isEmptyObject(data.validation_errors)){
                        $('#subscribe_danger_msg').html(data.validation_errors).css('display','block');
                    }
                }
            });
        }
    });
    $(document).ready(function(){
        //$('body').find('.alert-success').show(0).delay(5000).hide(0);
        //$('body').find('.alert-danger').show(0).delay(5000).hide(0);
    });

</script>
