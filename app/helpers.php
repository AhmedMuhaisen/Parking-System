<?php

use Carbon\Carbon;
  function search_date($input,$column_name,$table){
      $parts = explode('/', $input);

    $day = $parts[0] ?? null;
    $month = $parts[1] ?? null;
    $year = $parts[2] ?? null;

    // Full date: 01/02/2025 (filter >= that date)
    if ($day != '00' && $month != '00' && $year != null) {

        $table->whereDate($column_name, '>=', $input);
    }

    // Year only: 00/00/YYYY
    elseif ($year != null && $month == '00' && $day == '00') {
        $table->whereYear($column_name, $year);
    }

    // Month only: 00/MM
    elseif ($month != '00' && $day == '00' && $year == null) {
        $table->whereMonth($column_name, $month);
    }

    // Day only: DD
    elseif ($day != '00' && $month == null && $year == null) {
        $table->whereDay($column_name, $day);
    }

}
