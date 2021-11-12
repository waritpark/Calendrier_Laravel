@extends('template')

@section('content')

<?php
use App\Http\Controllers\MonthController;

$month = new MonthController($_GET['month'] ?? null, $_GET['year'] ?? null);
$start = $month->getStartingDay();
$start = $start->format('N')=== '1' ? $start : $month->getStartingDay()->modify('last monday');
$weeks = $month->getWeeks();
?>
    <div class="mb-5 d-flex align-items-center justify-content-center">
        <a class="arrow-rotate180" href="dashboard.php?month=<?=$month->previousMonth()->month;?>&year=<?=$month->previousMonth()->year;?>">
            <img src="/images/arrow.png" class="arrow-btn">
        </a>
        <h1 class="mx-5 w-300 d-flex justify-content-center"><?php echo $month->toString(); ?></h1>
        <a class="" href="dashboard.php?month=<?=$month->nextMonth()->month;?>&year=<?=$month->nextMonth()->year;?>">
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
                $isToday = date('Y-m-d') === $date->format('Y-m-d'); ?>
                <td class="w-14 align-top position-relative td-month-<?= $month->toStringMonth() ?> <?= $month->withinMonth($date) ? '' : 'bg-second'; ?><?= $isToday ? 'ajout-event-'.$month->toStringMonth().'' : ''; ?>">
                    <a class="position-absolute h-100 w-100 top-0 right-0" href="day-evenement.php?date=<?= $date->format('Y-m-d');?>"></a>
                <?php //$eventsForDay = $events[$date->format('Y-m-d')] ?? []; ?>
                    <div class="fs-5"><?= $date->format('d');?></div>
                    <?php //foreach($eventsForDay as $event): ?>
                        {{-- <div class="container-calendar-event d-flex align-items-center fs-6">
                            <div><?= //(new DateTimeImmutable($event['start_event']))->format('H:i'); ?>&nbsp;-&nbsp;</div>
                            <div><?php //echo $event['nom_event'];?></div>
                        </div> --}}
                    <?php// endforeach; ?>
                </td>
                <?php endforeach; ?>
                </tr>
            <?php } ?>
    </table>
@endsection