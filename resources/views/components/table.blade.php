<table class = "responsive-table">
    <thead>
    <tr>
        @foreach($tableHeaders as $tableHeader)
            <th class = "flow-text">{{ $tableHeader }}</th>
        @endforeach
    </tr>
    </thead>

    <tbody>
        {{ $slot }}
    </tbody>
</table>