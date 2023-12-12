<table>
    <thead>
    <tr>
        <th style="width:100px">Ultimo pagam.</th>
        <th style="width:100px">Nominativo</th>
        <th style="width:150px">Indirizzo</th>
        <th style="width:150px">Recapito</th>
        <th style="width:150px">Email</th>
        <th style="width:50px">Socio</th>
    </tr>
    </thead>
    <tbody>
    @foreach($customers as $invoice)
        <tr>
            <td>{{ $invoice->Data_ultimo_pagamento }}</td>
            <td>{{ $invoice->Nominativo }} {{ $invoice->Cognome }}</td>
            <td>{{ $invoice->Indirizzo }} {{ $invoice->CAP }} {{ $invoice->Città }} ({{ $invoice->Provincia }} )</td>
            <td>{{ $invoice->Telefono }} / {{ $invoice->Cellulare }}</td>
            <td>{{ $invoice->Email }}</td>
            @if($invoice->socio == 0)
            <td>No</td>
            @else
            <td>Si</td>
            @endif
            
        </tr>
    @endforeach
    </tbody>
</table>