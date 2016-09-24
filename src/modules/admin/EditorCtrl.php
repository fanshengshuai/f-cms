<?php

class AdminEditorCtrl extends AdminAbstractCtrl {

    public function uploadAction() {
		global $_F;

		$upload_file = FUploader::saveFile('imgFile', 'editor');
		$retData = array('error' => 0, 'url' => trim($_F['s_url'], '/') . '/uploads/' . $upload_file);

		return FResponse::output($retData);
	}
}
