<?php

namespace millidavids\SimpleGui;

class ViewRenderer {

    public static function table(Array $array, Array $options)
    {
        return view('SimpleGui::partials.table', ['arrays' => $array, 'options' => $options]);
    }
    public static function dropdown(Array $array, String $selected)
    {
        return view('SimpleGui::partials.dropdown');
    }
    public static function link(String $text, String $target, Array $options)
    {
        return view('SimpleGui::partials.link');
    }
    public static function textfield(String $name, String $data, Array $options)
    {
        return view('SimpleGui::partials.textfield');
    }
    public static function label(String $content, String $for, Array $options)
    {
        return view('SimpleGui::partials.label');
    }

}