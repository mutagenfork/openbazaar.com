<?php $this->load->view('discover_header'); ?>
		
		<div class="Rectangle-10 clearfix">
			<div class="Page-Sub-Content">						
				
				
				<div class="Main-Discover-Body">	
					<h1><a href="/discover/results?type=cryptocurrency">Cryptocurrencies</a></h1>
					
					<div class="list-view-header" style="width:100%;">
						<div class="header-row row" style="width:100%;display: flex;">
							<div class="column" style="flex:1">Title</div>
							<div class="column mobile-hidden" style="flex:1">Vendor</div>
							<div class="column" style="width:125px;text-align: right;">Price (1 unit)</div>							
						</div>
					</div>
					
					<?php foreach($crypto_listings as $crypto_listing) {
						$verified = false;

						foreach($crypto_listing->relationships->moderators as $mod) {
							foreach($verified_mods as $vermod) {
								if($mod == $vermod->peerID) {
									$verified = true;
									break;
								}
							}
							if($verified) {
								break;
							}
						}
					$crypto_listing->has_verified_mod = $verified;
						
					?>
					<div class="list-view-content">						
						<div class="row" style="align-items: center">					
							
							<div class="column" style="flex:1;display:flex;">
								<div style="width:30px;min-width: 30px">
									<?php if($crypto_listing->has_verified_mod) { ?>
										<div class="verified-mod-badge" style="float:left;cursor:pointer;background-position: center center;width:24px;height:24px;background-size:24px 24px; background-repeat: no-repeat;background-image: url(https://search.ob1.io/images/verified_moderator_badge_tiny.png), url('../imgs/verifiedModeratorBadgeDefault-tiny.png');">
											
											<div class="verified-mod-tip hidden up-arrow" style="width:250px">
												<div style="margin-left:auto;margin-right:auto;text-align: center;display: table">
													<img src="https://search.ob1.io/images/verified_moderator_badge_tiny.png" width=24 style="width:24px;text-align:right;display: table-cell;vertical-align: middle; " />
													<span style="vertical-align: middle;display: table-cell; font-weight: 700; font-size: 14px">Verified Moderator</span>
												</div>
												<p class="verified-mod-text" style="font-size:13px;">You can purchase this listing with a moderator verified by <b>OB1</b>. <br/> <a href="https://ob1.io/verified-moderators.html" style="text-decoration: underline !important; cursor: pointer !important;" target="_blank">Learn more</a></p>
											
											</div>
										</div>																											
									<?php } ?>
								</div>														
								<div style="flex:1;flex-wrap: wrap">
									<div style="width:150px;white-space:nowrap;overflow: hidden;text-overflow: ellipsis;"><a href="/store/<?=$crypto_listing->relationships->vendor->data->peerID?>/<?=$crypto_listing->data->slug?>" title="<?=$crypto_listing->data->title?>"><?=$crypto_listing->data->title?></a></div>
									<div style="width:100%;display:flex;align-items: center">
										<div class="Listing-Star" style="width:15px;margin-left:0;font-size:10px;">⭐</div>
										<div class="Listing-Rating" style="flex:1;font-size:12px;"><?=number_format($crypto_listing->data->averageRating, 1)?> (<span class="underline"><?=$crypto_listing->data->ratingCount?></span>)</div>
										
									</div>
								</div>
							</div>
							
							<div class="column mobile-hidden" style="flex:1;">
								<div class="Listview-Avatar-Circle" style="z-index:1000;float:left;background-image: url('<?php echo (($crypto_listing->relationships->vendor->data->avatarHashes->small!="")) ? "https://gateway.ob1.io/ob/images/".$crypto_listing->relationships->vendor->data->avatarHashes->small : asset_url()."img/defaultAvatar.png"?>');" title="<?=$crypto_listing->relationships->vendor->data->name?>" onclick="location.href='/store/<?=$crypto_listing->relationships->vendor->data->peerID?>'"></div>
								<div>
									<div style="width:150px; white-space:nowrap;overflow: hidden;text-overflow: ellipsis;"><a href="/store/<?=$crypto_listing->relationships->vendor->data->peerID?>"><?=$crypto_listing->relationships->vendor->data->name?></a></div>
									<div style="display:flex;align-items: center">
										<div class="Listing-Star" style="width:15px;margin-left:0;font-size:10px;">⭐</div>
										<div class="Listing-Rating" style="flex:1;font-size:12px;"><?=number_format($crypto_listing->relationships->vendor->data->stats->averageRating, 1)?> (<span class="underline"><?=$crypto_listing->relationships->vendor->data->stats->ratingCount?></span>) &nbsp; <?=$crypto_listing->relationships->vendor->data->location?></div>
										
									</div>
								</div>
							</div>
							<div class="column" style="width:125px;text-align:right;font-size:14px;color:#2bae23;font-weight:bolder;">
								<?=pretty_price(1, $crypto_listing->data->coinType, 8)?>
							</div>
							
						</div>
						
					</div>	
						
					<?php } ?>		
					
					<div class="See-More-Listings" style="text-align:center;width:100%;margin:0 auto;margin-bottom: 30px;border-bottom: solid 1px #d2d3d9;padding-bottom: 20px;">
						<a href="/discover/results?type=cryptocurrency">
							<div class="button" style="border-radius: 2px;display: inline-block; box-shadow: 0 1px 0 0 rgba(219, 219, 219, 0.5);  background-color: #ffffff;  border: solid 1px #d2d3d9;margin:0 auto;margin-top:12px;padding:8px 33px;font-size:13px;font-weight:bolder;cursor:pointer">See All</div>
						</a>
					</div>		
					
				</div>
				
				<?php foreach($categories as $category) { ?>
					<h1><a href="/discover/results?q=<?=$category?>"><?=ucwords($category)?></a></h1>
				
					<div class="Main-Discover-Body">							
					<?php						
					$i = 0;
					
					$listings = $search_results[$category];
					
					foreach($listings as $listing) { 	
						
						$verified = false;

							foreach($listing->relationships->moderators as $mod) {
								foreach($verified_mods as $vermod) {
									if($mod == $vermod->peerID) {
										$verified = true;
										break;
									}
								}
								if($verified) {
									break;
								}
							}
						$listing->has_verified_mod = $verified;								
					?>
						<div class="Discover-Body-Listing-Box">
							<a class="Discover-Body-Listing-Link" href="/store/<?=$listing->relationships->vendor->data->peerID?>/<?=$listing->data->slug?>" title="<?=$listing->data->title?>"></a>
							<?php if($listing->has_verified_mod) { ?>
							<div class="verified-mod-badge" style="float:left;cursor:pointer;background-position: center center;width:36px;height:36px;background-size:24px 24px; background-repeat: no-repeat;background-image: url(https://search.ob1.io/images/verified_moderator_badge_tiny.png), url('../imgs/verifiedModeratorBadgeDefault-tiny.png');">
								
								<div class="verified-mod-tip hidden up-arrow" style="width:250px">
									<div style="margin-left:auto;margin-right:auto;text-align: center;display: table">
										<img src="https://search.ob1.io/images/verified_moderator_badge_tiny.png" width=24 style="width:24px;text-align:right;display: table-cell;vertical-align: middle; " />
										<span style="vertical-align: middle;display: table-cell; font-weight: 700; font-size: 14px">Verified Moderator</span>
									</div>
									<p class="verified-mod-text" style="font-size:13px;">You can purchase this listing with a moderator verified by <b>OB1</b>. <br/> <a href="https://ob1.io/verified-moderators.html" style="text-decoration: underline !important; cursor: pointer !important;" target="_blank">Learn more</a></p>
								
								</div>
							</div>																											
							<?php } ?>

							<div class="Discover-Body-Listing-Box-Photo Fixed-Width-Photo" style="background-image: url('https://gateway.ob1.io/ob/images/<?=$listing->data->thumbnail->small?>'), url('<?=asset_url()?>img/defaultItem.png');">									
                <a class="Discover-Body-Listing-Link" href="/store/<?=$listing->relationships->vendor->data->peerID?>/<?=$listing->data->slug?>" title="<?=$listing->data->title?>"></a>
                <?php if(isset($listing->data->freeShipping)) { ?>
								<div class="phraseBox" style="margin:8px 8px 0 0;">FREE SHIPPING</div>
								<?php } ?>																
							</div>
							
								<div style="display: flex; margin-top: 10px;">						
									<div class="reportBtnShell" data-peerID="<?=$listing->relationships->vendor->data->peerID?>" data-slug="<?=$listing->data->slug?>" data-tip="Report this listing" style="margin-top:-25px;margin-left:5px;flex:1;display:none;">
									  <button class="iconBtnTn button clrP clrBr tx2 " style="width: 30px;padding:0;height: 30px;cursor:pointer;background-color:white;border-radius:1px;">
									    <img src="<?=asset_url()?>img/ios7-flag.png" width=24 />
									  </button>
									</div>
										
										<div style="flex:1">
									<a href="/store/<?=$listing->relationships->vendor->data->peerID?>">
									<div class="Search-Avatar-Circle" style="background-image: url('<?php echo (($listing->relationships->vendor->data->avatarHashes->small!="")) ? "https://gateway.ob1.io/ob/images/".$listing->relationships->vendor->data->avatarHashes->small : asset_url()."img/defaultAvatar.png"?>');" title="<?=$listing->relationships->vendor->data->name?>"></div></a>
										</div>
							
								</div>
							
							<div class="Discover-Body-Listing-Box-Desc">
								<div class="Discover-Body-Listing-Box-Title"><a href="/store/<?=$listing->relationships->vendor->data->peerID?>/<?=$listing->data->slug?>"><?=$listing->data->title?></a></div>
							</div>
							<div class="Listing-Details">
								<div class="Listing-Star">⭐</div>
								<div class="Listing-Rating">&nbsp;<?=number_format($listing->data->averageRating, 1)?> (<span class="underline"><?=$listing->data->ratingCount?></span>)</div>
								<div class="Listing-Price"><?=pretty_price($listing->data->price->amount, $listing->data->price->currencyCode);?></div>
							</div>
						</div>											
					
					<?php $i++; } ?>
					</div>
					
					<div class="See-More-Listings" style="text-align:center;width:100%;margin:0 auto;margin-bottom: 30px;border-bottom: solid 1px #d2d3d9;padding-bottom: 20px;">
						<a href="/discover/results?q=<?=$category?>">
							<div class="button" style="border-radius: 2px;display: inline-block; box-shadow: 0 1px 0 0 rgba(219, 219, 219, 0.5);  background-color: #ffffff;  border: solid 1px #d2d3d9;margin:0 auto;margin-top:12px;padding:8px 33px;font-size:13px;font-weight:bolder;cursor:pointer">See All</div>
						</a>
					</div>
					
				
				
				
				
				
				<?php } ?>
				
				<br clear="both"/>	
				
			</div>
			
			
			
		</div>
		

		
	
