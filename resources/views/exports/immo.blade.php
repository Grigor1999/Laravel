<table>
    <thead>
    <tr>
           <th>ID</th>
           <th>Name</th>
           <th>Telefon</th>
           <th>Telefon 2</th>
           <th>Titel</th>
           <th>Objektart</th>
           <th>Strasse</th>
           <th>PLZ</th>
           <th>Ort</th>
           <th>Preis</th>
           <th>Zimmer</th>
           <th>Wohnflaeche</th>
           <th>URL</th>
           <th>Quelle</th>
           <th>Bemerkungen</th>
    </tr>
    </thead>
    <tbody>
    @foreach($immo as $item)
        <tr>
                <td>{{ $item->ID }}</td>
                <td>{{ $item->Lastname }}</td>
                <td>{{ $item->Telephone }}</td>
                <td>{{ $item->Telephone2 }}</td>
                <td>{{ $item->object_title }}</td>
                <td>{{ $item->PropertyType }}</td>
                <td>{{ $item->object_street }}</td>
                <td>{{ $item->object_zip }}</td>
                <td>{{ $item->object_City }}</td>
                <td>{{ $item->Price }}</td>
                <td>{{ $item->NumberOfRooms }}</td>
                <td>{{ $item->LivingSpace }}</td>
                <td>{{ $item->URL }}</td>
                <td>{{ $item->Quelle }}</td>
                <td>{{ $item->history->remark }}</td>
        </tr>
    @endforeach
    </tbody>
</table>