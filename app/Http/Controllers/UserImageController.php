<?php

namespace App\Http\Controllers;

use App\Image;
use App\Jobs\ThumbnailGenerator;
use App\User;
use Illuminate\Http\Request;

class UserImageController extends Controller
{
    public function store(Request $request, $user_id)
    {
        $dest = storage_path().'/app/public/';
        $basename = substr(md5(microtime()), rand(0, 26), 10);
        $filename = $basename . '.png';
        $thumbnail_name = $basename . '-thumbnail.png';
        $request->file('image')->move($dest, $filename);
        $image = User::findOrFail($user_id)->images()->save(new Image(array(
            'path' => $dest . $filename,
            'thumbnail_path' => $dest . $thumbnail_name
        )));
        $this->dispatch(new ThumbnailGenerator($image));
        return redirect('user/' . $user_id);
    }
}
