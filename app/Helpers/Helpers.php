<?php 

function uploadPath($file, $folderPath)
{
	return asset(str_replace('\\', '/', str_replace('public', 'storage', $file->store('public/'.$folderPath))));
}