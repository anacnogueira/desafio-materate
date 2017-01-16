<?php

namespace Desafio\Storage;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Desafio\Contracts\ManageFile as ManageFileInterface;

class ManageFile implements ManageFileInterface
{
	public function store($request, $name, $destinationPath, $oldFile)
	{
		$filename = '';

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            
            if(!empty($oldFile)){
                $this->delete($destinationPath, $oldFile);
            }
            $extension = $request->file('file')->getClientOriginalExtension();
            $filename = str_slug($name).'.'.$extension;
            $request->file('file')->move($destinationPath, $filename);           
        }

        return $filename;
	}

    public function delete($destinationPath, $file)
    {
    	if(File::exists($destinationPath.'/'.$file)){
            File::delete($destinationPath.'/'.$file);
        }
    }
}	