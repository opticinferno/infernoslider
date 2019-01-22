<?php
namespace Inferno\InfernoSlider\Slider;
use Inferno\InfernoElemental\Element\ElementSliderExtension;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\DataObject;
use TractorCow\Colorpicker\Forms\ColorField;

class RotatingBanners extends DataObject {
    private static $table_name = 'RotatingBanners';
	private static $db = array(
	'SortOrder'=>'Int',
	'BannerName'=>'Varchar',
	'Alignment' => 'Varchar(10)',
	'TextColor' => 'Color',
	'OverlayWidth' => 'Varchar(12)',
	'OverlayColor' => 'Color',
	'OverlayOpacity' => 'Varchar(5)',
	'Caption'=>'HTMLText',
	'AltTag' => 'Varchar(255)',
	);

    private static $has_one = array(
	'ImageSlider'=>\Page::class,
	'Banner'=>Image::class,
	'MobileBanner'=>Image::class,
	'LinkPage' => SiteTree::class,
	'ElementSliderExtension' => ElementSliderExtension::class,
	);
    public function onAfterWrite()

    {

        if ($this->owner->BannerID) {

            $this->owner->Banner()->publishSingle();

        }

    }
		//Build the form fields in CMS
		public function getCMSFields() {

		// Create CMS Fields
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', new TextField('BannerName', 'Banner Name '));
		$fields->addFieldToTab('Root.Main', new TextareaField('AltTag', 'Alt Tag'));
		$fields->addFieldToTab('Root.Main', $uploadField = new UploadField('Banner', 'Banner'));
    			$uploadField->setFolderName('Banners');
		$fields->addFieldToTab('Root.Main', $uploadField = new UploadField('MobileBanner', 'Mobile Banner'));
    			$uploadField->setFolderName('Banners');
//		$fields->addFieldToTab ('Root.Main', new TreeDropdownField('LinkPageID', 'Link a page', 'SiteTree'));
		$fields->addFieldToTab('Root.Main', new DropdownField('Alignment', 'Caption text alignment', array(
    		'left' => 'Left',
    		'center' => 'Center',
    		'right'=> 'Right'
  			)));
		$fields->addFieldToTab('Root.Main', new ColorField('TextColor', 'Caption text colour'));
		$fields->addFieldToTab('Root.Main', new DropdownField('OverlayWidth', 'Overlay Width', array(
    		'width:100%;' => 'Full width',
    		'width:50%;' => 'Half width',
  			)));
		$fields->addFieldToTab('Root.Main', new ColorField('OverlayColor', 'Overlay Color'));
		$fields->addFieldToTab('Root.Main', new DropdownField('OverlayOpacity', 'Overlay Opacity', array(
    		'0'=>'0',
			'0.1' => '0.1',
			'0.2' => '0.2',
			'0.3' => '0.3',
			'0.4' => '0.4',
			'0.5' => '0.5',
			'0.6' => '0.6',
			'0.7' => '0.7',
			'0.8' => '0.8',
			'0.9' => '0.9',
			'1' => '1',
  			)));
		$fields->addFieldToTab('Root.Main', new HtmlEditorField('Caption', 'Caption'));

		$fields->removeFieldFromTab('Root.Main','ImageSliderID');		// Automatically stores parent record so we can remove it
		$fields->removeFieldFromTab('Root.Main','SortOrder');				// Dont need to display sort order
		return $fields;
	}

	// Tell the datagrid what fields to show in the table
		private static $summary_fields = array(
		   'BannerName' => 'BannerName',
	   );
       private static $default_sort='SortOrder';

}
