<?php
namespace Inferno\InfernoSlider\Slider;
use SilverStripe\Core\Extension;
use SilverStripe\View\Requirements;

class ImageSliderController extends Extension {

	private static $allowed_actions = array (
	'GetSliderImages'
	);

	public function onAfterInit() {

		Requirements::set_write_js_to_body(true);

		//Section for image slider controller

		//Load CSS requirements
		Requirements::css("opticinferno/infernoslider: client/css/slider-style.css");
		//Load Javascript requirements

        Requirements::javascript("opticinferno/infernoslider: client/js/carousel-swipe.js");
		$interval = $this->owner->Interval;
		$swipe = $this->owner->Swipe;

		//Call Owl Carousel
		Requirements::customScript("
			$('.carousel').carousel({
			  interval: $interval,
			  swipe: $swipe
			  
			  

			});
			
		");

	}

}
