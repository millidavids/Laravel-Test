<table style="color: {{ $options['color'] }};">
    @foreach($arrays as $array)
        <tr>
            @foreach($array as $i)
                <td>{{ $i }}</td>
            @endforeach
        </tr>
    @endforeach
</table>