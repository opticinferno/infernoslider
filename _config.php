<?php
// Extend the class
//SiteTree::add_extension('Testimonials');
PageController::add_extension(\Inferno\InfernoSlider\Slider\ImageSliderController::class);
\SilverStripe\CMS\Model\SiteTree::add_extension(\Inferno\InfernoSlider\Slider\ImageSlider::class);
//Object::add_extension('ContentController', 'TestimonialsController');
