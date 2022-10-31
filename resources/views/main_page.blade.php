<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="10;url={{ url('api/urv') }}">
    <title>УЧЁТ РАБОЧЕГО ВРЕМЕНИ {{ /** @var \App\Models\Event[] $events */ $events[0]->urv_object->name }}</title>
    <meta charset="UTF-8">
    <style type="text/css">
        body {
            font-size: 15px;
            color: #343d44;
            font-family: "segoe-ui", "open-sans", tahoma, arial, serif;
            padding: 0
        }
        table {
            font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui", serif;
            font-size: 8px
        }

        h1 {
            text-align: center
        }

        h1 {
            margin: 25px auto 0;
            text-transform: uppercase;
            font-size: 17px
        }

        h2 {
            text-align: center
        }

        h2 {
            margin: 2px auto 0;
            text-transform: uppercase;
            font-size: 17px
        }

        table td {
            transition: all .5s
        }

        .data-table {
            background-color: #fff;
            border-collapse: collapse;
            font-size: 14px;
            min-width: 537px
        }

        .data-table td,
        .data-table th {
            border: 1px solid #e1edff;
            padding: 7px 17px
        }

        .data-table caption {
            margin: 7px
        }

        .data-table thead th {
            background-color: #1a869e;
            color: #fff;
            border-color: #6ea1cc !important;
            text-transform: uppercase
        }

        .data-table tbody td {
            color: #353535
        }

        .data-table tbody td:first-child,
        .data-table tbody td:last-child,
        .data-table tbody td:nth-child(4) {
            text-align: right
        }

        .data-table tbody tr:nth-child(odd) td {
            background-color: #f4fbff
        }

        .data-table tbody tr:hover td {
            background-color: #ffffa2;
            border-color: #ffff0f
        }

        .data-table tfoot th {
            background-color: #e5f5ff;
            text-align: right
        }

        .data-table tfoot th:first-child {
            text-align: left
        }

        .data-table tbody td:empty {
            background-color: #fcc
        }
    </style>
</head>
<body class="full-height">
<table>
    <tbody>
    <tr>
        <td>
            <table border='1' cellpadding='10' class='data-table'>
                <div class='thead'>
                    <thead>
                    <tr>
                        <th width="170px">Время</th>
                        <th>Событие</th>
                        <th width="270px">ФИО</th>
                    </tr>
                    </thead>
                </div>
                @foreach($events as $event)
                <tr onclick="window.location.href ='?id=1'">
                    <td>{{ $event->event_time }}</td>
                    @if($event->event_status_id === 3)
                    <td style="Color:Green;font-weight:bold;"><h2>Вход</h2></td>
                    @else
                    <td style="Color:Red;font-weight:bold;"><h2>Выход</h2></td>
                    @endif
                    <td>{{ $event->name }}</td>
                </tr>
                @endforeach
            </table>
        </td>
        <td style="position:absolute;">
            <table>
                <tbody>
                <tr>
                    <td><h1>{{ $events[0]->event_status_id == 3 ? 'ВХОД' : 'ВЫХОД' }}</h1></td>
                </tr>
                <tr>
                    <td><img
                            src="{{ url($events[0]->screen_path) }}"
                            onclick="window.location='1'"
                            width="100%" />
                    </td>
                </tr>
                <tr>
                    <td><h1>{{ $events[0]->name }}</h1></td>
                </tr>
                <tr>
                    @if ($events[0]->event_status_id == 3)
                    <td style="Color:Green;font-weight:bold;"><h1>Вход</h1></td>
                    @else
                    <td style="Color:Red;font-weight:bold;"><h1>Выход</h1></td>
                    @endif
                </tr>
                <tr>
                    <td><h1>{{ $events[0]->event_time}}</h1></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>


