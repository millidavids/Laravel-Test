<?php

namespace millidavids\SimpleGui;

class ViewRenderer {

    public static function table(Array $array, Array $options)
    {
        return view('SimpleGui::table');
    }
    public static function dropdown(Array $array, String $selected)
    {
        return view('SimpleGui::dropdown');
    }
    public static function link(String $text, String $target, Array $options)
    {
        return view('SimpleGui::link');
    }
    public static function textfield(String $name, String $data, Array $options)
    {
        return view('SimpleGui::taxtfield');
    }
    public static function label(String $content, String $for, Array $options)
    {
        return view('SimpleGui::label');
    }

}