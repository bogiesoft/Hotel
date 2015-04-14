<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photos extends ADMIN_Controller {

    function hotel_photos(){
		$hotel_id 	= $this->input->post('hotel_id');
		$code		= $this->session->userdata('code');

		if (!empty($_FILES)) {

            $tempFile   = $_FILES['file']['tmp_name'];
            $fileExt    = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $fileName   = time().'_'.rand(0,100).'.'.$fileExt;

            $dirname    = $hotel_id.'_hotel/';

            //control directory
            if (!is_dir('uploads/'.$dirname)) {
    		    mkdir('./uploads/' . $dirname, 0777, TRUE);
    		}

    		//set target
            $targetPath = getcwd() . '/uploads/'.$dirname;
            $targetFile = $targetPath . $fileName ;

            //move file to target
            move_uploaded_file($tempFile, $targetFile);

            $photo_url = site_url('uploads/'.$dirname.$fileName);

            $arr = array(
            	'hotel_id' => $hotel_id,
            	'code' => $code,
            	'photo_url' => $photo_url);


            $this->db->insert("hotel_photos",$arr);
        }

	}


    function room_photos(){
        $hotel_id       = $this->session->userdata('hotel_id');
        $code           = $this->session->userdata('code');
        $room_id        = $this->input->post('room_id');

        if (!empty($_FILES)) {

            $tempFile   = $_FILES['file']['tmp_name'];
            $fileExt    = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $fileName   = time().'_'.rand(0,100).'.'.$fileExt;

            $dirname    = $hotel_id.'_rooms/';

            //control directory
            if (!is_dir('uploads/'.$dirname)) {
                mkdir('./uploads/' . $dirname, 0777, TRUE);
            }

            //set target
            $targetPath = getcwd() . '/uploads/'.$dirname;
            $targetFile = $targetPath . $fileName ;

            //move file to target
            move_uploaded_file($tempFile, $targetFile);

            $photo_url = site_url('uploads/'.$dirname.$fileName);

            $arr = array(
                    'hotel_id' => $hotel_id,
                    'code' => $code,
                    'photo_url' => $photo_url,
                    'room_id' => $room_id);

            $this->db->insert("room_photos",$arr);
            
        }

    }
}
