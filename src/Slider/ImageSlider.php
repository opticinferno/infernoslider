<?php
namespace Inferno\InfernoSlider\Slider;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;
use UncleCheese\DisplayLogic\Extensions\DisplayLogic;
use UncleCheese\DisplayLogic\Forms\Wrapper;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;

class ImageSlider extends DataExtension {
    private static $table_name = 'ImageSlider';
	private static $db = array(
	'AmountBanners' => 'Varchar(10)',
	'Interval'=>'Varchar(10)',
	'Swipe'=>'Varchar(10)',
	'SingleContent' => 'HTMLText'

	);

    private static $has_one = array(
	    'SingleBanner' => Image::class,
        'SingleBannerMobile' => Image::class);


	private static $has_many = array(
	'Banners'=>RotatingBanners::class
	);

	public function getCMSFields() {
   	$this->extend('updateCMSFields', $fields);
 	return $fields;
	}

    public function onAfterWrite()

    {

        if ($this->owner->SingleBannerID) {

            $this->owner->SingleBanner()->publishSingle();

        }
        if ($this->owner->SingleBannerMobileID) {

            $this->owner->SingleBannerMobile()->publishSingle();

        }

    }

	public function updateCMSFields(FieldList $fields) {



		$gridFieldConfig= GridFieldConfig_RelationEditor::create(10);
		$gridFieldConfig->addComponent(new GridFieldOrderableRows('SortOrder'));

	$fields->addFieldsToTab('Root.RotatingBanners', array(

		OptionSetField::create('AmountBanners', 'Amount of banners to display', array('0' => 'No banner', '1' => 'Single Banner', '2' => 'Multiple banners')),
		$MultiBannerOption1 = TextField::create('Interval', 'Slide delay(Milliseconds)', '10000'),
		$MultiBannerOption2 = TextField::create('Swipe', 'Mobile swipe delay', '30'),


	 //GridField configs




	));
	$fields->addFieldToTab('Root.RotatingBanners', Wrapper::create(
	$MultiBanner = GridField::create("Banners", "Recursive Rotating Banners", $this->owner->Banners()->sort("SortOrder"), $gridFieldConfig)
	)->hideUnless("AmountBanners")->isEqualTo(2)->end());

	$fields->addFieldToTab('Root.RotatingBanners', Wrapper::create(
	    $ThisSingleBanner = UploadField::create('SingleBanner', 'Please upload your banner'),
        $ThisSingleBanner = UploadField::create('SingleBannerMobile', 'Please upload your banner for mobile')
	)->hideUnless("AmountBanners")->isEqualTo(1)->end());

	$fields->addFieldToTab('Root.RotatingBanners', Wrapper::create(
	$ThisSingleBannerContent = HTMLEditorField::create('SingleContent', 'Banner Text')
	)->hideUnless("AmountBanners")->isEqualTo(1)->end());


	$MultiBannerOption1->hideUnless("AmountBanners")->isEqualTo(2);
	$MultiBannerOption2->hideUnless("AmountBanners")->isEqualTo(2);
	return $fields;

	}

	// Makes banner recursive so that it display in all child fields
	function getPageBannerRecursive() {
	$page = $this->owner;
	$PageBanner = $this->owner->Banners();
	while(!isset($PageBanner['RotatingBanners']->ID) && $page->ParentID != 0) {
	$page = $page->Parent();
	$PageBanner = $page->Banners();

	}
	return $PageBanner;

	}

}


