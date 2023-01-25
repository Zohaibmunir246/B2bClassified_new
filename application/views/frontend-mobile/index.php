<?php include_once realpath(__DIR__) . '/includes/header.php'; ?>
<?php
require_once APPPATH . 'classes/JsonManipulation.php';

/**
 * Required Initial Variables
 */

$jsonManipulation = (new \application\classes\JsonManipulation());
$all_cats = $jsonManipulation->get_categories(null);
$all_makes = $jsonManipulation->get_makes();
$all_models = $jsonManipulation->get_models();
$dynamic_forms = $jsonManipulation->get_dynamic_form();

?>

<!-- Main -->
<main id="main">
	<?php include_once realpath(__DIR__) . '/includes/main_filter_country_flags.php'; ?>
	
	<div class="categories-block">
		<div class="row">
			<div class="col-12 text-center">
				<h1>Popular Categories</h1>
			</div>
			<div class="col-12">
				<ul class="list-inline cat-list">
					<?php if(!empty($all_cats)): ?>
						<?php foreach($all_cats as $cat): if ($cat->parent_ids !== 'uncategorised' || ($cat->slug === 'jobs-wanted') || ($cat->slug === 'buying-lead') || ($cat->slug === 'seller-lead') ) continue; ?>
							<li class="list-inline-item">
								<a href="<?php echo base_url($cat->slug); ?>" class="d-flex flex-column align-items-center">
									<div class="icon ml-auto mr-auto"><img src="<?php echo base_url('assets/frontend-mobile/images/icon-'.$cat->slug.'.png')?>" alt="image description"></div>
									<span class="txt"><?php echo $cat->name; ?></span>
								</a>
							</li>
						<?php endforeach; ?>
					<?php endif; ?>
					<li class="list-inline-item">
						<a href="<?php echo base_url('buying-leads'); ?>" class="d-flex flex-column align-items-center">
							<div class="icon ml-auto mr-auto"><img src="<?php echo base_url('assets/frontend-mobile/images/icon-bucket.png')?>" alt="image description"></div>
							<span class="txt">Buying Leads</span>
						</a>
					</li>
					<li class="list-inline-item">
						<a href="<?php echo base_url('seller-leads'); ?>" class="d-flex flex-column align-items-center">
							<div class="icon ml-auto mr-auto"><img src="<?php echo base_url('assets/frontend-mobile/images/icon-handshake.png')?>" alt="image description"></div>
							<span class="txt">Seller Leads</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="ad-frame"><a href="<?php echo base_url('ad-post-cat'); ?>"><img src="<?php echo base_url('assets/frontend-mobile/images/ad1.png')?>" alt="ad"></a></div>
	
	<div class="listing-block">
		<div class="container p-0">
			<div class="row">
				<div class="masonrow msrItems">
					<?php if (!empty($listings) && isset($listings['list'])): ?>
						<?php foreach ($listings['list'] as $f_listing) : ?>
							<?php
							$listing_image = base_url() . 'uploads/general/no-image.jpg';
							$listing_price = 0;
							$currency_code = volgo_get_currency_unit_by_country_id();
							
                            $main_category_name = $f_listing['category_info']['category_name'];

							foreach ($f_listing['metas'] as $meta): ?>

								
								<?php if ($meta['meta_key'] === 'images_from' && (!empty($meta['meta_value']))) {
									$lm = unserialize($meta['meta_value']);
                                    if(is_array($meta['meta_value']))
                                        $lm = $meta['meta_value'];
                                    else
                                        $lm = unserialize($meta['meta_value']);
									if (!empty($lm)) {
                                        $listing_image = IMG_BASE_URL . 'listing_images/' . ($lm[0]) . '?x-oss-process=image/auto-orient,1/quality,q_30/watermark,image_d2F0ZXJtYXJrLWxvZ28ucG5nP3gtb3NzLXByb2Nlc3M9aW1hZ2UvcmVzaXplLFBfMzU,g_se,x_0,y_0/format,webp';
                                    } else {

                                        if (trim($main_category_name) === "Jobs" || trim($main_category_name) === "Jobs Wanted") {
                                            $listing_image = volgo_get_job_wanted_image_url();
                                        } else {

                                            $listing_image = volgo_get_no_image_url();
                                        }

                                    }
								}

								?>

								
								<?php if (($meta['meta_key'] === 'price') && (!empty($meta['meta_value']))) $listing_price = $meta['meta_value']; ?>
								<?php if ($meta['meta_key'] === 'currency_code' && (!empty($meta['meta_value']))) $currency_code = $meta['meta_value'];	?>
								<?php if ($meta['meta_key'] === 'listing_type' && (!empty($meta['meta_value']))) $listing_type = $meta['meta_value']; ?>

							<?php endforeach; ?>

							<div class="post_cards msrItem">
								<div class="block featured text-center position-relative imgsize">
								<?php
								$user_id = volgo_get_logged_in_user_id();

								if (isset($user_id)) {
									$user_id = $user_id;
								} else {
									$user_id = 0;
								}
								?>

								<?php
								$idoflisting = [];
							   
								if (!empty($listing_fav)) {
									foreach ($listing_fav as $single_listing) {
										$idoflisting[] = $single_listing->meta_value;
										$user_id_retrived = $single_listing->user_id;
									}
								}
								if (isset($user_id_retrived)) {
									$user_id_retrived = $user_id_retrived;
								} else {
									$user_id_retrived = "no fav";
								}

								
								if ($user_id_retrived == $user_id):?>
									<?php if (in_array($f_listing['listing_info']['listing_id'], $idoflisting)):

										?>
									<a class="saveNow fav_add_listing icon position-absolute"
										data-lisitngid="<?php echo $f_listing['listing_info']['listing_id']; ?>"
										data-user_id="<?php echo $user_id; ?>" href="#"
										style="display: none;"
									>
										<i class="fa fa-spinner" style="display: none"></i>
										<span class="icon-heart"></span>
									</a>
									<a class="saveNow remove_fav_listing icon fav position-absolute"
										data-lisitngid="<?php echo $f_listing['listing_info']['listing_id']; ?>"
										data-user_id="<?php echo $user_id; ?>" href="#"
										style="">
										<i class="fa fa-spinner" style="display: none"></i>
										<span class="icon-heart"></span>
									</a>
								<?php else: ?>
									<a class="saveNow fav_add_listing icon position-absolute"
										data-lisitngid="<?php echo $f_listing['listing_info']['listing_id']; ?>"
										data-user_id="<?php echo $user_id; ?>" href="#"
										style=""
									>
										<i class="fa fa-spinner" style="display: none"></i>
										<span class="icon-heart"></span>
									</a>
									<a class="saveNow remove_fav_listing icon fav position-absolute"
										data-lisitngid="<?php echo $f_listing['listing_info']['listing_id']; ?>"
										data-user_id="<?php echo $user_id; ?>" href="#"
										style="display: none;">
										<i class="fa fa-spinner" style="display: none"></i>
										<span class="icon-heart"></span>
									</a>
								<?php endif; ?>
							
							<?php else: ?>
								<a class="saveNow fav_add_listing icon position-absolute"
										data-lisitngid="<?php echo $f_listing['listing_info']['listing_id']; ?>"
										data-user_id="<?php echo $user_id; ?>" href="#"
										style=""
									>
										<i class="fa fa-spinner" style="display: none"></i>
										<span class="icon-heart"></span>
									</a>
									<a class="saveNow remove_fav_listing icon fav position-absolute"
										data-lisitngid="<?php echo $f_listing['listing_info']['listing_id']; ?>"
										data-user_id="<?php echo $user_id; ?>" href="#"
										style="display: none;">
										<i class="fa fa-spinner" style="display: none"></i>
										<span class="icon-heart"></span>
									</a>
								<?php endif; ?>

									<a href="<?php echo base_url() . $f_listing['listing_info']['listing_slug']; ?>" class="post_image_">
										<img src="<?php echo $listing_image; ?>" alt="image description">
									</a>
									<a href="<?php echo base_url() . $f_listing['listing_info']['listing_slug']; ?>">
									<strong class="title"><?php echo $f_listing['listing_info']['listing_title']; ?></strong></a>
									<div class="price-bar d-flex justify-content-between align-items-center <?php echo $listing_type ?>">
										<a href="<?php echo base_url() . $f_listing['listing_info']['listing_slug']; ?>" class="btn <?php echo $listing_type ?>"><?php echo $listing_type ?></a>
										<strong class="price">
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
										</strong>
									</div>
								</div>
							</div>


						<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<div class="spin" style="display:none">
					<div class="canvas canvas6">
						<div class="spinner6 p1"></div>
						<div class="spinner6 p2"></div>
						<div class="spinner6 p3"></div>
						<div class="spinner6 p4"></div>
					</div>
				</div>
				<div class="load-more" data-page="2"></div>
			</div>
		</div>
	</div>
</main>

<?php include_once realpath(__DIR__ ) . '/includes/footer.php'; ?>
