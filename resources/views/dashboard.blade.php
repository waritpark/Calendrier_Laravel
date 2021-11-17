@extends('template')

@section('content')

    <div class="mb-5 d-flex align-items-center justify-content-center">
        <a class="arrow-rotate180" href="/calendar/dashboard/<?=$month->previousMonth()->month;?>-<?=$month->previousMonth()->year;?>">
            <img src="/images/arrow.png" class="arrow-btn">
        </a>
        <h1 class="mx-5 w-300 d-flex justify-content-center"><?php echo $month->toString(); ?></h1>
        <a class="" href="/calendar/dashboard/<?=$month->nextMonth()->month;?>-<?=$month->nextMonth()->year;?>">
            <img src="/images/arrow.png" class="arrow-btn">
        </a>
    </div>  

    <table class="table table-bordered" id="calendar-table">
        <tr>
        <?php foreach($month->days as $s): ?>
            <th class="text-center align-middle border"><?php echo $s; ?></th>
        <?php endforeach; ?>
        </tr>
        <?php for($i = 0; $i < $weeks; $i++) {  ?>
            <tr>
            <?php 
            foreach($month->days as $k => $day): 
                $date=$start->modify("+" . ($k + $i * 7). "days"); 
                $isToday = date('Y-m-d') === $date->format('Y-m-d'); 

                $years = $date->format('Y');
                $months = $date->format('m');
                $days = $date->format('d');
                ?>
                <td class="w-14 align-top position-relative td-month-<?= $month->toStringMonth() ?> <?= $month->withinMonth($date) ? '' : 'bg-second'; ?><?= $isToday ? 'ajout-event-'.$month->toStringMonth().'' : ''; ?>">
                    <a class="position-absolute h-100 w-100 top-0 right-0" href="/calendar/dashboard/day-evenement/<?=$years?>-<?=$months?>-<?=$days?>"></a>
                    <div class="fs-5"><?= $date->format('d');?></div>
                    <?php 
                    // requete pour afficher les events dans les jours correspondant en fonction de l'utilisateur
                        $id_user =  $request->session()->get('id_user');
                        $events = DB::table('events')
                        ->where('user_id', "=", $id_user)
                        ->whereBetween('start', [$date->format('Y-m-d 00:00:00'),$date->format('Y-m-d 23:59:59')])
                        ->get();
                    ?>
                    @foreach ($events as $event)                      
                        <div class="container-calendar-event d-flex align-items-center fs-6">
                            <div><?= (new DateTimeImmutable($event->start))->format('H:i'); ?>&nbsp;-&nbsp;</div>
                            <div><?= $event->name ?></div>
                        </div>
                    @endforeach
                </td>
            <?php endforeach; ?>
            </tr>
        <?php } ?>
    </table>
@endsection