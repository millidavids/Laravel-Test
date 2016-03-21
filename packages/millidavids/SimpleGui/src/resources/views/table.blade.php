<table>
    @foreach($array as $key => $values)
        <tr>
        @foreach($values as $value)
            <td>{{ $value }}</td>
        @endforeach
        </tr>
    @endforeach
</table>