<?php

function format_rp($num)
{
  return 'Rp. ' . number_format($num, 2, ',', '.');
}
