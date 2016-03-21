{!! view('SimpleGui::table', ['array' => array('joe' => array(1,2,3), 'jeff' => array(1,2,3), 'jerry' => array(1,2,3))]) !!}
<br>
{!! view('SimpleGui::dropdown', ['array' => array('joe' => 'jones', 'jeff' => 'jeffries')]) !!}
<br>
{!! view('SimpleGui::link', ['link_text' => 'link text']) !!}
<br>
{!! view('SimpleGui::textfield', ['array' => array('joe' => 'jones', 'jeff' => 'jeffries')]) !!}
<br>
{!! view('SimpleGui::label', ['array' => array('joe' => 'jones', 'jeff' => 'jeffries')]) !!}
