<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
</head>
<body>
    <table border="0">
        <tbody>

        <tr>
            <td colspan="2" style="font-family: helvetica, verdana, arial; font-weight: bold; font-size: x-small;">Ein neuer Shooting Termin wurde Ihnen zugewiesen.</td>
        </tr>
        <tr>
            <td colspan="2" style="font-family: helvetica, verdana, arial; font-size: x-small;">Bitte überprüfen Sie alle Details innerhalb 24 Stunden unter <a href="http://callcenter.century21.de">callcenter.century21.de</a></td>
        </tr>
        <tr>
            <td width="60" colspan="1" style="font-family: helvetica, verdana, arial; font-weight: bold; font-size: x-small;" valign="top">Kunde</td>
            <td style="font-family: helvetica, verdana, arial; font-size: x-small;">'.$rec['Firstname'].' '.$rec['Lastname'].'<br />'.$rec['Telephone'].'<br />'.$rec['Telephone2'].'</td>
        </tr>
        <tr>
            <td width="60" colspan="1" style="font-family: helvetica, verdana, arial; font-weight: bold; font-size: x-small;" valign="top">Objekt</td>
            <td style="font-family: helvetica, verdana, arial; font-size: x-small;">'.$rec['object_street'].'<br />'.$rec['object_zip'].' '.$rec['object_City'].'<br />EUR '.$rec['Price'].'<br />'.$rec['PropertyType'].'</td>
        </tr>
        <tr>
            <td width="60" colspan="1" style="font-family: helvetica, verdana, arial; font-weight: bold; font-size: x-small;" valign="top">Treffpunkt</td>
            <td style="font-family: helvetica, verdana, arial; font-size: x-small;">'.$rec['meeting_street'].'<br />'.$rec['meeting_zip'].' '.$rec['meeting_City'].'</td>
        </tr>
        <tr>
            <td width="60" colspan="1" style="font-family: helvetica, verdana, arial; font-weight: bold; font-size: x-small;" valign="top">Datum</td>
            <td style="font-family: helvetica, verdana, arial; font-size: x-small;">'.$rec['meeting_timestamp'].'</td>
        </tr>
        <tr>
            <td width="60" colspan="1" style="font-family: helvetica, verdana, arial; font-weight: bold; font-size: x-small;" valign="top">Status</td>
            <td style="font-family: helvetica, verdana, arial; font-size: x-small;">'.$_SESSION['status'][$rec['Status']].'</td>
        </tr>
        <tr>
            <td width="60" colspan="1" style="font-family: helvetica, verdana, arial; font-weight: bold; font-size: x-small;" valign="top">Makler</td>
            <td style="font-family: helvetica, verdana, arial; font-size: x-small;">'.$_SESSION['alluser'][$rec['meeting_user']].'</td>
        </tr>   
    </tbody>
    </table>
</body>
</html>