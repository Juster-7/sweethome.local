<?php
  
namespace App\Traits;

use Intervention\Image\ImageManager;
use Intervention\Image\Typography\FontFactory;
use Storage;
 
trait ProfilePhotoStorage
{
	protected $storageDisk = 'profile-photos';
	protected $defaultProfilePhotoUrl = '/images/profile-photo.png';
	
	public function profilePhotoExists($profilePhotoName) {	
		return !empty($profilePhotoName)&&Storage::disk($this->storageDisk)->exists($profilePhotoName);
	}
	
	public function getProfilePhotoUrl($profilePhotoName) {
		return $this->profilePhotoExists($profilePhotoName) ? $photoUrl = Storage::disk($this->storageDisk)->url($profilePhotoName) : $this->defaultProfilePhotoUrl;	
	}
	
	public function saveProfilePhotoFile($profilePhotoName, $image) {
		Storage::disk($this->storageDisk)->put($profilePhotoName, $image);
	}	
	
	public function deleteProfilePhotoFile($profilePhotoName) {
		Storage::disk($this->storageDisk)->delete($profilePhotoName);
	}
	
	public function createProfilePhotoImage($filename) {        
		return (string) ImageManager::imagick()
			->read($filename)
			->coverDown(120, 120)
			->encode();
		}	
	
	public function createFakeProfilePhotoImage($username) {        
		$username = explode(' ', $username);
		$username = mb_substr($username[0],0,1).mb_substr($username[1],0,1);
		
		return (string) ImageManager::imagick()
			->create(120, 120)
			->fill(str_replace('#','',$this->faker->hexcolor()))
			->text($username, 60, 60, function (FontFactory $font) {
				$font->filename('C:\WebServer\domains\sweethome.local\public\fonts\cour.ttf');
				$font->size(60);
				$font->color('000');
				$font->align('center');
				$font->valign('middle');
			})
			->encodeByExtension('jpg', quality:100);
	}
}